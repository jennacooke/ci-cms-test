<?php namespace App\Controllers;

use App\Models\PagesModel;
use App\Models\DetailsModel;
use App\Models\FileModel;
use CodeIgniter\Controller;

class Pages extends Controller
{
	protected $session;
	protected $model;
	protected $footer_model;
	protected $main_slug;
	protected $contact_slug;
	protected $logo_model;

	public function __construct() {
		$this->session = \Config\Services::session();
		$this->model = new PagesModel();
		$this->footer_model = new DetailsModel();
		$main_page = $this->model->getPageById(1);
		$this->main_slug = $main_page['slug'];
		$contact_page = $this->model->getPageById(2);
		$this->contact_slug = $contact_page['slug'];
		$this->logo_model = new FileModel();
	}

    public function index()
    {
       
	    return redirect()->to('/admin');
    }

    public function view($slug = null)
    {
    	if ($this->session->logged_in) {
		    $data['pages'] = $this->model->getPages($slug);
		    $data['pages']['main_slug'] = $this->main_slug;
		    if (empty($data['pages']))
		    {
		        throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the pages: '. $slug);
		    }

		    $data['title'] = $data['pages']['title'];
		    $data['body'] = html_entity_decode($data['pages']['body']);

		    echo view('templates/header', [
		    	'title' => $data['page']['meta_title'] ? $data['page']['meta_title'] : $data['page']['title'], 
		    	'no_index' => $data['page']['no_index'],
		    	'meta_title' => $data['page']['meta_title'],
		    	'meta_description' => $data['page']['meta_description'],
		    	'logo' => $this->logo_model->getFileData(),
		    	'main_slug' => $this->main_slug,
		    	'contact_slug' => $this->contact_slug,
		    ]);
		    echo view('pages/view', $data);
		    echo view('templates/footer', $this->footer_model->getFooterData());
	    } else {
	    	return redirect()->to('/admin');
	    }
    }

    public function contact() {
    	if ( $this->session->logged_in ) {
			$footer_data = $this->footer_model->getFooterData();
	    	$data['page'] = $this->model->getPageById(2);
	    	$data['page']['main_slug'] = $this->main_slug;
			$data['page']['contact_slug'] = $data['page']['slug'];
			$data['page']['logo'] = $this->logo_model->getFileData();

			echo view('templates/header', $data['page'] );

	    	if ($this->request->getVar('submit') == true ) {
	    		if ( $this->validate([
			        'name' => 'required|min_length[3]|max_length[255]',
			        'email' => 'required|valid_email',
			        'message' => 'required'
					])
	    		) { 
					$email = \Config\Services::email();

					$email->setFrom( $this->request->getVar('email'), $this->request->getVar('name') );
					$email->setTo( $footer_data['email'] );

					$email->setSubject( 'Email From BeMo Contact form' );
					$email->setMessage( $this->request->getVar('message') );

					$email->send();
			    }
			    echo view('pages/success');
	    	} else {
	    		echo view('pages/contact', 
	    			[
	    				'global_data' => $footer_data, 
	    				'page' => $data['page'],
		    		] 
		    	);
	    	}
	    } else {
	    	return redirect()->to('/admin');
	    }

    	
	    
    	echo view('templates/footer', $footer_data );
    	

    }
    
}