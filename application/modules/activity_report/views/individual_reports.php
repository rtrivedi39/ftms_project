<style>
    td{ padding: 10px; }
    th{ padding: 10px; }
</style>
<?php $userid_r = $userid;
$marked_file =  current_pending_files($userid);
$choose_date = date('Y-m-d');

$sql = "SELECT count(file_id) as pending_file FROM `ft_files` WHERE file_hardcopy_status!='close' and `file_received_emp_id`='$userid_r'";
$query_log = $this->db->query($sql);
$marked = $query_log->row_array();

$query_log = $this->db->query("SELECT count(distinct(ft_file_movements.fmove_file_id)) as today_pending FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where file_received_emp_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date'  and `fmove_current_user_id`!=`fmove_previous_user_id` and ft_files.file_hardcopy_status != 'close'");
$marked_today = $query_log->row_array();

$query_log = $this->db->query("SELECT count(ft_file_movements.fmove_file_id) as today_dispatch FROM ft_file_movements join ft_files on ft_files.file_id = ft_file_movements.fmove_file_id where ft_file_movements.fmove_previous_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date' and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_file_movements.file_return = '2' and ft_files.file_hardcopy_status = 'close'))");
$today_dispatch = $query_log->row_array(); 


$query_log_master = $this->db->query("SELECT count(ft_file_movements_master.fmove_file_id) as today_dispatch_master FROM ft_file_movements_master join ft_files_master on ft_files_master.file_id = ft_file_movements_master.fmove_file_id where ft_file_movements_master.fmove_previous_user_id = '$userid_r' and date(`fmove_created_datetime`) = '$choose_date' and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_file_movements_master.file_return = '2' and ft_files_master.file_hardcopy_status = 'close'))");
$today_dispatch_master = $query_log_master->row_array();


$today_dispatch_all =  $today_dispatch['today_dispatch'] + $today_dispatch_master['today_dispatch_master']; 



?>
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section> 
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="box box-primary" id="divname1">
        <div class="box-header no-print">
            <h3 class="box-title"> अभी तक के कार्य का विवरण</h3>
            <div class="box-tools pull-right">
                <button onclick="print_content()" class="btn btn-primary no-print">प्रिंट</button>
                <button class="btn btn-warning no-print" onclick="goBack()">पिछले पेज पर जाये</button>
                <a href="<?php echo base_url(); ?>work_done_report" class="btn btn-primary no-print">कार्य की रिपोर्ट</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 no-print">
                    <form role="form" method="post" action="<?php echo base_url('individual_reports')?>"  enctype="multipart/form-data">
                        <?php  $section_emps = explode(',',$this->session->userdata('emp_section_id'));  ?>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <select name="emp_section_name" class="form-control" id="emp_sections">
                               <option value="">अधिकारी /  अनुभाग  चुने</option>
							   <option value="officers"> अधिकारी  </option>
                                <?php  foreach($section_emps as $values) { ?>
                                    <option value="<?php echo $values; ?>" <?php echo (isset($form_input['emp_section']) && $form_input['emp_section'] == $values) ? 'selected' : '';  ?>> <?php echo getSection($values); ?> </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="user_type" class="form-control" id="employee_list_section">
                                <option value="">कर्मचारी चुने</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" >खोजे</button>
                        </div>
                    </form>
                </div>
                <p><br/></p>
                <p><br/></p>
                <div class="text-center" style="font-size: 16px;">
                    नाम:- <b><?php echo getemployeeName($userid, true); ?> (<?php echo get_employee_role($userid); ?>)</b>
                </div>
                <p><br/></p>

                <!----->
                <div class="col-md-12">
                    <div class="text-center"><b> कुल अंकित फाइलें : <u><a title="click to show file" href="<?php echo base_url(); ?>reports/moniter?emp=<?php echo $userid; ?>"><span style="color: red;font-family: sans-serif;"><?php echo $marked_file['files_no']; ?></span></a></u></b></div>
                    <br/>
                    <table align="center">
                        <tr align="center">
                            <th>कुल लंबित फाइलें</th>
                            <th>आज निराकृत की गई फाइलें</th>
                            <th>किए गए कार्य का प्रतिशत </th>
                        </tr>
                        <tr align="center">
                            <td><?php   echo $total_file = $marked['pending_file']; ?></td>
                            <td><?php   echo $today_dispatch_all; ?></td>
                            <td>
                                <?php  $pending_work =  $total_file +  $today_dispatch_all ; ?>
                                <?php $formula = "(".$today_dispatch_all."/".$pending_work.")*100 :";  ?>
                                <b title="<?php echo $formula ; ?>"> <?php $pre = ($today_dispatch_all/$pending_work)*100 ; ?><?php echo sprintf ("%.2f", $pre); ?> %</b>
                            </td>
                        </tr>
                    </table>

                    <div align="center" style="font-size: 16px;margin-top: 30px;"><b>आज (<?php echo date('d/m/y');?>) को किए गए कार्य का % : <u><?php echo sprintf ("%.2f", $pre); ?> %</u></b></div>
                    <p><hr/></p>
                    <div align="center">कुल लंबित फाइल का विवरण</div>
                    <table align="center">
                        <tr align="center">
                           <!-- <td colspan="2">कुल : <?php /*echo $marked_file['files_no']; */?></td>-->
                            <td colspan="2">कुल : <?php echo $marked_file['files_no']; ?></td>
                            <td colspan="2">कुल : <?php echo $marked_file['files_no']; ?></td>
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
                    <br/>
                    <span class="text-red pull-right">Time : <?php echo date('d/m/y h:i a'); ?></span>
                </div>
                <?php unset($userid_r,$old_pending,$total_file,$marked,$marked_today,$today_dispatch,$marked_file,$today_dispatch_all); // unset varible ?>
            </div><!-- /.row -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $("#emp_sections").change(function () {
        var section_id = $(this).val();
        var HTTP_PATH = '<?php echo base_url(); ?>'; 
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "activity_report/get_emloyees_section",
            datatype: "json",
            async: false,
            data: {section_id: section_id},
            success: function(data) {
                var r_data = JSON.parse(data);                
                var otpt = '<option value="">Select employee/Section</option>';
                $.each(r_data, function( index, value ) {
                    console.log(value);
                    if(value.emp_detail_gender=='m'){
                        var fword_en='Shri';
                        var fword_hi='श्री';
                    }else if(value.emp_detail_gender=='f'){
                        var fword_en='shushri';
                        var fword_hi='सुश्री';
                    }
                    otpt += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+'('+value.emprole_name_hi+')</option>';
                });
                $("#employee_list_section").html(otpt);
            },
            complete: function(){
                $('#loading-image').hide();
            }
        });
    });
</script>
