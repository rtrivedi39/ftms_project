<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "कर्मचारी & वेतन हेड"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "कर्मचारी & वेतन हेड";; ?></li>
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
                        <h3 class="box-title"><?php echo "कर्मचारी & वेतन हेड";; ?></h3>                 
                    </div>
                    
                    <div class="box-body">
					    
 <form action="<?php echo base_url();?>payroll/add_slary_head_cate"   method="post">
               
                <div class="col-xs-12">    	<?php foreach($pay_salary  as $sal_Cate){?>
             <div <?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-yellow btn-flat margin "<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?>> 
   <input type="checkbox" name="cate_name" value="<?php echo $sal_Cate->pay_cate_id;  ?>"> <?php echo $sal_Cate->pay_cate_name; ?>
       <input type="hidden" name="cate_id[]" id="cate_id" value="<?php echo $sal_Cate->pay_cate_id;  ?>" class="form-control">
        
</div> 

    <?php }?>

 <div class="box-footer">
          <button class="btn btn-primary" onClick="postform" type="submit" name="savenotice" id="savenotice" value="1"><?php echo "बदले"; ?></button>
        </div>
<table id="maintable" class="table table-bordered table-striped dataTable no-footer" >
    <thead>     
        <tr>  <th width='15%'><input type="checkbox" onClick="toggle(this)" /> Select All</th>
         <th width='20%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
          <th width='20%'><?php echo "वेतन हेड"  ?></th>
          <th width='20%'><?php echo "अधिकारी / कर्मचारी पद"  ?></th>
             
         
           <th width="20%"><?php echo $this->lang->line('emp_name'); ?></th></tr>
</thead> <?php $k =0; //pre($emp);
 foreach ($emp as $key => $pay) { $k++; ?>
    <tr id="<?php echo $pay->emp_id; ?>">
                                     <td ><input type="checkbox" name="emp[]" value="<?php echo $pay->emp_unique_id; ?>"> </td>
                                      <td><?php echo  get_tr_unicode($pay->emp_unique_id);?></td>
                                      <td ><?php echo @gethead($pay->emp_pay_cate_id)[0]->pay_cate_name; ?></td>
                                   <td ><?php echo ""; ?></td>
                                   <td ><?php echo $pay->emp_full_name_hi; ?></td>
                                    </tr>
                                    <?php } ?>
</table> 

 </form>
               
            </div>

            <!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->


<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByName('emp');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
