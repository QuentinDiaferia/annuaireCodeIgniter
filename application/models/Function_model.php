<?php
class Function_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }


    public function get_all() {

        $query = $this->db->order_by('name', 'ASC')
                            ->get('functions');

        return $query->result_array();
    }

    public function get_by_id($id) {

        $query = $this->db->where('id', $id)
                            ->get('functions');

        return $query->row_array();
    }

    public function check_existing_ids($ids) {

        $result = $this->db->select('id')
                            ->from('functions')
                            ->where_in('id', $ids)
                            ->count_all_results();

        if($result == count($ids))
            return true;
        else
            return false;
    }

    public function add($data) {

        $this->db->insert('functions', $data);
    }

    public function edit($id, $data) {

        $this->db->where('id', $id)->update('functions', $data);
    }

    public function set_active($id, $bool) {

        $this->db->set('active', $bool)
                    ->where('id', $id)
                    ->update('functions');

        return $this->db->affected_rows();
    }
}