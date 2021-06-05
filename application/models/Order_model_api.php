<?php

class Order_model_api extends CI_Model {

    public function getOrder($id = null, $level = null) 
    {
        if ($id === null) {
            if ($level === null) {
                $this->db->from('order');
                $this->db->order_by("id", "desc");
                $query = $this->db->get()->result_array();
                return $query; 
            } else {
                $this->db->from('order');
                $this->db->where('status_order', '1');
                $this->db->order_by("id", "desc");
                $query = $this->db->get()->result_array();
                return $query; 
            }
        } else {
            return $this->db->get_where('order', ['no_order'=>$id])->row();
        }        
    }

    public function actSave($dataOrder, $detailMenu)
    {
        try {
            $this->db->insert('order', $dataOrder);

            foreach ($detailMenu as $key => $val) {
                $this->db->insert('item_order', $val);
            }

            return true;
        } catch (Exception $th) {
            return false;
        }

    }


    public function getNoOrder()
    {
        $dateNow = date('Y-m-d');
        $q = $this->db->query("SELECT MAX(RIGHT(no_order,3)) AS no_max FROM `order` WHERE DATE(tanggal_order)='$dateNow'");
        
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->no_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $noOrder = 'ABC'.date('dmy').'-'.$kd;
        return $noOrder;
    }

    public function deleteOrder($id)
    {        
        $delete = $this->db->delete('order', ['no_order' => $id]);
        if ($delete) {
            $this->db->delete('item_order', ['no_order' => $id]);
            return $this->db->affected_rows();
        }
    }

    public function getDetailOrder($noorder)
    {
        return $this->db->query("SELECT o.qty, o.totalperitem, o.id, m.nama, m.harga, o.id_menu menu_id FROM item_order AS o LEFT JOIN menu AS m ON m.id = o.id_menu WHERE o.no_order = '$noorder'")->result();
    }

    public function deleteDetailOrder($idDetail)
    {
        try {
            $this->db->delete('item_order', array('id' => $idDetail));

            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function updateDetailOrder($data, $id)
    {
        try {
            $this->db->update('item_order', $data, array('id' => $id));

            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    public function actUpdate($dataOrder, $detailMenu, $noorder)
    {
        try {
            $this->db->update('order', $dataOrder, array('no_order' => $noorder));

            if (count($detailMenu) > 0) {
                foreach ($detailMenu as $key => $val) {
                    $this->db->insert('item_order', $val);
                }
            }

            return true;
        } catch (Exception $th) {
            return false;
        }

    }   
}