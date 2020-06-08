<?php namespace App\Models;

use CodeIgniter\Model;

class DetailsModel extends Model
{
	protected $table = 'footer_details';

	protected $allowedFields = ['ga_script', 'fb_script', 'email'];

	public function getFooterData() {
		return $this->asArray()->where(['id'=>1])->first();
	}

}