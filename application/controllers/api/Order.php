<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Order extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('order_model_api');
    }

    public function index_get()
    {
        $level = $this->get('level');
        $id = $this->get('id');
        
        if ($id === NULL)
        {
            if ($level === null) {
                $order = $this->order_model_api->getOrder();
            } else {
                $order = $this->order_model_api->getOrder($id, $level);
            }
        }else{
            $order =  $this->order_model_api->getOrder($id,$level);
        }

        if ($order)
        {
            $this->response([
                'status'    => TRUE,
                'data'      => $order
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
        $id = $this->delete('no_order');

        if ($id === null) {
            $this->response([
                'status'    => FALSE,
                'massage'   => $id
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->order_model_api->deleteOrder($id) > 0) {
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

    public function noOrder_get()
    {
        $noOrder = $this->order_model_api->getNoOrder();        

        if ($noOrder)
        {
            $this->response([
                'status'    => TRUE,
                'data'      => $noOrder
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

    public function actAdd_post()
    {
        $no_meja = $this->post('no_meja');
        $totitemall = $this->post('total_item');
        $tothargaall = $this->post('total_harga');
        $id_client = $this->post('created_by');

        $detailOrder = $this->post('detailOrder');
        $idMenu = $this->post('idMenu');
        $qty = $this->post('qty');
        $totharga = $this->post('totharga');

        $noOrder = $this->order_model_api->getNoOrder();

        $detailMenu = [];
        for ($i=0; $i < count($detailOrder) ; $i++) { 
            $detailMenu[] = array(
                "no_order" => $noOrder,
                "id_menu"  => $detailOrder[$i]['id_menu'],
                "qty"      => $detailOrder[$i]['qty'],
                "totalperitem" => $detailOrder[$i]['totalperitem'],
                "created_by" => $detailOrder[$i]['created_by']             
            ); 
        };
        
        $dataOrder =  array(
            "no_order" => $noOrder,
            "no_meja" => $no_meja,
            "tanggal_order" => date('Y-m-d'),
            "total_item" => $totitemall,
            "total_harga" => $tothargaall,
            "created_by" => $id_client
        );

        $insertData = $this->order_model_api->actSave($dataOrder, $detailMenu);
        
        echo json_encode($insertData);
    }

    public function detailOrder_get()
    {
        $noorder = $this->get('noorder');
        $data = $this->order_model_api->getDetailOrder($noorder);

        echo json_encode($data);
    }

    public function deleteDetail_post()
    {
        $idDetail = $this->post('idDetail');
        // echo json_encode($idDetail);

        $delete = $this->order_model_api->deleteDetailOrder($idDetail);

        echo json_encode($delete);
    }

    public function updateDetail_put()
    {
        $idDetail = $this->put('idDetail');
        $idMenu = $this->put('idMenu');
        $qty = $this->put('qty');
        $totperitem = $this->put('totperitem');

        $data = [
            'id_menu' => $idMenu,
            'qty' => $qty,
            'totalperitem' => $totperitem,
            'updated' => date('Y-m-d'),
            'updated_by' => $this->session->userdata('id')
        ];

        $update = $this->order_model_api->updateDetailOrder($data, $idDetail);

        echo json_encode($update);
    }

    public function actUpdate_post()
    {
        $post = $this->post(NULL, TRUE); 
        $noorder = $post['no_order'];
        $no_meja = $post['no_meja'];
        $totitemall = $post['total_item'];
        $tothargaall = $post['total_harga'];
        $statusOrder = $post['status_order'];
        $id_client = $post['updated_by'];

        $detailOrder = isset($post['detailOrder']) ? $post['detailOrder'] : [];

        $detailMenu = [];
        if (count($detailOrder) > 0) {
            for ($i=0; $i < count($detailOrder) ; $i++) { 
                $detailMenu[] = array(
                    "no_order" => $noorder,
                    "id_menu"  => $detailOrder[$i]['id_menu'],
                    "qty"      => $detailOrder[$i]['qty'],
                    "totalperitem" => $detailOrder[$i]['totalperitem'],
                    "created_by" => $detailOrder[$i]['created_by']               
                ); 
            };
        }
        
        $dataOrder =  array(
            "no_meja" => $no_meja,
            "status_order" => $statusOrder,
            "total_item" => $totitemall,
            "total_harga" => $tothargaall,
            "updated" => date('Y-m-d'),
            "updated_by" => $id_client
        ); //data Header yang akan diupdate

        $updateData = $this->order_model_api->actUpdate($dataOrder, $detailMenu, $noorder);
        
        echo json_encode($updateData);
    }

}
