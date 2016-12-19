
<section class="content-header">
    <h1><?php echo $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>leave/"><i class="fa fa-index"></i> Leave</a></li>
        <li class="active">Print</li>
    </ol>
</section>
<?php
$depart = 'म.प्र. शासन विधि और विधायी कार्य विभाग, भोपाल';
$now = date('d/m/Y');
$user_details = get_user_details($leave_details->emp_id);
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="no-print">  
                <p class="alert alert-info">
                    प्रिंट निकालने के लिए 'प्रिंट' का बटन दबायें, और प्रिंट की कॉपी यदि आवश्यक हो तो स्थापना शाखा में जमा करें|</p>      
            </div> 
            <div style="border:1px dashed #333; padding:20px;">  
                <?php $details = get_section_employee(7,8); 
                foreach($details as $row){
                    $emp_name =  $row->emp_full_name;
                } 
                ?>
                <div class="row">          
                    <div class="col-md-12 text-center">
                        <h3><?php echo $depart; ?></h3>
                        <h4>// आदेश //</h4>      
                        <label> --------- </label>
                    </div>
                </div>      
                <div class="row">          
                    <div class="col-md-12 text-left">
                        <table class="table borderless">
                            <tr><td class="text-right">भोपाल दिनांक <?php echo get_date_formate($leave_details->emp_leave_approvel_date); ?></td></tr>
                            <tr>
                                <td>
                                    <p>
                                        क्रमांक .............../21-अ(स्था.)  <b><?php echo $user_details[0]->emp_full_name; ?></b> को दिनांक <?php echo get_date_formate($leave_details->emp_leave_date); ?>
                                        से <?php echo get_date_formate($leave_details->emp_leave_end_date); ?> दिनांक तक <?php echo $leave_details->emp_leave_no_of_days; ?> दिवस का <?php echo leaveType($leave_details->emp_leave_type, true); ?>
                                        <?php echo ($leave_details->emp_leave_is_HQ) == 1 ? 'मुख्यालय छोड़ने की अनुमति सहित' : ''; ?> स्वीकृत किया जाता है|
                                    </p>
                                    <p class="indent">
                                        उक्त अवकाश स्वीकृति उपरांत उन्हें दिनांक तक <?php
                                        echo $leave_details->emp_leave_type == 'el' ?
                                                calculate_el(get_leave_balance($user_details[0]->emp_id, 'el')) :
                                                get_leave_balance($user_details[0]->emp_id, 'hpl');
                                        ?> दिवस के 
                                        <?php echo leaveType($leave_details->emp_leave_type, true); ?> की पात्रता रहेगी |
                                    </p>
                                    <p class="indent">
                                        प्रमाणित किया जाता है की यदि  <b><?php echo $user_details[0]->emp_full_name; ?></b>, अवकाश पर नहीं जाते तो अपने पद पर कार्य करते रहते |
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    (सचिव विधि द्वारा अनुमोदित)
                                </td>
                            </tr>
                            
                            <tr><td class="text-right">(<?php echo $emp_name ; ?>)</td></tr>
                            <tr><td class="text-right">अनुभाग अधिकारी</td></tr>
                            <tr><td class="text-right"><?php echo $depart; ?></td></tr>
                            <br/>
                            <tr>
                                <td>प्र. क्रमांक ............../21-अ(स्था.)</td>
                            </tr>
                            <tr>
                                <td class="text-right">भोपाल दिनांक <?php echo get_date_formate($leave_details->emp_leave_approvel_date); ?></td>
                            </tr>
                            <tr>
                                <td>1.  <b><?php echo $user_details[0]->emp_full_name; ?>, <?php echo getemployeeRole($user_details[0]->role_id); ?></b></td>
                            </tr>
                            <tr>
                                <td>2. पे-लिपिक,</td>
                            </tr>
                            <tr>
                                <td>की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु |</td>
                            </tr>
                            
                            <tr><td class="text-right">(<?php echo $emp_name ; ?>)</td></tr>
                            <tr><td class="text-right">अनुभाग अधिकारी</td></tr>
                            <tr><td class="text-right"><?php echo $depart; ?></td></tr>
                        </table>
                    </div>
                </div>   
            </div>
            <div class="row no-print">   
                <hr/>       
                <div class="col-md-3 text-center">
                    <button type="button" onclick="print_content()" class="btn btn-primary" name="">प्रिंट करे</button>
                </div>
                <div class="col-md-3 text-center">

                </div>
                <div class="col-md-3 text-center">

                </div>
                <div class="col-md-3 text-center">

                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


