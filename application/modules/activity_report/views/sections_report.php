<style>
@media print 
{  
	.sections-box{
		width:24% ;	
		margin:0px 0px 0px 5px;
		padding:0px;		
		height:90px;
		border:1px solid #000 !important;
		
	}
	.happy{
		width:48% !important ;
	}
	.badhai{
		width:48% !important ;
		height:150px;
	}

	.happy1{
		width:98% !important ;
		border:none !important;
	}
	.sections-box .info-box-text,
	.sections-box .info-box-number, 
	.sections-box .progress-description {
		font-size:12px;			
	}
	.sections-box .info-box-content{
		width:70%;
	}
	.sections-box  .progress{
		display:none;
	}
	
	.sections-box .info-box-icon{
		font-size:28px;
		width:29% ;	
		margin:-15px 0px 0px 5px;
		
	}
	.box{
		padding:0px;
		margin:0px;
	}
	.box-title {
		text-align:center;
		margin:0px;
	}
}
.info-box-icon{
		font-size:35px;
	}
</style>
<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
			<div class="box no-print">	
				<div class="box-header">
					<h4 class="box-title">दिनांक का चयन करे</h4>
					<div class="box-tools pull-right no-print">
					</div>
				</div><!-- /.box-header -->
				<form role="form" method="post" action="<?php echo base_url()?>activity_report/datewise_report"  enctype="multipart/form-data">
				<div class="box-body">	
					<table class="table table-condensed">
						<tr>
							<th>Start date</th>
							<th>End date</th>
						</tr>
						<tr>
							<td>
								<input type="text" name="start_date" id="start_date" class="date_picker form-control" value="<?php echo get_date_formate($start_date, 'd-m-Y'); ?>" placeholder="Select enter date" class="form-control">
							</td>
							<td>
								<input type="text" name="end_date" id="end_date" class="date_picker form-control" value="<?php echo get_date_formate($end_date, 'd-m-Y'); ?>" placeholder="Select dispatch date" class="form-control">
							</td>
							<td>
								<button class="btn btn-primary" type="submit">Search</button>
							</td>
						</tr>
					</table>
				</div>
				</form>
			</div>
            <?php 
			if($datewise_report == false){
				echo modules::run('activity_report/index_for_admin',null); 
			} else {
				echo modules::run('activity_report/index_datewise_report',null); 
			}?>
		</div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
