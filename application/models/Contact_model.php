<?php
class Contact_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($page = 0)
    {
        $offset = ($page == 0) ? 0 : 10 * ($page - 1);

        $query = $this->db->select('id, active, lastname, firstname, telephone, company')
                            ->from('contacts')
                            ->order_by($this->session->orderBy, $this->session->direction)
                            ->limit(10, $offset);

        if (!$this->session->admin) {
            $query = $this->db->where('active', 1);
        }

        if ($this->session->f_lastname != null) {
            $query = $this->db->where('lastname', $this->session->f_lastname);
        }

        if ($this->session->f_firstname != null) {
            $query = $this->db->where('firstname', $this->session->f_firstname);
        }

        if ($this->session->f_initial != null) {
            $query = $this->db->like('lastname', $this->session->f_initial, 'after');
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->select('contacts.*, 
                                    LPAD(contacts.postcode, 5, "0") as postcode, 
                                    users.lastname as u_lastname, 
                                    users.firstname as u_firstname, 
                                    group_concat(id_function ORDER BY id_function) AS function_ids, 
                                    group_concat(functions.name ORDER BY id_function) AS function_names')
                            ->from('contacts ')
                            ->join('users', 'users.id = contacts.modifiedby')
                            ->join('contacts_functions', 'contacts.id = id_contact')
                            ->join('functions', 'functions.id = id_function')
                            ->where('contacts.id', $id);

        if (!$this->session->admin) {
            $query = $this->db->where('functions.active', 1);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function add($contact, $functions)
    {
        $this->db->insert('contacts', $contact);
        $contactId = $this->db->insert_id();

        $contactFunctions = array();

        foreach ($functions as $function) {
            $contactFunctions[] = array(
                'id_contact' => $contactId,
                'id_function' => $function
            );
        }

        $this->db->insert_batch('contacts_functions', $contactFunctions);
    }

    public function edit($id, $contact, $functions)
    {
        $this->db->where('id', $id)->update('contacts', $contact);

        $newContactFunctions = array();

        foreach ($this->input->post('functions') as $function) {
            $newContactFunctions[] = array(
                'id_contact' => $id,
                'id_function' => $function
            );
        }

        $this->db->where('id_contact', $id)
                    ->delete('contacts_functions');
        $this->db->insert_batch('contacts_functions', $newContactFunctions);
    }

    public function set_active($id, $bool)
    {
        $this->db->set('active', $bool)
                    ->set('lastmodified', date('Y-m-d'))
                    ->set('modifiedby', $this->session->id)
                    ->where('id', $id)
                    ->update('contacts');

        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id_contact', $id)
                    ->delete('contacts_functions');

        $affectedRows = $this->db->affected_rows();

        if ($affectedRows != 0) {
            $this->db->where('id', $id)
                    ->delete('contacts');
        }

        return $affectedRows;
    }

    public function countWithFilter()
    {
        if (!$this->session->admin) {
            $this->db->where('active', 1);
        }

        if ($this->session->f_lastname != null) {
            $query = $this->db->where('lastname', $this->session->f_lastname);
        }

        if ($this->session->f_firstname != null) {
            $query = $this->db->where('firstname', $this->session->f_firstname);
        }
        
        if ($this->session->f_initial != null) {
            $query = $this->db->like('lastname', $this->session->f_initial, 'after');
        }

        return $this->db->count_all_results('contacts');
    }
}
