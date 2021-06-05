<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Login extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model_api');
        
        // $this->methods['menu_get']['limit'] = 25; 
        // $this->methods['menu_post']['limit'] = 25; 
        // $this->methods['menu_delete']['limit'] = 15; 
        // $this->methods['menu_put']['limit'] = 25; 
    }

    public function index_get()
    {
    	$username = $this->get('username');
    	$password = $this->get('password');

    	if ($password === null) {
    		$validasi_username = $this->login_model_api->query_validasi_username($username);
    	} else {
    		$validasi_username=$this->login_model_api->query_validasi_password($username,$password);
    	}    	   	

    	if ($validasi_username)
        {
            $this->response([
                'status'    => TRUE,
                'data'      => $validasi_username
            ], REST_Controller::HTTP_OK);            
        }
        else
        {
            $this->response([
                'status'    => FALSE,
                'message'   => 'No data were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}