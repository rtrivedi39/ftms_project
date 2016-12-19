<style>
    td{ padding: 10px; }
    th{ padding: 10px; }
</style>

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
    <div class="box box-primary" id="">
        <div class="box-header no-print">
            <h3 class="box-title">कार्य  की रिपोर्ट देखें</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-warning no-print" onclick="goBack()">पिछले पेज पर जाये</button> 
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 no-print">
                    <form role="form" method="post" id="report_form" action="<?php echo base_url('work_done_report')?>"  enctype="multipart/form-data">
                       <div class="row">
						    <?php  $section_emps = explode(',',$this->session->userdata('emp_section_id'));  ?>						
							<div class="col-md-3">
								<select name="emp_section_name" class="form-control" id="emp_sections" required>
								   <option value="">अनुभाग  चुने</option>
								   <?php if($this->session->userdata('user_role') < 8 ) { ?>
								   <option value="officers"> अधिकारी  </option>
								   <option value="pa"> निज सहायक/ निज सचिव  </option>
								   <?php } ?>
									<?php  foreach($section_emps as $values) { ?>
										<option value="<?php echo $values; ?>"> <?php echo getSection($values); ?> </option>
									<?php }?>
								</select>
							</div>
							<div class="col-md-3">
								<select name="user_type" class="form-control" id="employee_list_section">
									<option value="">कर्मचारी चुने</option>
									<?php if($this->session->userdata('user_role') < 8 || $this->session->userdata('user_role') == 37) { ?>
									<option value="all">सभी कर्मचारी</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<select name="report_type" id="report_type" class="form-control" required>
										<option value="">---प्रकार चुने---</option>
										<option value="year">वर्ष</option>
										<option value="month">माह</option>
										<option value="date">दिन</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select name="report_section_type" id="report_section_type" class="form-control" required>
										<option value="">---प्रकार चुने---</option>
										<option value="all_section">सभी अंकित अनुभाग</option>
										<option value="onlysection">चयनित अनुभाग </option>
									</select>
								</div>
							</div>
							
						</div>	<br/>					
						<div class="row">							
							<div class="col-md-3" id="report_year">
								<div class="form-group">
									<select class="form-control" name="report_year" >
										<option value="">---वर्ष चुने---</option>
										<?php $year = date('Y'); $i = '2015'; 
											while($i <= date('Y')) { ?>
											<option value="<?php echo $i ; ?>" <?php echo $year == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
										<?php $i++; } ?>
									</select>
								</div>								
							</div>
							<div class="col-md-3" id="report_month">
								<div class="form-group">
									<select class="form-control" name="report_month">
										<option value="">---माह चुने---</option>
										<?php $month = date('m');
										foreach(months(null, true) as  $key => $value) { ?>
											<option value="<?php echo $key ; ?>" <?php echo $key == $month ? 'selected' : ''; ?>><?php echo $value ;?></option>
										<?php  } ?>
									</select>
								</div>								
							</div>

							
							<div class="col-md-3" id="report_date">
								<label>दिनांक</label>
								<div class="form-group"  >
									<input type="text" name="report_date" class="form-control date1"  value="<?php echo date('d-m-Y'); ?>" placeholder="Select  date" class="form-control">
								</div>
							</div>
							<div class="col-md-3" id="report_date_end">
								<label>दिनांक तक</label>
								<div class="form-group"  >
									<input type="text" name="report_date_end" class="form-control date1"  value="<?php echo date('d-m-Y') ; ?>" placeholder="Select  date" class="form-control">
								</div>
							</div>
							
							<div class="col-md-2 pull-right">
								<button type="submit" class="btn btn-primary" id="btn_submit">खोजे</button>
							</div>
						</div>
                    </form>
                </div><!-- /.col-12 -->
             </div><!-- /.row -->
       </div><!-- /.box-body -->
</div><!-- /.box -->
		
	<?php 
	if(count($work_report_list) > 0 ){ 
		$total_work = 0; 
			if($form_input['report_type'] == 'year'){
				$title_name =  'वर्ष '.$form_input['report_year'];
			} else if($form_input['report_type'] == 'month'){
				$title_name =  months($form_input['report_month'],true).', '.$form_input['report_year'];
			} else if($form_input['report_type'] == 'date'){
				if($form_input['report_date'] != $form_input['report_date_end']){ 
					$title_name =  'दिनांक';
				} else{
					$title_name =  'दिनांक '.get_date_formate($form_input['report_date'], 'd-m-Y');
				}
			}else {
				$title_name =  '';
			}
			?>	
		<div class="box box-warning" id="work_done_report">
			<div class="box-header">
				<h3 class="box-title text-center"><?php echo $title_name; ?> में शासकीय सेवको द्वारा  किया गया कार्य का विवरण| Run Date:- <?php echo date('d-m-Y h:i:s A') ; ?></h3>
				<div class="box-tools pull-right">
					<button onclick="print_content('work_done_report')" class="btn btn-primary no-print">प्रिंट</button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body" id="">	
				<table class="table table-condensed">
					<tr>
						<th class="text-center">क्रमांक</th>						
						<th class="text-center">नाम </th>
						<?php if($form_input['report_date'] != $form_input['report_date_end']){ ?>
							<th class="text-center">दिनांक </th>
						<?php }?>
						<th class="text-center">कुल नस्तियां </th>
					</tr>
					<?php $i = 1;				
						foreach($work_report_list as $key => $value ){ ?>
							<tr>
								<td class="text-center"><?php echo $i; ?></td>								
								<td class="text-left"><?php echo $value->user_title.' '.$value->user_name; ?></td>
								<?php if($form_input['report_date'] != $form_input['report_date_end']){ ?>
									<td class="text-center"><?php echo get_date_formate($value->from_date,'d.m.Y'); ?></td>
								<?php }?>
								<td class="text-center"><?php echo $value->files_deal; ?></td>
							</tr>
							<?php 
							$total_work = $total_work + $value->files_deal;
						
							$i++; 
						} ?>
					<?php if ($form_input['report_type'] == 'date') {?>
					<tr class="bg-info">
						<th colspan="<?php echo ($form_input['report_type'] != $form_input['report_date_end']) ? '3' : '2' ; ?>" class="text-center"><b>Grand Total</b></th>
						<th class="text-center"><b><?php echo $total_work; ?></b></th>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	<?php
	}
	?>
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
	function daysdiff(a, b) {
        var c = 24 * 60 * 60 * 1000,
        diffDays = Math.round(Math.abs((a - b) / (c)));
        return diffDays;        
    }

$(function () {
	$('#report_year,#report_month,#report_date,#report_date_end').hide();
    $("#report_type").change(function () {
		var types = $(this).val();
		var empsec = $('#employee_list_section').val();
		
		if(types == 'year'){
			$('#report_date,#report_month,#report_date_end').hide();
			$('#report_year').show();
		}
		else if(types == 'month'){
			$('#report_year,#report_month').show();
			$('#report_date,#report_date_end').hide();
		}
		else if(types == 'date'){
			$('#report_year,#report_month').hide();
			$('#report_date').show();
			if(empsec != 'all' ){
				$('#report_date_end').show();
			}else{
				$('#report_date_end').hide();
			}
		}else{
			$('#report_year,#report_month,#report_date,#report_date_end').hide();
		}
	});

	 $("#employee_list_section").on('change',function () {
	 	 var types = $(this).val();
	 	 var report_types = $('#report_type').val();
	 	 if(types != 'all' && report_types == 'date' && types != ''){
				$('#report_date_end').show();
			}else{
				$('#report_date_end').hide();
			}
	 });
		
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
                if(section_id != 'officers' && section_id != 'pa'){
                	$('#report_section_type').val('');
                	/*$("#report_section_type").append(new Option("चयनित अनुभाग", "onlysection"));*/
                	
				<?php if($this->session->userdata('user_role') < 9 || $this->session->userdata('user_role') == 37 ) { ?>
					otpt += '<option value="all">सभी कर्मचारी</option>';
                <?php } ?>
                	otpt += '<option value="<?php echo $this->session->userdata('emp_id'); ?>">स्वयं</option>';  
                } else {
                	$('#report_section_type').val('all_section');
                	/*$("#report_section_type").remove(new Option("चयनित अनुभाग", "onlysection"));*/
                }
                $.each(r_data, function( index, value ) {
                    /*console.log(value);*/
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
});
	
	
</script>
