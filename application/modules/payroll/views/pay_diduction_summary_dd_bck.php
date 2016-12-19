
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php  $dd_key = $this->uri->segment(3);
echo  $this->lang->line($dd_key );
         ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">  <?php  $dd_key = $this->uri->segment(3);$emp_id = $this->uri->segment(4);
echo  $this->lang->line($dd_key );
         ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
        <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                        <h3 class="box-title"><?php// echo "माह मार्च 2015 के वेतन में सा0भ0नि0 अंशदान में राशि बढाये जाने के संबंध मे।  " ?></h3>                 
                    </div>
                   
                    <div class="box-body">
                       <h1>      <?php  $dd_key = $this->uri->segment(3);
echo  $this->lang->line($dd_key );
         ?>    </h1><div class="box-tools pull-right">
                       <!--<button class="btn btn-block btn-info">Mark File</button>-->
                        <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
                           <table  class="display" cellspacing="0" width="100%">

<tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr>
  <?php $emp_id = $this->uri->segment("3"); if($emp_id == 1){ ?>

  <tr style="text-align:center">
    <td colspan="32">
      <h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का न्यायिक सेवा  
        अधिकारियों का वेतन पत्रक कम्प्यूटर देयक क्रमांक 
        <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   दिनांक 
          <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>   दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?> </h2></td>
  
    </tr>
    <?php }elseif($emp_id == 4){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?>
     2016 का चतुर्थ श्रेणी कर्मचारियों का वेतन विवरण पत्रक
       कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   
            दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
        <?php }elseif($emp_id == 2){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 
      2016 का  परिभाषहित अशंदान  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक
         <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक  
        <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?> ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  
        <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

   <?php }elseif($emp_id == 3){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
     <?php }elseif($emp_id == 9){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
   <?php }elseif($emp_id == 10){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
   <?php }elseif($emp_id == 11){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
     <?php }elseif($emp_id == 12){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
  
<?php }elseif($emp_id == 7 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: 29-2014 न्याय  प्रशासन 3428 चतुर्थ श्रेणी कर्मचारियों का माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

<?php }elseif($emp_id == 6 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: श्री दिनेश कुमार कुमरे  का वेतन 29-2014 से आहरण अंशदायी होने के कारन पृथक से बनाया जा रहा है | वेतन माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

<?php }elseif($emp_id == 5 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माँग संख्या 29-2014 न्याय प्रशासन 114-3428 महाधिवक्ता कायार्लय  वेतन देयक तृतीय श्रेणी कर्मचारी का 
   माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

    <?php }elseif($emp_id == 8 ){ ?>
  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का  परिभाषहित अशंदान  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

    <?php }?>
    
</table>
               <table id="maintable" class="table table-bordered table-striped dataTable no-footer" >
<thead>   <tr>
                    <th width='15%'> </th>
                                    <th width='25%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th width="20%"><?php echo $this->lang->line('emp_name'); ?></th>
                                  <th width="20%"><?php echo $this->lang->line('basic_pay'); ?></th>
                           
                          
                                    <th width='25%'><?php echo  $this->lang->line($dd_key ); ?></th>
                                   
                                </tr>
  </thead>                  <?php $k =0; foreach ($pay_salary as $key => $pay) { $k++;


                                  if($dd_key == "pay_gpf"){$dd =$pay->pay_gpf; }
                                    elseif($dd_key == "pay_dpf"){$dd =$pay->pay_dpf; }
                                       elseif($dd_key == "pay_gias"){$dd =$pay->pay_gias ;}
                                         elseif($dd_key == "pay_defined_contribution"){$dd =$pay->pay_defined_contribution; }
                                           elseif($dd_key == "pay_house_loan"){$dd =$pay->pay_house_loan; }
                                             elseif($dd_key == "pay_car_loan"){$dd =$pay->pay_car_loan ;} 
                                              elseif($dd_key == "pay_house_rent"){$dd =$pay->pay_house_rent ;}
                                                elseif($dd_key == "pay_fuel_charge"){$dd =$pay->pay_fuel_charge; }
                                                  elseif($dd_key == "pay_festival_adv"){$dd =$pay->pay_festival_adv ;}
                                                    elseif($dd_key == "pay_grain_adv"){$dd =$pay->pay_grain_adv; }
                                          elseif($dd_key == "pay_professional_tax"){$dd =$pay->pay_professional_tax; }
                                                  elseif($dd_key == "pay_income_tax"){$dd =$pay->pay_income_tax; }
                                                                ?> 
                                      ?>
                          <tr id="<?php echo $pay->pay_id; ?>">
                           

                                  <td ><?php echo $k;?></td>
                                    <td width='25%'><?php echo $pay->pay_emp_unique_id;  ?></td>
                                 <td ><?php echo emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                     <td ><?php echo $pay->pay_total?></td>
                                 <td width='25%'> <?php echo $dd; ?></td>
                                </tr>
                         
  <?php }  ?><tfoot>
      <tr style="
    background-color: #8BC34A;
    font-size: 16px;
    font-weight: bold;    color: #000;">

                                  
                              
                                    <th width="10%"></th>
                                     <th width="10%"></th>
                                     <th width="10%">Total </th>
                    <th width='25%'><?php echo "";//sumcolumn('pay_total' ,$this->uri->segment("3"),$this->uri->segment("5"))['val']; ?></th>
                                    

                                    <th width='25%'><?php echo  "";//sumcolumn($dd_key ,$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?></th>
                                    

                                </tr></tfoot>

                    
</table>

                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">अवकाश स्वीकृत करें</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>leave/leave_approve/approve" accept-charset="UTF-8" role="form" class="form-signin" method="post" id="aer">
                    <div class="modal-body">
					<h3>बचे हुए अवकाश</h3>
					<div class="user_leave_details"></div>
						<input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश स्वीकृति का कारण</label>
                        <textarea name="approve_reson" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btnapprove">जमा करें</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- Modal deny-->
<div class="modal fade" id="denyModal" tabindex="-1" role="dialog" aria-labelledby="denyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('pay_slip')?></h4>
            </div>
            <div class="modal-body">
                <form action="" >
                    <div class="modal-body">
					<h3><?php ?></h3>
						<div class="user_leave_details"></div>
                        <input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश अस्वीकृति का कारण</label>
                        <textarea name="deny_reson" class="form-control" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btndeny">जमा करे</button>
                    </div>
                </form>
            </div>      
        </div>
    </div>
</div>
<script type="text/javascript">
    function is_delete() {
        var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
        if (res === false) {
            return false;
        }
    }



</script>
