<?php namespace App\Models;

use CodeIgniter\Model;

class PagesModel extends Model
{
    protected $table = 'pages'; 
    protected $allowedFields = ['title', 'slug', 'hero_img', 'body', 'no_index', 'meta_title', 'meta_description'];

    public function getPages($slug = false)
    {

        if ($slug === false)
        {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }

    public function getPageById($id) {
    	return $this->asArray()
                    ->where(['id' => $id])
                    ->first();
    }
}