<section class="content-header">
    <h1>
        <?php echo "वेतन विवरण " ; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "वेतन विवरण "; ?></li>
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
                        <h3 class="box-title"><?php echo  "वेतन मास्टर "; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                                                         <div class="col-xs-2">
    <a  id="" href="<?php echo base_url(); ?>payroll/payconsdiertime"  class="btn btn-block btn-info" ><?php echo "समय मान" ?></a><br/>
    </div>
                        </div>
                    </div>
                    <div class="box-body">
					  
                 
                <div class="col-xs-12">    	<?php foreach($pay_salary  as $sal_Cate){?>
               <div class="col-xs-2">
    <a  id="<?php echo $sal_Cate->pay_cate_id; ?>"
	href="<?php echo base_url(); ?>payroll/showsalary_cate/<?php echo $sal_Cate->pay_cate_id; ?>"
	<?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-yellow btn-flat margin "<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?>><?php echo $sal_Cate->pay_cate_name; ?></a><br/>
    </div>
    <?php }?>
            </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->

