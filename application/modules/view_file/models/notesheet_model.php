<?php

class Notesheet_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_notesheets($menu_id ,$document_type = null){
        if(!empty($document_type)){
			return get_list(NOTESHEET_MASTER,'notesheet_id',array('notesheet_type' => $menu_id ,'doc_type'=>$document_type));
		}else{
			return get_list(NOTESHEET_MASTER,'notesheet_id',array('notesheet_type' => $menu_id));                               
		}
    }
    
    public function view_notesheets($id){
       $this->db->select('notesheet_contents');
        if($id != ''){
            $this->db->where('flog_id', $id);
        }
        $query = $this->db->get(FILES_LOG);
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
            $rows =  $query->row();
            return $rows->notesheet_contents;
        } else {
            return false;
        }
    }


}

