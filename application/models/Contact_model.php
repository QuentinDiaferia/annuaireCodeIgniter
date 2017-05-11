<?php
class Contact_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    public function main_get($filter = null, $token = null, $orderBy = 'lastmodified', $direction = 'DESC', $page = 0) {

        $offset = ($page == 0) ? 0 : 10 * ($page - 1);

        $query = $this->db->select('id, active, lastname, firstname, telephone, company')
                            ->from('contacts')
                            ->order_by($orderBy, $direction)
                            ->limit(10, $offset);

        if($filter == 'initial') {
            $query = $this->db->like('lastname', $token, 'after');
        }
        elseif($filter != null) {
            $query = $this->db->where($filter, $token);    
        }

        if(!$this->session->admin) {
            $query = $this->db->where('active', 1);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_by_id($id) {

        $query = $this->db->select('contacts.*, 
                                    users.lastname as u_lastname, 
                                    users.firstname as u_firstname, 
                                    group_concat(id_function ORDER BY id_function) AS function_ids, 
                                    group_concat(functions.name ORDER BY id_function) AS function_names')
                            ->from('contacts ')
                            ->join('users', 'users.id = contacts.modifiedby')
                            ->join('contacts_functions' ,'contacts.id = id_contact')
                            ->join('functions', 'functions.id = id_function')
                            ->where('contacts.id', $id);

        if(!$this->session->admin)
            $query = $this->db->where('functions.active', 1);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function add($contact, $functions) {

        $this->db->insert('contacts', $contact);
        $contactId = $this->db->insert_id();

        $contactFunctions = array();

        foreach($functions as $function) {
            $contactFunctions[] = array(
                'id_contact' => $contactId,
                'id_function' => $function
            );
        }

        $this->db->insert_batch('contacts_functions', $contactFunctions);
    }

    public function edit($id, $contact, $functions) {

        $this->db->where('id', $id)->update('contacts', $contact);

        $newContactFunctions = array();

        foreach($this->input->post('functions') as $function) {
            $newContactFunctions[] = array(
                'id_contact' => $id,
                'id_function' => $function
            );
        }

        $this->db->where('id_contact', $id)
                    ->delete('contacts_functions');
        $this->db->insert_batch('contacts_functions', $newContactFunctions);
    }

    public function set_active($id, $bool) {

        $this->db->set('active', $bool)
                    ->where('id', $id)
                    ->update('contacts');

        return $this->db->affected_rows();
    }

    public function delete($id) {

        $this->db->where('id_contact', $id)
                    ->delete('contacts_functions');

        $affectedRows = $this->db->affected_rows();

        if($affectedRows != 0) {
            $this->db->where('id', $id)
                    ->delete('contacts');
        }

        return $affectedRows;
    }

    public function count() {

        return $this->db->count_all('contacts');
    }
}