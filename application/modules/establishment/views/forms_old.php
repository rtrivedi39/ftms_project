
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
                    <div class="row">
                        <div class="col-md-4">
                            <?php  if(isset($get_category_list)) {
                                $get_cat_list = explode(',',$get_category_list);
                                $i = 1;
                                foreach($get_cat_list as $id) {
                                    $cat_name = $this->est_category_model->fetch_category_yid($id); ?>
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title" data-toggle="tooltip" data-placement="top" title="<?php echo $cat_name[0]['category_title_en'] ; ?>"><?php echo $cat_name[0]['category_title_hin'] ; ?></h3>
                                            <div class="box-tools">
                                                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body no-padding" style="display: block;">
                                            <ul class="nav nav-pills nav-stacked">
                                                <?php $sub_cat1 = $this->est_category_model->fetch_subcategory_yid($cat_name[0]['master_category_id']);
                                                if(count($sub_cat1
												) > 0 && is_array($sub_cat1)){
                                                    foreach($sub_cat1 as $subid1 => $subcat1) { ?>
                                                        <li><a href="<?php echo base_url('establishment');?>/add_from/<?php echo $subcat1['master_category_id']; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $subcat1['category_title_en'] ; ?>"><i class="fa fa-circle-o text-red"></i> <?php echo $subcat1['category_title_hin'] ; ?></a></li>
                                                    <?php }
                                                } else {
                                                    echo "<li><a>No sub category found</a></li>";
                                                } ?>
                                            </ul>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <?php echo $i%4 ? '</div><div class="col-md-4">' : '';
                                    $i++; } // end get_work
                            } else if(isset($get_all_cat)){
                                $j = 1;
                                foreach($get_all_cat as $id => $cat) { ?>
                                    <div class="box box-solid">
                                        <div class="box-header with-border btn-primary" style="color:#fff;">
                                            <h3 class="box-title" data-toggle="tooltip" data-placement="top" title="<?php echo $cat['category_title_en'] ; ?>"><?php echo $cat['category_title_hin'] ; ?></h3>
                                            <div class="box-tools">
                                                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body no-padding" style="display: block;">
                                            <ul class="nav nav-pills nav-stacked">
                                                <?php $sub_cat2 = $this->est_category_model->fetch_subcategory_yid($cat['master_category_id']);
                                                if(count($sub_cat2) > 0 && is_array($sub_cat2)){
                                                    foreach($sub_cat2 as $subid2 => $subcat2) { ?>
                                                        <li><a href="<?php echo base_url('establishment');?>/add_from/<?php echo $subcat2['master_category_id']; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $subcat2['category_title_en'] ; ?>"><i class="fa fa-circle-o text-red"></i> <?php echo $subcat2['category_title_hin'] ; ?></a></li>
                                                    <?php } //foreach
                                                } else {
                                                    echo "<li><a>No sub category found</a></li>";
                                                } ?>
                                            </ul>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <?php  echo $j%4 ? '</div><div class="col-md-4">' : '';
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

