<?php namespace App\Controllers;

use App\Models\PagesModel;
use App\Models\DetailsModel;
use App\Models\AdminModel;
use App\Models\FileModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
	protected $model;
	protected $footer_model;
	protected $user_model;
	protected $file_model;
	protected $session;
	protected $db;
	protected $main_slug;
	protected $contact_slug;

	public function __construct() {
		// parent::__construct();
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
		$this->model = new PagesModel();
		$this->footer_model = new DetailsModel();
		$this->user_model = new AdminModel();
		$this->file_model = new FileModel();
		$main_page = $this->model->getPageById(1);
		$this->main_slug = $main_page['slug'];
		$contact_page = $this->model->getPageById(2);
		$this->contact_slug = $contact_page['slug'];
		
		echo view('templates/admin_header', [
					'logged_in' => !$this->session->logged_in ? false : true, 
					'main_slug' => $this->main_slug,
					'contact_slug' => $this->contact_slug,
					'logo' => $this->file_model->getFileData(),
				]);
		
	}

	public function index()
	{
		if (!$this->session->logged_in ) {
			echo view('admin/login');
		} else {
			echo view('admin/logged_in_landing', [ 'username'=> $this->session->user_data['username'] ]);
			
		}
		

	    echo view('templates/footer', $this->footer_model->getFooterData());
	}

	//--------------------------------------------------------------------
	public function edit($slug = null)
	{
		if ( $this->session->logged_in ) {

			$data = array();
		    $data['page'] = $this->model->getPages($slug);

		    if ($this->request->getVar('submit') == true ) {
		    	if ($this->validate([
			        'title' => 'required|min_length[3]|max_length[255]',
			        'body' => 'required'
			    ])) {
			    	$data['success'] = true;
			    	$this->model->update($data['page']['id'], [
			            'title' => $this->request->getVar('title'),
			            'slug'  => url_title($this->request->getVar('title'), '-', TRUE),
			            'body'  => $this->request->getVar('body'),
			            'meta_title' => $this->request->getVar('meta_title'), 
			            'meta_description' => $this->request->getVar('meta_description'), 
			            'no_index' => $this->request->getVar('no_index'), 
			        ]);
			        $data['page'] = $this->model->getPages(url_title($this->request->getVar('title'), '-', TRUE));
			    }


		    } 
		    
	        echo view('admin/edit', $data);
	       
	    } else {
	    	redirect()->to('/admin');
	    }

	    echo view('templates/footer', $this->footer_model->getFooterData());
	}

	public function success() {
		// echo view('templates/header', $data);
	    echo view('admin/success', $data);
	    echo view('templates/footer', $data);
	}

	public function global_details($submit = false) {
	    if ( $this->session->logged_in ) {
		    $data['global_details'] = $this->footer_model->getFooterData();
			$data['success'] = false;

		    if ($this->request->getVar('submit') == true ) {
		    	
			   	$this->footer_model->update(1 , [
		            'email' => $this->request->getVar('email'),
		            'ga_script'  => $this->request->getVar('ga_script'),
		            'fb_script'  => $this->request->getVar('fb_script'),

		        ]);
			   	$data['success'] = true;
			   	$data['global_details'] = array(
			   		'email' => $this->request->getVar('email'),
		            'ga_script'  => $this->request->getVar('ga_script'),
		            'fb_script'  => $this->request->getVar('fb_script'),
			   	);
		    } 

	        echo view('admin/global_details', $data);
	    	echo view('templates/footer', $data['global_details']);
	   } else {
			redirect()->to('/admin');
	   }
	    
	    
	}
	public function logo($success = false) {
		if ( $this->session->logged_in ) {

			$data['global_details'] = $this->footer_model->getFooterData();	
			$data['logo'] =  $this->file_model->getFileData();
			$data['msg'] = $this->session->get('msg');
			echo view('admin/logo', [
				'msg' => $data['msg'],
				'logo' => $data['logo']['file_name'],
				'success' => $success == 'success' ? true : false
				]
			);
	    	echo view('templates/footer', $data['global_details']);
	    } else {
	    	redirect()->to('/admin');
	    }
	}

	public function logo_update() {
		$data['global_details'] = $this->footer_model->getFooterData();

		if ( $this->session->logged_in ) {
			
			if ($this->request->getVar('submit') == true ) {
				// $data['success'] = true;
				$validated = $this->validate([
			            'logo' => [
			                'uploaded[logo]',
			                'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
			                'max_size[logo,4096]',
			            ],
			        ]);

				if ($validated) {
		            $logo = $this->request->getFile('logo');
					$new_name = $logo->getRandomName();
		            $logo->move(FCPATH. '/user_images', $new_name);
			 		$data['logo']['file_name'] = $new_name;
					$builder = $this->db->table('files');
					$filedata = [
						'file_name'=>$new_name, 
						'file_type'=>$logo->getClientMimeType()
					];

			        $this->file_model->update(6,$filedata); 
			        $this->session->set('msg', 'File has been uploaded');
			        $success = 'success';
				} else {
					$success = '';
					$this->session->set('msg', 'Please select a valid file; <4mb image');
				}
				
			} 
			
			return redirect()->to('/admin/logo/'.$success);
		} else {
			return redirect()->to('/admin');
		}

	}

	public function auth() {
		if ($this->request->getVar('submit') == true ) {
			//Validate & Session start
			if ($this->validate([
		        'username' => 'required',
		        'password' => 'required'
		    ]) ) {
				$is_valid = $this->user_model->checkAdmin(
					$this->request->getVar('username'),	
					md5($this->request->getVar('password')),
				);
				if ($is_valid == true ) {
					$is_valid['user_data'] = $is_valid['user_data'];
					$is_valid['user_data']['logged_in'] = TRUE;
					$this->session->set('logged_in', TRUE);
					$this->session->set('user_data', $is_valid['user_data']);
					return redirect()->to('/admin');
				} else {
					return redirect()->to('/admin');
				}
		    }
		} else {
			return false;
		}
	}

	public function logout() {
		$this->session->destroy();
		return redirect()->to('/admin');
	}

}
