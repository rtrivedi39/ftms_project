<?php $this->load->view('header');?>

 <!--<div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                <h4>कल दिनांक 2/6/2016 को माननीय मुख्य सचिव महोदय कार्यालय मे उपस्थित हो रहे है| </h4>
                <h4>समस्त अधिकारी/कर्मचारी सुबह 10:15 बजे कार्यालय मे अनिवार्य रूप से उपस्थित हो|</h4>
                <h5 align="right">प्रमुख सचिव महोदय के आदेशानुसार</h5>
            </div>
        </div>
    </div>-->

<?php if(!empty(get_employees_brthdays(true))){ ?>
	<!--<div class="row" onclick="window.open('<?php base_url(); ?>/ftms/themes/happy_birhday/index.html', 'newwindow', 'width=800, height=500'); return false;">-->
         <div class="row">
			 <div class="col-md-12">
             <div class="alert alert-success text-center">
                <h4> विधि एवं विधायी कार्य विभाग की ओर से 
                      <?php   foreach(get_employees_brthdays(true) as $row){
                            $bdays[] = getemployeeName($row->emp_id, true);
                        }
                        echo "** ".implode(" और ",  $bdays)." ** ";
                        ?>
					जी को जन्मदिवस की बहुत बहुत शुभकामनायें |</h4>
            </div>
            </div>
		<!--</div>-->
    </div>
    <?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <h4 class="text-center" style="color:red;"><?php echo $this->lang->line('notice'); ?>:</h4> 
             <div style="width:auto;">
				 <marquee behavior="alternate" scrollamount="1"> 
			        <img src="http://10.115.254.213//themes/site/images/gif-new.gif">
				  <b style="color:blue;" title="पविभाग का कार्य सुचारू रूप  से कराये जाने के सम्बन्ध में">
					विभाग का कार्य सुचारू रूप  से कराये जाने के सम्बन्ध में
					<a title="Download" target="_blank" href="uploads/notice/depatment_work.pdf">
						<span class="glyphicon glyphicon-paperclip"></span>
					</a> 
					</b>  
				</marquee><br> 
			</div>
			
			<?php $est_noticed = getNoticeBoardInformation_from_est(); ?>
			<?php if(count($est_noticed) >0){ ?>
				<div style="width:auto;">
				<marquee behavior="alternate" scrollamount="1">
					<img src="<?php echo base_url(); ?>/themes/site/images/gif-new.gif"/>
					<b style="color:blue;" title="<?php echo $est_noticed[0]['notice_description'];?>">   
						<?php echo $est_noticed[0]['notice_subject'];?>
						<?php if($est_noticed[0]['notice_attachment']!=''){?>
							<a title="Download" target="_blank" href="uploads/notice/<?php echo $est_noticed[0]['notice_attachment'];?>"><span class="glyphicon glyphicon-paperclip"></span></a>
						<?php } ?>
				   </b>				   
				</marquee><br/>
				</div>
			<?php } ?>
            <!--<marquee behavior="alternate"  scrollamount="1">
                <b style="color:blue;">   
					यह पोर्टल अवकाश और फाइल दोनों के लिए है |  अवकाश का लॉग इन भी इसी पोर्टल से करें | आपका पासवर्ड फाइल पोर्टल का पासवर्ड ही है|
			   </b>	
            </marquee>	-->			
            <marquee behavior="alternate"  scrollamount="1">
                <b style="color:blue;">   
					यदि आप अवकाश का आवेदन करना चाहते है तो <a href="http://10.115.254.213/lms">अवकाश</a> इस लिंक पर क्लिक करें'|
			   </b>	     
             <!--   <b style="color:red;">   
					<p class="text-danger">प्रमुख सचिव के आदेशानुसार समस्त कर्मचारी/अधिकारी कार्यालय में पान, गुटखा, सिगरेट, बीड़ी न रखें और ना ही इनका सेवन करेंगे! <br>उल्लंघन करने पर अनुशासनात्मक कार्यवाही की जाएगी|</p>
			   </b>	-->
            </marquee>
		
        </div>
    </div> 
   <div class="col-md-12 text-center">
		<a class="label label-warning" target="_blank"  href="<?php echo base_url(); ?>uploads/User Manual for File Tracking System.pdf" >यूजर मैन्युअल</a> 
		<a class="label label-danger"  href="<?php echo base_url(); ?>lms2/faq" >अवकाश आवेदन के सम्बन्ध में आवश्यक सूचना |</a> 
		<a class="label label-success" target="_blank"  href="<?php echo base_url(); ?>lms2/uploads/video/LMS-1.wmv" >अधिक जानकारी के लिये  यह विडिओ देखे |</a> 
		<a class="label label-warning" target="_blank"  href="<?php echo base_url(); ?>lms2/uploads/Leave Management Application.pdf" >यूजर मैन्युअल</a> 
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><?php echo $this->lang->line('login_panel'); ?></div>
            <div class="panel-body">
			<p class="text-danger">कृपया अपने पासवर्ड में बदलाव जरुर करते रहें | </p>
                <?php
                //message if error
                if (isset($message_error) && $message_error) {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo $this->lang->line('singin_error_message');
                    echo '</div>';
                }
                if (isset($status_error) && $status_error) {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo $status_error_message;
                    echo '</div>';
                }
                if (isset($retire_error) && $retire_error) {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo $this->lang->line('retire_error_message');
                    echo '</div>';
                }
                $attributes = array('class' => 'form-signin', 'id' => 'formSignin');
                echo form_open('login', $attributes);
                //input user name
                $emp_login_id = array(
                    'name' => 'emp_login_id',
                    'id' => 'emploginId',
                    'value' => '',
                    'maxlength' => '50',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => $this->lang->line('login_user_id_placeholder'),
                    'value' => isset($emp_login_id_val) ? $emp_login_id_val : '',
                );
                echo '<div class="form-group">';
                echo '<label for="emp_login_id">' . $this->lang->line('home_login_id') . '</label>';
                echo form_input($emp_login_id);
                echo form_error('emp_login_id');
                echo '</div>';
                //input password
                $emp_password = array(
                    'name' => 'emp_password',
                    'id' => 'empPassword',
                    'value' => '',
                    'maxlength' => '50',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                );
                echo '<div class="form-group">';
                echo '<label for="emp_password">' . $this->lang->line('home_password') . '</label>';
                echo form_password($emp_password);
                echo form_error('emp_password');
                echo '</div>';
                echo form_submit('submit', $this->lang->line('home_sign_in'), 'class="btn  btn-primary"');
                echo form_close();
                echo br();
                echo anchor('forgote_password', $this->lang->line('home_forgot_password'), 'title="' . $this->lang->line('home_forgot_password') . '"');
                ?>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><?php   echo $this->lang->line('calender_time'); ?></div>
            <div class="panel-body">
                <!--calender start-->
                <?php
                /* Set the default timezone */
                date_default_timezone_set("Asia/Kolkata");
                /* Set the date */
                $date = strtotime(date("Y-m-d"));
                $day = date('d', $date);
                $month = date('m', $date);
                $year = date('Y', $date);
                $firstDay = mktime(0, 0, 0, $month, 1, $year);
                $title = strftime('%B', $firstDay);
                $dayOfWeek = date('D', $firstDay);
                $daysInMonth = cal_days_in_month(0, $month, $year);
                /* Get the name of the week days */
                $timestamp = strtotime('next Sunday');
                $weekDays = array();
                for ($i = 0; $i < 7; $i++) {
                    $weekDays[] = strftime('%a', $timestamp);
                    $timestamp = strtotime('+1 day', $timestamp);
                }
                $blank = date('w', strtotime("{$year}-{$month}-01"));
                ?>
                <div align="center"><?php echo $title ?> <?php echo $year ?></div>
                <table class='table table-bordered' style="table-layout: fixed;"> <tr>
                            <?php foreach ($weekDays as $key => $weekDay) : ?>
                                <td style="padding: 2px;background-color: #dcdeed"><?php echo $weekDay ?></td>
                            <?php endforeach ?>
                        </tr>
                        <tr>
                            <?php for ($i = 0; $i < $blank; $i++): ?>
                                <td style="padding: 6px"></td>
                            <?php endfor; ?>
                            <?php for ($i = 1; $i <= $daysInMonth; $i++): ?>
                                <?php $i = strlen($i) == 1 ? '0'.$i : $i ;
                                        $on_date = $year.'-'.$month.'-'.$i;
                                if ($day == $i): ?>
                                    <td style="padding:6px; background: #337ab7; color: #ffffff">
                                        <strong><?php echo $i ?></strong>
                                    </td>
                                <?php elseif(in_array($on_date, holidays_2016())): ?>
                                     <td style="padding:6px; background: red; color: #ffffff" title="<?php echo holidays_name($on_date); ?>">
                                        <strong><?php echo $i ?></strong>
                                    </td>
                                <?php  else: ?>
                                    <td style="padding: 6px"><?php echo $i ?></td>
                                <?php endif; ?>
                                <?php if (($i + $blank) % 7 == 0): ?>
                                </tr><tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php for ($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++): ?>
                                <td style="padding: 6px"></td>
                            <?php endfor; ?>
                        </tr>
                    </table>
                <!--calender start-->
                <!--analog clock--->
                <div style="margin-left: 10%;"><canvas id="canvas"></canvas></div>
                <!--analog clock--->
            </div>
        </div>
    </div><!-- md-3 -->
    <div class="col-md-9">
        <div id="carousel-example-generic" class="carousel slide sliders" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>              
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>              
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>              
                     
                     
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox"> 
           
				
                <div class="item active">
                    <img src="<?php echo base_url(); ?>themes/site/images/slider/rs1.jpg" alt="slider11">
                    <div class="carousel-caption">
                        <h3>विधि विभाग, भोपाल, मध्यप्रदेश</h3> 
                        <p>...</p>
                    </div>
                </div>
				<div class="item">
                    <img src="<?php echo base_url(); ?>themes/site/images/slider/rs2.jpg" alt="slider22">
                    <div class="carousel-caption">
                        <h3>विधि विभाग, भोपाल, मध्यप्रदेश</h3>
                        <p>...</p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo base_url(); ?>themes/site/images/slider/rs3.jpg" alt="slider22">
                    <div class="carousel-caption">
                        <h3>विधि विभाग, भोपाल, मध्यप्रदेश</h3>
                        <p>...</p>
                    </div>
                 </div>
				 <div class="item">
                    <img src="<?php echo base_url(); ?>themes/site/images/slider/rs4.jpg" alt="slider22">
                    <div class="carousel-caption">
                        <h3>विधि विभाग, भोपाल, मध्यप्रदेश</h3>
                        <p>...</p>
                    </div>
                 </div>
               
						
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br/>        
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><?php echo $this->lang->line('notice_board_panel'); ?></div>
            <div class="panel-body">


                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center"><?php echo $this->lang->line('law_deptartment'); ?></div>
                        <div class="panel-body notice-board-box">
                            <?php
                            if (isset($notice) && !empty($notice)) {
                                foreach ($notice as $notice) {
                                    ?>
                                    <div class="btn-default" style="border-bottom: 1px solid gray;padding: 5px">
                                        <b><?php echo $notice['notice_subject']; ?> : </b> <?php echo $notice['notice_description']; ?>
                                        <?php if ($notice['notice_attachment'] != Null) { ?>
                                            <a href="<?php base_url(); ?>uploads/notice/<?php echo $notice['notice_attachment']; ?>" target="_blank" title="Download"><span class="glyphicon glyphicon-paperclip"></span></a>
                                        <?php } ?>
                                    </div>
                                    <?php
                                } 
                            } else {
                                echo $this->lang->line('notice_board_empty');
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                        <div class="panel-heading text-center"><?php echo $this->lang->line('leave_on_today'); ?></div>
                        <div class="panel-body notice-board-box">
                            <table width="100%">
                               <tr>
                                    <th><?php echo $this->lang->line('uid'); ?></th>
                                    <th><?php echo $this->lang->line('name'); ?></th>
                                    <th><?php echo $this->lang->line('post'); ?></th>
									<th><?php echo $this->lang->line('leave_half_type_on'); ?> </th>
                                </tr>
                                <?php if(user_leave_today()){
                                    foreach(user_leave_today() as $row){
										$gender =  $row->emp_detail_gender;
										if($gender == 'm'){
											$gender =  'श्री';															
										}
										if($gender == 'f'){
											$gender = 'सुश्री';		
										}
                                        if($row->emp_leave_type != 'hq'){
                                            echo "<tr>";
                                            echo "<td>".$row->emp_unique_id."</td>";
                                            echo "<td>".$gender.' '.$row->emp_full_name_hi."</td>";
                                            echo "<td>".getemployeeRole($row->designation_id)."</td>";
                                            echo "<td>".(!empty($row->emp_leave_half_type) ? ($row->emp_leave_half_type == 'FH' ? $this->lang->line('first_half') : $this->lang->line('second_half')) : '-') ."</td>";
    										echo "</tr>";
                                        }
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='4'>अवकाश  पोर्टल देखे </td>";
                                    echo "</tr>";
                                } ?>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center"><?php echo $this->lang->line('this_week_birthday'); ?></div>
                        <div class="panel-body notice-board-box">
                            <table width="100%">
                              <tr>
                                    <th><?php   echo $this->lang->line('name'); ?></th>
                                    <th><?php   echo $this->lang->line('post'); ?></th>
                                    <th><?php   echo $this->lang->line('birthday_date'); ?></th>
                                </tr>
                                <?php if(get_employees_brthdays()){
                                    foreach(get_employees_brthdays() as $row){
									$gender =  $row->emp_detail_gender;
										if($gender == 'm'){
											$gender =  'श्री';															
										}
										if($gender == 'f'){
											$gender = 'सुश्री';		
										}
                                        echo "<tr>";
                                        echo "<td>".$gender.' '.$row->emp_full_name_hi."</td>";
                                        echo "<td>".getemployeeRole($row->designation_id)."</td>";
                                        echo "<td>".get_date_formate($row->emp_detail_dob,'d F')."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='3'>".$this->lang->line('no_birthdays')."</td>";
                                    echo "</tr>";
                                } ?>
                                
                            </table>
                        </div>
                    </div>
                </div>

                 <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center"><?php echo $this->lang->line('retirement_this_month'); ?></div>
                        <div class="panel-body notice-board-box">
                            <table width="100%">
                                <tr>
                                    <th><?php   echo $this->lang->line('name'); ?></th>
                                    <th><?php   echo $this->lang->line('post'); ?></th>
                                </tr>
                                <?php if(get_employees_retirements()){
                                    foreach(get_employees_retirements() as $row){
                                        $gender =  $row->emp_detail_gender;
                                        if($gender == 'm'){
                                            $gender =  'श्री';                                                          
                                        }
                                        if($gender == 'f'){
                                            $gender = 'सुश्री';     
                                        }
                                        echo "<tr>";
                                        echo "<td>".$gender.' '.$row->emp_full_name_hi."</td>";
                                        echo "<td>".getemployeeRole($row->role_id)."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='3'>".$this->lang->line('no_retirement')."</td>";
                                    echo "</tr>";
                                } ?>
                                
                            </table>
                        </div>
                    </div>
                </div>

				<div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">विभाग में दिनांक <?php echo date('d-m-Y'); ?> को देरी से उपस्थित हुए कर्मचारी </div>
                        <div class="panel-body notice-board-box">
                            <table width="100%">
                                <tr>
                                    <th>Name</th>
                                    <th>Time</th>
                                </tr>
                                <?php 
                                $today = date('d-m-Y');
                                $get_biometric_report = get_bio_report($today,'lt');
                                if($get_biometric_report){ 
                                    foreach ( $get_biometric_report as $report ){ ?>
                                        <tr>
                                            <td><?php echo ($report->emp_full_name_hi == null ? $report->bio_user_name : $report->emp_title_hi.' '.$report->emp_full_name_hi); ?></td>
                                            <td><?php echo  get_datetime_formate($report->in_time,'h:i:s A'); ?>
                                        </tr>
                                    <?php 
                                    }
                                } else { 
                                ?>
                                    <tr>
                                        <td colspan='3'><?php echo $this->lang->line('no_record_found_label'); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center"><?php echo $this->lang->line('outof_dept_menu'); ?> / अनुमति</div>
                        <div class="panel-body notice-board-box">
                            <table width="100%">
                                <tr>
                                    <th><?php  echo $this->lang->line('name'); ?> / <?php   echo $this->lang->line('post'); ?></th>
                                    <th>कब</th>
                                    <th>स्वीकृतकर्ता</th>
                                </tr>
                                <?php $crnt_time = date('H:i:s');
								$get_data = array('DATE(report_when_go)' => date('Y-m-d') , 'TIME(report_when_go) <=' => $crnt_time, 'TIME(report_aprox_come) >=' => $crnt_time  , 'report_status != ' => 2);
								$get_out_dept_report = get_list(OUT_OF_DEPARTMENT_REPORT, 'TIME(report_when_go)' , $get_data , 'DESC');
								if($get_out_dept_report){
                                    foreach($get_out_dept_report as $key => $row){
                                        echo "<tr>";
                                        echo "<td>".getemployeeName($row['report_emp_id'], true).'/'.get_employee_role($row['report_emp_id'])." <i title='".$row['report_where_go']."' class='label label-info'>i</i></td>";
                                        echo "<td>". get_date_formate($row['report_when_go'],'d.m.Y h:i:s A')." (".$row['report_aprox_time']." मिनट)</td>";
                                        echo $row['report_status'] == 1 ? "<td>".getemployeeName($row['report_approval_emp_id'], true).'/'.get_employee_role($row['report_approval_emp_id'])."</td>" : "<td>-</td>" ;
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='3'>".$this->lang->line('no_record_found_label')."</td>";
                                    echo "</tr>";
                                } ?>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- md-9 -->
</div><!-- row -->

<?php $this->load->view('footer'); ?>
<script>
    // assumes you're using jQuery
    $(document).ready(function () {

	<?php if ($this->session->flashdata('pass_msg')) { ?>
				alert('<?php echo $this->session->flashdata("pass_msg"); ?>');
	<?php } ?>
	/* ------------ Birthday wishes ----------------------*/
	$("#whishes").on("click", function(e) {
	   alert('rfyg');
	});
	/* end */
});
</script>
<script src="<?php echo base_url(); ?>themes/admin/common_js/analogclock.js"></script>
