<?php namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
	protected $table = 'files';

	protected $allowedFields = ['file_name', 'file_type'];

	public function getFileData() {
		return $this->asArray()->where(['id'=>6])->first();
	}

}