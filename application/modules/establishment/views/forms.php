
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-file-text"></i><h3 class="box-title"><?php echo $title_tab;?></h3>
                    <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn bg-primary  btn-sm"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                           <div class="row">
								<div class="col-md-4">
						   <?php  if(isset($get_category_list)) {
                                $get_cat_list = explode(',',$get_category_list);
								$i = 1;
                                foreach($get_cat_list as $id) {
                                    $cat_name = $this->est_category_model->fetch_category_yid($id);
									$sub_cat1 = $this->est_category_model->fetch_subcategory_yid($cat_name[0]['master_category_id']);
									?>
                                   
								  <div class="panel panel-<?php echo $sub_cat1 != '' ? 'danger' : 'danger' ; ?>">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $cat_name[0]['master_category_id'] ; ?>" aria-expanded="true" aria-controls="collapseOne">
									<div class="panel-heading" role="tab" id="heading_<?php echo $cat_name[0]['master_category_id'] ; ?>">
									  <h4 class="panel-title" data-toggle="tooltip" data-placement="top" title="<?php echo $cat_name[0]['category_title_en'] ; ?>">
										  <?php echo $cat_name[0]['category_title_hin'] ; ?>
										
									  </h4>
									</div></a>
									<div id="collapse_<?php echo $cat_name[0]['master_category_id'] ; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
									  <div class="panel-body">
										<ul class="nav nav-pills nav-stacked">
											<?php
											if(count($sub_cat1) > 0 && is_array($sub_cat1)){
												foreach($sub_cat1 as $subid1 => $subcat1) { ?>
													<li><a href="<?php echo base_url('establishment');?>/add_from/<?php echo $subcat1['master_category_id'].'/'.$file_type_status; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $subcat1['category_title_en'] ; ?>"><i class="fa fa-circle-o text-red"></i> <?php echo $subcat1['category_title_hin'] ; ?></a></li>
												<?php }
											} else {
												echo "<li><a>No sub category found</a></li>";
											} ?>
										</ul>
									  </div>
									</div>
								  </div>

									
                                    <?php echo $i % 3 == 0 ? '</div><div class="col-md-4">' : '';
                                 $i++; } // end get_work
                            } else if(isset($get_all_cat)){
                                $j = 1;
                                foreach($get_all_cat as $id => $cat) {
									$sub_cat2 = $this->est_category_model->fetch_subcategory_yid($cat['master_category_id']);
								?>
								
								<div class="panel panel-<?php echo $sub_cat2 != '' ? 'danger' : 'danger' ; ?>">
									<div class="panel-heading" role="tab" id="heading<?php echo $cat['master_category_id'] ; ?>">

										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $cat['master_category_id'] ; ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title" data-toggle="tooltip" data-placement="top" title="<?php echo $cat['category_title_en'] ; ?>">
										    <span><?php echo $cat['category_title_hin'] ; ?></span>
                                            </h4>
										</a>

									</div>
									<div id="collapse_<?php echo $cat['master_category_id'] ; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
									  <div class="panel-body">
										 <ul class="nav nav-pills nav-stacked">
											<?php if(count($sub_cat2) > 0 && is_array($sub_cat2)){
												foreach($sub_cat2 as $subid2 => $subcat2) { ?>
													<li><a href="<?php echo base_url('establishment');?>/add_from/<?php echo $subcat2['master_category_id'].'/'.$file_type_status; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $subcat2['category_title_en'] ; ?>"><i class="fa fa-circle-o text-red"></i> <?php echo $subcat2['category_title_hin'] ; ?></a></li>
												<?php } //foreach
											} else {
												echo "<li><a>No sub category found</a></li>";
											} ?>
										</ul>
									  </div>
									</div>
								</div>
                                   
                                    <?php  echo $j % 3 == 0 ? '</div><div class="col-md-4">' : '';
                                      $j++;  } // get all cat
                            } else { ?>
                                No record found
                            <?php } ?>
                        </div>						
                    </div>						
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->


