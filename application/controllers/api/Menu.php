<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Menu extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model_api');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $status = $this->get('status');
        if ($id === NULL)
        {
            if ($status === NULL) {  
                $menu = $this->menu_model_api->getMenu();
            } else {   
                $menu = $this->menu_model_api->getMenu($id,$status);
            }
        }else{
            $menu = $this->menu_model_api->getMenu($id,$status);
        }
        
        if ($menu)
        {
            $this->response([
                'status'    => TRUE,
                'data'      => $menu
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

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status'    => FALSE,
                'massage'   => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->menu_model_api->deleteMenu($id) > 0) {
                $this->response([
                    'status'    => TRUE,
                    'id'        => $id,
                    'massage'   => 'deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status'    => FALSE,
                    'massage'   => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
            
        }
        
    }
    
    public function index_post()
    {        
        $data = [
            'nama' => $this->post('nama'),
            'kategori' => $this->post('kategori'),
            'harga' => $this->post('harga'),
            'status' => $this->post('status'),
            'deskripsi' => $this->post('deskripsi'),
            'created_by' => $this->post('created_by') 
        ];

        if ($this->menu_model_api->createMenu($data) > 0) {
            $this->response([
                'status'    => TRUE,
                'massage'   => 'new menu has been created'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status'    => FALSE,
                'massage'   => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'kategori' => $this->put('kategori'),
            'harga' => $this->put('harga'),
            'status' => $this->put('status'),
            'deskripsi' => $this->put('deskripsi'),
            'updated' => $this->put('updated'), 
            'updated_by' => $this->put('updated_by'), 
        ];

        if ($this->menu_model_api->updateMenu($data, $id) > 0) {
            $this->response([
                'status'    => TRUE,
                'massage'   => 'data menu has been updated'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status'    => FALSE,
                'massage'   => $data
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
