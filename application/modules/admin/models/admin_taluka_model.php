<?php
class Admin_taluka_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
	public function  getTalukafrom_district( $district_id = null )
    {

        $query = $this->db->get_where(TALUKA_MASTER,
            array(
                'district_id'=>$district_id
            )
        );
        return $query->result_array();
    }
	public function  getTalukafrom_taluka_id( $taluka_id = null )
    {

        $query = $this->db->get_where(TALUKA_MASTER,
            array(
                'taluka_id'=>$taluka_id
            )
        );
		//echo $this->db->last_query();
        return $query->result_array();
    }
    public function  gettalukaData($id)
    {

        $query = $this->db->get_where(TALUKA_MASTER,
            array(
                'district_id'=>$id
            )
        );
        return $query->row_array();
    }

    public function addTaluka($data)
    {
        //pr($data);
        $this->db->insert(TALUKA_MASTER, $data);
        return $this->db->insert_id();

    }

    public function updateTaluka($data , $taluka_id)
    {
       $this->db->where('taluka_id' ,$taluka_id);
       return $this->db->update(TALUKA_MASTER,$data);
    }

    public function deleteTaluka( $delete_id='')
    {
        $this->db->where('taluka_id' , $delete_id);
        return $this->db->delete(TALUKA_MASTER);
    }

}