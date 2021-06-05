<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model_api extends CI_Model{

    public function query_validasi_username($username){
    	$result = $this->db->query("SELECT * FROM user WHERE username='$username' LIMIT 1")->row();
        return $result;
    }

    public function query_validasi_password($username,$password){
    	$result = $this->db->query("SELECT * FROM user WHERE username='$username' AND `password`=MD5('$password') LIMIT 1")->row();
        return $result;
    }

} 