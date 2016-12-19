<script type="text/javascript">

 $(document).ready(function () {
          
            $('.dataTable').dataTable({
    "lengthMenu": [ 10, 25, 50, 75, 100,125,150,175,200, 1000 ],
  "pageLength": 50,
"aaSorting": [],
  
  
});
           
        });
</script> <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "वेतन  वृद्धि  माह"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "वेतन  वृद्धि  माह"; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
               
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
            
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo "वेतन  वृद्धि  माह"; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                                  <div class="col-xs-12 ">
                    
                              <button type="button" class="btn bg-purple"  data-toggle="modal"  data-target="#mygpf"><?php echo "वेतन  वृद्धि का माह  बदले   "?></button>
 
                    <a href="<?php echo base_url()?>payroll/showempcate"> <button type="button" class="btn bg-purple" ><?php echo "वेतन  वृद्धि रिपोर्ट    "?></button></a>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                      <?php// pre($pay_salary);?>
       
                        <table id="leave_tbl" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>  <th width='5%'><input type="checkbox" onClick="toggle(this)" /> Select All</th>
                                   <th width='5%'> <?php echo $this->lang->line('sno'); ?></th>
								   <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
								      <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                  <th width='5%'><?php echo "वेतन  वृद्धि  माह" ?></th>
                                   
                                    <th width='5%'><?php echo "Action"?></th>
                 
                                   
                               

                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                         //  pre($payall);
                                foreach ($payall as $key => $salary) { ?>
                  <tr>
                                    <th width='5% '><input type="checkbox" name="foo"  value="<?php echo $salary->emp_unique_id ?>"></th> 
									  <th width='5% '> <?php echo $i ?></th> 
									<th width='5%'>       <?php echo  get_tr_unicode($salary->emp_unique_id); ?></th>
                                    <th width="5%">  <?php echo   @get_employee_gender($salary->emp_id)." ".$salary->emp_full_name_hi." <br/>  (". get_employee_designation_id($salary->emp_id).")"; ?></th>
                                    <th width="5%">  <?php  echo $salary->pay_month?></th>
                             
                                   
                                       <th width="5%"> 
 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $salary->pay_id; ?>">edit</button>

                                       </th>
                                  

                                    </tr>

                                <?php  $i++; } ?>
                            </tbody>
                        </table>
   
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<!-- Modal -->

<?php     foreach ($payall as $key => $salary) { ?>


<div id="myModal<?php echo $salary->pay_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Icrement Month of <?php echo $salary->emp_full_name; ?> </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/add_increment_month" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Icrement Month of employee" ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

              
              </div>
   <div class="form-group">
               <label for="exampleInputEmail1"><?php echo  "Icrement Type" ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_incr_type" name="pay_incr_type" class="form-control">
                              
                               <option value="<?php echo 1 ?>" <?php echo  $salary->pay_incr_type == 1 ? 'selected' : ''; ?> >Fixed Amount</option>
                                    <option value="<?php echo 0 ?>" <?php echo  $salary->pay_incr_type == 0 ? 'selected' : ''; ?>  >Percentage Amount</option>
                             
                            </select> 

              
              </div>
   <div class="form-group">
                   <label for="exampleInputEmail1"><?php echo  "Icrement Amount " ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                   <input type="text" name="pay_incr_amount" id=""  value="<?php echo $salary->pay_incr_amount; ?>" class="form-control">
               

              
              </div>
                   <input type="hidden" name="pay_id" id=""  value="<?php echo $salary->pay_id; ?>" class="form-control">
               
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_update + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
        
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<?php } ?>
<div id="mygpf" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Icrement Month of </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/add_increment_monthall" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Icrement Month of employee" ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

              
              </div>
   <div class="form-group">
               <label for="exampleInputEmail1"><?php echo  "Icrement Type" ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_incr_type" name="pay_incr_type" class="form-control">
                              
                               <option value="<?php echo 1 ?>"  >Fixed Amount</option>
                                    <option value="<?php echo 0 ?>"   >Percentage Amount</option>
                             
                            </select> 

              
              </div>
   <div class="form-group">
                   <label for="exampleInputEmail1"><?php echo  "Icrement Percentage " ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                   <input type="text" name="pay_incr_amount" id=""  value="3" class="form-control">
               
