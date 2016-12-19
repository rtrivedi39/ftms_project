<style>
    td{
        padding: 2px;
    }th{
         padding: 2px;
     }
</style>
<link href="<?php echo base_url(); ?>themes/e_file_style.css" rel="stylesheet" type="text/css" />
<?php
$marked_file =  current_pending_files();
$userid_r = emp_session_id();
$choose_date = date('Y-m-d');

/*$sql = "SELECT count(file_id) as pending_file FROM `ft_files` WHERE file_hardcopy_status!='close' and `file_received_emp_id`='$userid_r'";
$query_log = $this->db->query($sql);
$marked = $query_log->row_array();*/

$query_log = $this->db->query("SELECT count(distinct(ft_file_movements.fmove_file_id)) as today_pending FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where file_received_emp_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date'  and `fmove_current_user_id`!=`fmove_previous_user_id` and ft_files.file_hardcopy_status != 'close'");
$marked_today = $query_log->row_array();

//$query_log = $this->db->query("SELECT count(distinct(ft_file_movements.fmove_file_id)) as today_dispatch FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where ft_file_movements.fmove_previous_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date'  and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_files.file_hardcopy_status = 'close'))");
$query_log = $this->db->query("SELECT count(ft_file_movements.fmove_file_id) as today_dispatch FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where ft_file_movements.fmove_previous_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date' and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_file_movements.file_return = '2' and ft_files.file_hardcopy_status = 'close'))");
$today_dispatch = $query_log->row_array();

$query_log_master = $this->db->query("SELECT count(ft_file_movements_master.fmove_file_id) as today_dispatch_master FROM ft_file_movements_master join ft_files_master on ft_files_master.file_id = ft_file_movements_master.fmove_file_id where ft_file_movements_master.fmove_previous_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date' and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_file_movements_master.file_return = '2' and ft_files_master.file_hardcopy_status = 'close'))");
$today_dispatch_master = $query_log_master->row_array();


$today_dispatch_all =  $today_dispatch['today_dispatch'] + $today_dispatch_master['today_dispatch_master']; 






/*$select_data = $this->input->post('choose_date1');
if(isset($select_data) && $select_data != ''){
    $choose_date = date('Y-m-d',strtotime($select_data));
}else{
    $choose_date = date('Y-m-d');
}*/
?>
<button onclick="printContents('divcurr')" class="btn btn-primary no-print" style="float: right;">प्रिंट रिपोर्ट</button>
<div id="divcurr">
    <div align="center" class="onlyprint"><?php echo getemployeeName($userid_r,true); ?> (<?php echo get_employee_role($userid_r) ;?>) को अंकित फाइलें |</div>
    <div align="center" style="font-size: 16px;"><b> कुल अंकित फाइलें : <span style="color: red;font-family: sans-serif;"><u><?php echo $marked_file['files_no']; ?></u></span></b></div>
    <br/>
    <!-- <form method="post" action="">
        <div align="center">
            Date :<?php /*echo $choose_date;
            echo '<br/>';
            $dayback_1 =  date('Y-m-d', strtotime('-1 day', strtotime($choose_date)))
            */ ?>
            <br/>
            Choose Date : <input type="text" class="form-control date1" name= "choose_date1" value="<?php /*echo get_date_formate($choose_date,'d-m-Y'); */?>" placeholder="select date"/>
            <button type="submit" class="btn btn-primary" >खोजे</button>
        </div>
    </form>-->
    <?php /*  if($choose_date != date('Y-m-d')){
          $sql = "SELECT count(distinct(ft_file_movements.fmove_file_id)) as old_pending FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where ";
          $sql .= "((file_received_emp_id = '$userid_r' and date(`file_update_date`) < '$choose_date') || (ft_file_movements.fmove_current_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$dayback_1'))";
          $sql .= "and date(`fmove_created_datetime`) <= '$choose_date' and `fmove_current_user_id`!=`fmove_previous_user_id`";
      } else{

      }*/ ?>
    <table border="1px" cellspacing="0" align="center" width="100%" >
        <tr align="center" style="background: #91D096;">
            <th>कुल लंबित फाइलें</th>
            <th>आज निराकृत की गई फाइलें</th>
            <th>किए गए कार्य का प्रतिशत </th>
        </tr>
        <tr align="center" style="background: #BEDEDE;">
            <td><?php   echo $total_file = $marked_file['files_no']; ?></td>
            <td><?php   echo $today_dispatch_all ; ?></td>
            <td>
                <?php  $pending_work =  $total_file +  $today_dispatch_all ; ?>
              <?php $formula = "(".$today_dispatch_all."/".$pending_work.")*100 :";  ?>
                <b title="<?php echo $formula ; ?>"> <?php $pre = ($today_dispatch_all/$pending_work)*100 ; ?><?php echo sprintf ("%.2f", $pre); ?> %</b>
            </td>
        </tr>
    </table>
    <div align="center" style="font-size: 20px;margin-top: 30px;"><b>आज (<?php echo date('d/m/y');?>) किए गए कार्य का % : <u><?php echo sprintf ("%.2f", $pre); ?> %</u></b></div>
    <p><hr/></p>
    <div align="center">कुल लंबित फाइल का विवरण</div>
    <table align="center">

        <tr align="center">
            <!--<th colspan="2" style="border-bottom: 2px solid gray">कुल : <?php /*echo $marked_file['files_no']; */?></th>-->
            <th colspan="2" style="border-bottom: 2px solid gray;">कुल : <?php echo $marked_file['files_no']; ?></th>
            <th colspan="2" style="border-bottom: 2px solid gray;">कुल : <?php echo $marked_file['files_no']; ?></th>
        </tr>
        <tr align="center">
           <!-- <td>पुरानी अंकित फाइलें</td>
            <td>आज अंकित फाइलें </td>-->
            <td>प्रक्रियाधीन फाइलें</th>
            <td>प्राप्त नहीं की गई फाइलें</td>
            <td>भौतिक-फाइलें</td>
            <td>ई-फाइलें</td>
        </tr>
        <tr align="center">
           <!-- <td class="total_files_received">
                <?php /*  echo $old_pending = $marked_file['files_no']-$marked_today['today_pending']; */?>
            </td>
            <td>
                <?php /*  echo @$marked_today['today_pending'] ? $marked_today['today_pending'] : '0'; */?>
            </td>-->
            <td>
                <?php   echo @$marked_file['received'] ? $marked_file['received'] : '0'; ?>
            </td>
            <td>
                <?php   echo @$marked_file['noterceived'] ? $marked_file['noterceived'] : '0'; ?>
            </td>
            <td>
                <?php $pfile = $marked_file['files_no']-$marked_file['efile'];
                echo @$pfile ? $pfile: '0'; ?>
            </td>
            <td>
                <?php   echo @$marked_file['efile'] ? $marked_file['efile'] : '0' ; ?>
            </td>
        </tr>
    </table>
</div> 
<?php unset($userid_r,$old_pending,$total_file,$marked,$marked_today,$today_dispatch,$marked_file,$today_dispatch_all); // unset varible ?>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
	
    function printContents(data){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(data).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>