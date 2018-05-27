<?php

class User extends Database{
	public $user_name = null;
	public $user_id = null;

	public function __construct(){
		Database::Database();
		$this->table('tbl_users');
	}

	public function getUserByUsername($username, $is_die = false){
		try{
			
			$this->where(' user_email = "'.$username.'"');
			$data = $this->select($is_die);
			return $data;
			//SELECT * FROM users WHERE username = 'admin@ecommerce.dev' 

		} catch(Exception $e){
			error_log('User Error 1'.$e->getMessage()."\r\n",3, "../../log/error.log");
			return false;
		}


	}

	public function updateLogin($user_id, $is_die = false){
		try {

				$data = array();
				$data['last_login'] =date('Y-m-d H:i:s');
				$data['login_ip'] = $_SERVER['REMOTE_ADDR'];

				$this->where('id ='.$user_id);
				return $this->update($data, $is_die);
				
		} catch (Exception $e) {
				error_log('User Error 2'.$e->getMessage()."\r\n",3, "../../log/error.log");
				return false;	
		}
	}

	public function getAllUser($is_die = false){
		try {
			$data = $this->select($is_die);
			return $data;
		} catch (Exception $e) {
			error_log('User Error 3'.$e->getMessage()."\r\n",3, "../../log/error.log");
				return false;
		}
	}

}

?>