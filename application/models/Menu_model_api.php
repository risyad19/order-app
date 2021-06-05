<?php

class Menu_model_api extends CI_Model {
    
    public function getMenu($id = NULL, $status = NULL){
        if ($id === NULL) {
            if ($status === NULL) {
                return $this->db->get('menu')->result_array();
            } else {
                return $this->db->get_where('menu', ['status' => '1'])->result_array();
            }            
        } else {
            return $this->db->get_where('menu', ['id' => $id])->row();
        }
    }

    public function deleteMenu($id)
    {
        $this->db->delete('menu', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createMenu($data)
    {
        $this->db->insert('menu', $data);
        return $this->db->affected_rows();
    }

    public function updateMenu($data, $id)
    {
        $this->db->update('menu', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}