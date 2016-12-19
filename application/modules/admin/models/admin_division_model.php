<?php

class Admin_division_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function   getdivisionData($id)
    {

        $query = $this->db->get_where(DIVISION_MASTER,
            array(
                'division_id'=>$id
            )
        );
        return $query->row_array();
    }

    public function adddivision($data)
    {
        //pr($data);
        $this->db->insert(DIVISION_MASTER, $data);
        return $this->db->insert_id();

    }

    public function updatedivision($data , $division_id)
    {
        $this->db->where('division_id' ,$division_id);
       return $this->db->update(DIVISION_MASTER,$data);
    }

    public function deletedivision( $delete_id='')
    {
        $this->db->where('division_id' , $delete_id);
        return $this->db->delete(DIVISION_MASTER);
    }

}