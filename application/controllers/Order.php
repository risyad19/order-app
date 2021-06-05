<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('order_model_api');
    }

    public function index()
    {
        $data = $this->order_model_api->getNoOrder();
        var_dump($data);
        die();

        $this->load->view('view_order', $data);
    }
}