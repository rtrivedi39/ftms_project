
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php// echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php// echo $title; ?></li>
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
                        <h3 class="box-title"> <?php  $in = 0;
                         foreach ($pay_regi as $key => $pay) {
                        	$in = $in +1 ;
                         if($in == 1){  // echo$pay->emp_unique_id." =". $pay->emp_full_name_hi;  
                         } } ?></th></h3>                 
                    </div>
                   
                    <div class="box-body">

आप <b><?php echo $pay->emp_full_name_hi;?></b> की सैलरी <b><?php echo $_GET['pay_month']?></b> महीने की भर चुके है </div> <div class="box-body">

					<button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>

									</div>
				</div>		
			</div>
		</div>	
	</div>	
</section>