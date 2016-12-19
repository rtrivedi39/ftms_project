<!-- Content Header (Page header) -->
<style type="text/css">
<!--
input {
	width: 75px;
}table.dataTable thead > tr > th {
    padding-right: 22px;
}
-->
</style>

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
                    <h3 class="box-title"><?php //echo $title_tab_header;     ?></h3>
                </div>
                <div class="box-body">
                    <?php //$this->load->view('payroll_header') ?>
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
                        <h3 class="box-title"><?php // echo $title_tab; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php //echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                     <button class="btn btn-primary" type="button" id="addRow" value="1">Add New row</button>
  
<form name="form1" method="post" action="<?php echo base_url()?>payroll/addallareays">
            <div class="form-group">
                      <label for="email"><?php echo "";  ?></label>
          <input type="text" class="form-control" name="pay_cate_name" id="pay_cate_name">
            </div>
             
                            <table id="example" width="100%"   border="1">
                 <thead>
                   <tr>
                     <th colspan="25" style="text-align: center">&nbsp;</th>
                   </tr>
                   <tr>
                     <th style="text-align: center">&#2309;&#2357;&#2343;&#2367;</th>
                          <th style="text-align: center">&#2337;&#2368; &#2319; &#2342;&#2352;</th>
                          <th style="text-align: center">&#2351;&#2370;&#2344;&#2367;&#2325;&#2379;&#2337;</th>
                          <th style="text-align: center">&#2325;&#2352;&#2381;&#2350;&#2330;&#2366;&#2352;&#2368; &#2344;&#2366;&#2350;</th>
                          <th colspan="5" style="text-align: center">&#2357;&#2375;&#2340;&#2344; &#2349;&#2369;&#2327;&#2340;&#2366;&#2344; &#2325;&#2367;&#2351;&#2366; &#2332;&#2366;&#2344;&#2366; &#2341;&#2366;</th>
                          <th colspan="5" style="text-align: center">&#2357;&#2375;&#2340;&#2344; &#2349;&#2369;&#2327;&#2340;&#2366;&#2344; &#2325;&#2367;&#2351;&#2366; &#2327;&#2351;&#2366; &#2341;&#2366;</th>
                          <th style="text-align: center">&#2357;&#2375;&#2340;&#2344; &#2309;&#2306;&#2340;&#2352; </th>
                          <th style="text-align: center">&#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375; &#2309;&#2306;&#2340;&#2352; </th>
                          <th style="text-align: center">&#2350;&#2306;&#2361;&#2327;&#2366;&#2312; &#2349;&#2340;&#2381;&#2340;&#2366;</th>
                          <th style="text-align: center">&#2327;&#2371;&#2361; &#2349;&#2366;&#2337;&#2366; &#2349;&#2340;&#2381;&#2340;&#2366;</th>
                          <th style="text-align: center">&#2349;&#2369;&#2327;&#2340;&#2366;&#2344; &#2325;&#2368; &#2332;&#2366;&#2344;&#2375; &#2357;&#2366;&#2354;&#2368; &#2325;&#2369;&#2354; &#2309;&#2344;&#2381;&#2340;&#2352; &#2325;&#2368; &#2352;&#2366;&#2358;&#2367;</th>
                   </tr>
                    
                        <tr>
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                          <th >&#2357;&#2375;&#2340;&#2344;</th>
                          <th >&#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;</th>
                          <th >&#2337;&#2368; &#2319; </th>
                          <th>&#2319;&#2330; &#2310;&#2352;</th>
                          <th >&#2351;&#2379;&#2327;</th>
                          <th >&#2357;&#2375;&#2340;&#2344;</th>
                          <th >&#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;</th>
                          <th >&#2337;&#2368; &#2319; </th>
                          <th>&#2319;&#2330; &#2310;&#2352;</th>
                          <th >&#2351;&#2379;&#2327;</th>
                          <th ></th>
                        
                          <th ></th>
                                             
                          <th ></th>
                          <th ></th>
                          <th ></th>
                     </tr> <thead>
                        <tbody >     <tr>
                            <th >  <input name="dd0" type="text" value="" placeholder=""></th>
                            <th >  <input name="dapr0" type="text" value="" id="dapr0" placeholder=""></th>
                            <th >  <input name="emp_unique_code0" type="text" value="" placeholder=""></th>
                            <th >  <input name="empname0" type="text" value="" placeholder=""></th>
                            <th > 
                               <input name="basic_pay0"  onblur="checkval(0)" id="basic_pay0" type="text" value="" placeholder="">
                             </th>
                          <th ><input type="text" onblur="checkval(0)" name="pay_gradepay0" id="pay_gradepay0" ></th>
                          <th ><input name="pay_danew0" type="text" onblur="checkval(0)" id="pay_danew0" ></th>
                          <th ><input name="pay_hra0" type="text" onblur="checkval(0)" id="pay_hra0" ></th>
                          <th ><div id="0"></div></th>
                          <th ><input name="basic_payold0" type="text" onblur="checkval(0)" id="basic_payold0"  ></th>
                          <th ><input name="pay_grpold0" type="text" onblur="checkval(0)" id="pay_grpold0"   ></th>
                          <th ><input name="pay_daold0" type="text" onblur="checkval(0)" id="pay_daold0"  ></th>
                          <th ><input name="pay_hraold0" type="text" id="pay_hraold0" onblur="checkval(0)" ></th>
                          <th ><div id="old0"></div></th>
                          <th >&nbsp;</th>
                      
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                          <th >&nbsp;</th>
                        </tr></tbody>
                      </table>
                        <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
                  </form>
              </div>

  
           </div><!-- /.box-body -->
           
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<script language="JavaScript" type="text/javascript">



