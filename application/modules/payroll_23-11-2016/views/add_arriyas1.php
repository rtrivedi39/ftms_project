<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php //echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php //echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h1 ><?php echo " वेतन एरियर्स  ".$_GET['pay_month']." ".$_GET['pay_year']." - ".$_GET['pay_month_end']." ". $_GET['pay_year_end'];?>
                      </h1>
                </div>
                <div class="box-body">
                    <h3 style="text-align: right;"><?php echo "वित्त विभाग  का आदेश नंबर :- ".$_GET['orderno'];?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

               <div class="box-body">

                        
                        <div class="fix_table-container">
						<form  id="emp" action="<?php echo base_url();?>payroll/epayment1/?cate_id=<?php echo $_GET['cate_id']?>&pay_month=<?php echo $_GET['pay_month']?>&pay_year=<?php echo $_GET['pay_year']?>&pay_month_end=<?php echo $_GET['pay_month_end']?>&pay_year_end=<?php echo $_GET['pay_year_end']?>" method="post">
                         
<table id="" class="" cellspacing="0" width="100%" style="font-size:12px">
  
<thead style="background:white" >
  <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22">  <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button>  </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center"><p>GPF Months</p>
        <p> 
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="gpf[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><p>Epayment
        Months</p>
        <p>
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="epayment[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr>
<?php } ?>
     
                                <tr>
                                    <th ><?php echo "क्र."  ?><input type="checkbox" onClick="toggle(this)" /> Select All</th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                  <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                                    <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                                  <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 
                                    <th ><?php echo  " नया ".$this->lang->line('basic_pay');  ?></th>
                                            <?php } ?>
                                   
                                                                     <th ><?php echo "एरियर्स"; ?></th>
                             </tr>
                              </thead>
   <tbody>      
                <?php $k = 1;
                                    $sap = $totalmonth  ; $totalda = 0; 
                                    foreach ($getemp as $key => $pay) {  
$old = $pay->pay_basic;$new =newbasic($pay->emp_unique_id)[0]->pay_basic; 
$n = $old - $new;
if($n != 0 || $n < 0){
                                       ?>    
                          <tr id="<?php echo $pay->pay_id; ?>">
                                    <th  ><?php echo $k; ?> <input type="checkbox" name="foo" onclick="chckboxval()" value="<?php echo $pay->pay_emp_unique_id; ?>"></th>
                                    <th ><?php echo $pay->emp_unique_id;  ?></th>
                                    <th ><?php echo @get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi."
                                     <br/>  (". get_employee_designation_id($pay->emp_id).")"; ?></th>
                                     <th ><?php echo date("M",strtotime($pay->pay_month))." ".$pay->pay_year; ?></th>
                                     
                                     <th style="padding:0;"> <?php echo $old = $pay->pay_basic;  ?></th>
                                    
                                  <th style="padding:0;"> <?php echo $new =newbasic($pay->emp_unique_id)[0]->pay_basic;  ?>
                                    </th> 
                                     
                       
                           <th > <?php echo $old - $new; ?></th>
                                                                </tr>   <?php } ?>
                         
  <?php $k++; }  ?> 
</tbody> 

<tfoot>
  <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22">  <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button>  </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center"><p>GPF Months</p>
        <p> 
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="gpf[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><p>Epayment
        Months</p>
        <p>
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="epayment[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr>
<?php } ?>
  
</tfoot>  
                
</table>
<div id="bottom_anchor"></div>
</div>



</form>       
    </div>
</div>
  </div>
    </div>
  </section>
  <script type="text/javascript">

function onsumitsalary(id)
{
   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
      $
        document.getElementById("emp").submit();


    } else {
        txt = "You pressed Cancel!";
    }
  

}
  </script><script type="text/javascript">

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