<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $table = 'users';
	protected $allowed_fields = ['username', 'password'];

	public function checkAdmin($username, $password) {
		$ret_val = $this->asArray()->where(['username' => $username, 'password' => $password] )->first();
		if (is_array($ret_val) && $ret_val['username'] == $username) {
			return array ('is_valid'=> true, 'user_data' => $ret_val);
		} else {
			return false;
		}
	}
}