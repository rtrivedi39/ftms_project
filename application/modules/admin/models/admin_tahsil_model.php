<?php

class Admin_tahsil_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
	public function  getTahsilDatafrom_district($districtt_id = null)
    {

        $query = $this->db->get_where(TAHSIL_MASTER,
            array(
                'district_id'=>$districtt_id
            )
        );
        return $query->result_array();
    }

    public function  gettahsilData($id)
    {

        $query = $this->db->get_where(TAHSIL_MASTER,
            array(
                'tahsil_id'=>$id
            )
        );
        return $query->row_array();
    }

    public function addtahsil($data)
    {
        //pr($data);
        $this->db->insert(TAHSIL_MASTER, $data);
        return $this->db->insert_id();

    }

    public function updatetahsil($data , $tahsil_id)
    {
       $this->db->where('tahsil_id' ,$tahsil_id);
       return $this->db->update(TAHSIL_MASTER,$data);
    }

    public function deletetahsil( $delete_id='')
    {
        $this->db->where('tahsil_id' , $delete_id);
        return $this->db->delete(TAHSIL_MASTER);
    }

}