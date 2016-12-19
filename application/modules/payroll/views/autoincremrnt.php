<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "Increment of employee in this Month"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "Increment of employee in this Month"; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                     <h1>
        <?php echo "Increment of employee in this Month"; ?>
    </h1>
                </div>
                <div class="box-body">
                    <div class="box-tools pull-right">
                      <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
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
                        <h3 class="box-title"><?php echo "Icrement Month of employee"; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                                  <div class="col-xs-12 ">
                           
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                      <?php// pre($payall);?>
       
                        <table id="leave_tbl" class="table table-bordered table-striped">
                            <thead>
                                <tr>  <th width='5%'><?php echo $this->lang->line('sno'); ?></th>
                                   <th width='5%'><?php echo "Employee Name "; ?></th>

                                    <th width='5%'><?php echo "Unique code of employee "  ?></th> 
                  <th width='5%'><?php echo "Basic Pay" ?></th>
                                <th width='5%'><?php echo "DA" ?></th>    
                                    <th width='5%'><?php echo "Action"?></th>
                 
                                   
                               

                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                         //  pre($payall);
                                foreach ($payall as $key => $salary) { ?>
                  <tr>
                                    <th width='5%5%'><?php echo $i; ?></th>
                                     <th width="5%">  <?php echo  $salary->emp_full_name_hi ?></th>
                                    <th width="5%"> <?php $firstdigit= substr($salary->pay_emp_unique_id, 0, 1); if($firstdigit == 5 ){$a = 0; }else{$a = "";}echo $a.$salary->pay_emp_unique_id;    ?></th>

                                    <th width="5%">  <?php echo  $salary->pay_basic ?></th>
                                    <th width="5%">  <?php  echo $salary->pay_da?></th>
                             
                                   
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
        <h4 class="modal-title">Change basic pay of <?php $firstdigit= substr($salary->pay_emp_unique_id, 0, 1); if($firstdigit == 5 ){$a = 0; }else{$a = "";}echo $a.$salary->pay_emp_unique_id;    ?></h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/incrment_month" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Increment Basic Pay" ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_basic" id=""  value="<?php echo $salary->pay_basic; ?>" class="form-control">
               
              
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Remark " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_remark" id=""  value="" class="form-control">
               
              
              </div> 
                   <input type="hidden" name="pay_id" id=""  value="<?php echo $salary->pid; ?>" class="form-control">
               
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
        
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<?php } ?>