$(document).ready(function() {
    var t = $('#example').DataTable();
    var counter = 1;
 
    $('#addRow').on( 'click', function () {
	
        t.row.add( [
		 ' <input name="dd0'+counter+'"   type="text" value="0">',
		  ' <input name="dapr'+counter+'" id="dapr'+counter+'"  type="text" value="0">',
		   ' <input name="emp_unique_code'+counter+'" type="text" value="0">',
           ' <input name="empname0'+counter+'" type="text" value="0">',
            '<input type="text" name="basic_pay'+counter+'" onblur="checkval('+counter+')"  id="basic_pay'+counter+'"  value="0" >',
           '<input type="text" name="pay_gradepay'+counter+'" onblur="checkval('+counter+')" id="pay_gradepay'+counter+'"   value="0" >',
          '<input type="text" name="pay_danew'+counter+'" onblur="checkval('+counter+')" id="pay_danew'+counter+'"   value="0" >',
             ' <input name="pay_hra'+counter+'" type="text" onblur="checkval('+counter+')" id="pay_hra'+counter+'"   value="0">','<div id="'+counter+'"></div>',
            '<input type="text" name="basic_payold'+counter+'" onblur="checkval('+counter+')" id="basic_payold'+counter+'"   value="0" >',
           '<input type="text" name="pay_grpold'+counter+'" onblur="checkval('+counter+')" id="pay_grpold'+counter+'"   value="0" >',
          '<input type="text" name="pay_daold'+counter+'" onblur="checkval('+counter+')" id="pay_daold'+counter+'"   value="0" >',
           '<input type="text" name="pay_hraold'+counter+'" id="pay_hraold'+counter+'" onblur="checkval('+counter+')"  value="0" >','<div id="old'+counter+'"></div>','0','0','0','0',
           
       
        ] ).draw( false );
 
        counter++;
    } );
 

} );

function checkval(av){
var da =$("#dapr"+av).val();
var pay =$("#basic_pay"+av).val();
var grap =$("#pay_gradepay"+av).val();
var hra =$("#pay_hra"+av).val();
var payold =$("#basic_payold"+av).val();
var grapold =$("#pay_grpold"+av).val();
var hraold  =$("#pay_hraold"+av).val();
nebasic = +pay + +grap;
davalne = ((nebasic * da)/100);
$("#pay_danew"+av).val(davalne);
oldbasic = +payold + +grapold;
davalne1 = ((oldbasic * da)/100);
$("#pay_daold"+av).val(davalne1);
totalold =  +oldbasic + +davalne1 + +hraold ;
total =  +nebasic + +davalne + +hra;
$("#"+av).html(total);
$("#old"+av).html(totalold);
}
</script>