<input name="checkval" class="checkval" type="hidden" value="" />
              
              </div>
                  
               
      </div>
   
      <div class="modal-footer">
        
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div></div>


<script type="text/javascript">

function toggle(source) {
   var allVals = [];
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;


  } 

$('.ck :checked').each(function() {
       allVals.push($(this).val());
     });
      $(".checkval").val(allVals);
   $(".checkvalda").val(allVals);
   $(".checkvalhra").val(allVals);
    $(".checkvalma").val(allVals);
     $(".checkvalsa").val(allVals);
     $(".checkvalgis").val(allVals);
       $(".checkvalpt").val(allVals);
         $(".checkvalgpf").val(allVals);

        $(".checkvalfule").val(allVals);
}
function chckboxval()
{ var allVals = [];

  $('.ck :checked').each(function() {
       allVals.push($(this).val());
     });
    console.log(allVals);
   $(".checkval").val(allVals);
    $(".checkvalda").val(allVals);
       $(".checkvalhra").val(allVals);
         $(".checkvalgis").val(allVals);
$(".checkvalsa").val(allVals);
    $(".checkvalma").val(allVals);
$(".checkvalfule").val(allVals);
       $(".checkvalpt").val(allVals);
        $(".checkvalgpf").val(allVals);
}
function checkeboxvv()
{ uid = $(".checkval").val();
  
  if(uid == "")
  {
    alert("please Select at least one employee");
    return false;
  }else{
  return true;

  }

}function ckval(){
   uid = $(".checkval").val();
 if(uid == "")
  {
    alert("please Select at least one employee");
    return false;
  }else{
  return true;

  }

}
 function efitfrom(id)
{

  $(".username1"+id).show();
  $(".username"+id).hide();
}function postfrom(id)
{
 var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {

     $pay_salary_cate_id =$("#pay_dpf"+id).val();
    $pay_dpf =$("#pay_dpf"+id).val();
    $pay_dpf_adv =$("#pay_dpf_adv"+id).val();
    $pay_gpf =$("#pay_gpf"+id).val();
    $pay_gpf_adv =$("#pay_gpf_adv"+id).val();
    $pay_gias =$("#pay_gias"+id).val();
$pay_define =$("#pay_define"+id).val();
$pay_fuel_charge =$("#pay_fuel_charge"+id).val();
$pay_professional_tax =$("#pay_professional_tax"+id).val();
$pay_income_tax =$("#pay_income_tax"+id).val();
  $pay_grain_adv =$("#pay_grain_adv"+id).val();
  $pay_festival_adv =$("#pay_festival_adv"+id).val();
    $pay_other_adv =$("#pay_other_adv"+id).val();
  $pay_house_loan =$("#pay_house_loan"+id).val();

  $pay_car_loan =$("#pay_car_loan"+id).val();
$pay_house_rent =$("#pay_house_rent"+id).val();
$pay_month = $("#pay_month"+id).val();
$pay_id = $("#pay_id"+id).val();
no_updated=$("#no_updated"+id).val();

remark=$("#remark"+id).val();

      $.post("<?php echo base_url();?>payroll/edit_slary_master1",{
        'pay_month':$pay_month,
        'pay_id':id,
        'pay_salary_cate_id' : $pay_salary_cate_id,
        'no_updated':no_updated,
        'pay_remark': remark,
         'pay_dpf' : $pay_dpf ,
                'pay_dpf_adv': $pay_dpf_adv,
               'pay_gpf' :  $pay_gpf ,
               'pay_gpf_adv' : $pay_gpf_adv,
              'pay_gias' : $pay_gias ,
              'pay_define' : $pay_define ,
              'pay_fuel_charge': $pay_fuel_charge ,
              'pay_professional_tax': $pay_professional_tax ,
              'pay_income_tax' :$pay_income_tax ,
               'pay_grain_adv' : $pay_grain_adv,
              'pay_festival_adv' :$pay_festival_adv ,
               'pay_other_adv' :$pay_other_adv,
      'pay_house_loan' :$pay_house_loan ,
     'pay_car_loan' :$pay_car_loan ,
      'pay_house_rent' : $pay_house_rent,
      },function(a){

       location.reload();
      });

                               
    } else {
        txt = "You pressed Cancel!";
    }
  //ale

}
</script>
