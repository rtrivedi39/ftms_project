<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<?php 
$is_csu = false;
if($this->input->get('for') != '' && $this->input->get('for') == 'csu'){
	$is_csu = true;
	$start_date = $this->input->get('s_date');
	$end_date = $this->input->get('e_date');
	$scan_emp  = $this->input->get('emp');
}



?>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->    

       <div class="col-xs-12" id="divname1">
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title"><?php echo $is_csu == true ? getemployeeName($scan_emp, true) : $result_data[0]->emp_name  ;?></h3>
                    <div class="box-tools pull-right no-print">
                        <button onclick="printContent('divname1')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
				<div class="box-body">
                    <table class="table table-condensed stripeTable12">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Files</th>                  	
                        </tr>
                       <?php $i = 1; $total = 0;   
						if($is_csu == true ){
						  $query_csu = " SELECT count(distinct(fmove_file_id)) as Total_files , date(fmove_created_datetime) as date_created 
										FROM `ft_file_movements`
										join `ft_files` on  `ft_files`.file_id = `ft_file_movements`.fmove_file_id
										WHERE 
										scan_id != '' and `fmove_previous_user_id` = '$scan_emp' 
										and date(fmove_created_datetime) >= '$start_date' 
										and date(fmove_created_datetime) <= '$end_date'
										group by date(fmove_created_datetime)";
							$qry_emp = $this->db->query($query_csu);
							$result_data = $qry_emp->result();						
						}
					   foreach($result_data as $row){ ?>
							<tr>
								<td class="text-center"><?php echo $i ;?>. </td>
								<td><?php echo get_date_formate($row->date_created);?></td>
								<td align="center">
								<?php if($is_csu == true){ ?>
									<?php echo $row->Total_files; ?>
								<?php } else { ?>									
									<a href="<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?emp=<?php echo $this->input->get('emp'); ?>&t=all&s_date=<?php echo $row->date_created; ?>&e_date=<?php echo $row->date_created;?>"><?php echo $row->Total_files; ?></a>
								<?php }?>
								</td>
							</tr>
                        <?php  $i++;  $total =  $total + $row->Total_files; 
						} ?>
							<tr>
								<td colspan="2" align="center"><b>Total</b></td>
								<td align="center"><b><?php echo $total; ?></b></td>
							</tr>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!-- Main row -->
</section><!-- /.content -->
<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script>
    function showpage(comp1)
    {
        window.location=comp1;
    }
</script>

