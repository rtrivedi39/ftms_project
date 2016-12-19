<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "स्थापना कार्य"; ?></li>
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
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php }
                ?>

<?php if($dis_allort_work == true) { ?>
                <div class="box-body">
                    <?php  $show_hide = 'style="display: none"';
                    foreach($fetch_category_yid as $fetch_category) {
                        foreach($show_masters as $get_cat) { if($fetch_category['master_category_id'] == $get_cat['parent_category_id']){ $show_hide = 'style="display: block"'; }} ?>
                        <div class="col-xs-12" <?php echo $show_hide ; ?>>
                            <div class="box box-success box-solid">
                                <div class="box-header">
                                    <i class="fa fa-th"></i><h3 class="box-title"><?php echo $fetch_category['category_title_hin'] ; ?></h3>
                                    <div class="box-tools pull-right">
                                        <button data-widget="collapse" class="btn bg-green btn-sm"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row text-center">
                                        <div class="form-group">
                                            <?php foreach($show_masters as $get_cat) {
                                                if($fetch_category['master_category_id'] == $get_cat['parent_category_id']){  ?>
                                                    <div class="col-md-6">
                                                        <div class="box box-success">
                                                            <div class="box-header with-border" style="padding: 8px;" data-widget="collapse">
                                                                <i class="fa fa-minus pull-right"></i>
                                                                <h3 class="box-title"><?php echo $get_cat['category_title_hin'] ; ?></h3>
                                                                <div class="box-tools pull-right" style="padding: 5px;" >
                                                                </div><!-- /.box-tools -->
                                                            </div><!-- /.box-header -->
                                                            <div class="box-body">
															<?php  if($get_cat['parent_category_id'] == 160){ 
															$emp = get_employee_details($this->session->userdata('emp_id')); 
															 $curr_financial_year = get_financial_year();
															$cco = incomecheck($emp[0]->emp_unique_id,$curr_financial_year);
													
															if(count($cco) == 1){ ?>
															
															
															 <a href="<?php echo base_url(); ?>incom_tax/showicometax/<?php echo $cco[0]->in_id;?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> स्वयं के आवेदन देखे </button></a>
															 
														
															<?php }else{
															?>
															   <a href="<?php echo base_url(); ?>incom_tax/index/<?php echo $get_cat['parent_category_id']; ?>/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> आवेदन करें</button></a>
															<?php } ?>
													 <a href="<?php echo base_url(); ?>incom_tax/register"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> वेतन रजिस्टर </button></a>
												
                                                       <a href="<?php echo base_url(); ?>incom_tax/listuser/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> आवेदन देखें</button></a>
                                                    <button type="button" onclick="open_rules_pdf(<?php echo $get_cat['master_category_id']; ?>)" value="<?php echo $get_cat['master_category_id']; ?>" class="btn btn-primary get_rules_pdf"><i class="fa fa-fw fa-paperclip"></i> नियम</button>
															
															<?php }else{ ?>

                                                                <a href="<?php echo base_url(); ?>establishment/service_forms/<?php echo $get_cat['parent_category_id']; ?>/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> आवेदन करें</button></a>
                                                                <a href="<?php echo base_url(); ?>est_service_module/app_list/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> आवेदन देखें</button></a>
                                                                <button type="button" onclick="open_rules_pdf(<?php echo $get_cat['master_category_id']; ?>)" value="<?php echo $get_cat['master_category_id']; ?>" class="btn btn-primary get_rules_pdf"><i class="fa fa-fw fa-paperclip"></i> नियम</button>
																<?php } ?>
                                                        </div><!-- /.box-body -->
                                                        </div><!-- /.box -->
                                                    </div>
                                                <?php }}  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div><!-- /.box -->
<?php }else if($dis_allort_work == false){ ?>
    <div class="box-body">
        <?php  $show_hide = 'style="display: none"';
        foreach($fetch_category_yid as $fetch_category) {
            foreach($show_masters as $get_cat) { 
			if($fetch_category['master_category_id'] == $get_cat['parent_category_id']){ $show_hide = 'style="display: block"'; }} ?>
            <div class="col-xs-12" <?php echo $show_hide ; ?>>
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <i class="fa fa-th"></i><h3 class="box-title"><?php echo $fetch_category['category_title_hin'] ; ?></h3>
                        <div class="box-tools pull-right">
                            <button data-widget="collapse" class="btn bg-primary btn-sm"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row text-center">
                            <div class="form-group">
                                <?php foreach($show_masters as $get_cat) {
                                    if($fetch_category['master_category_id'] == $get_cat['parent_category_id']){  ?>
                                        <div class="col-md-6">
                                            <div class="box box-default">
                                                <div class="box-header with-border" style="padding: 8px;" data-widget="collapse">
                                                    <i class="fa fa-minus pull-right"></i>
                                                    <h3 class="box-title"><?php echo $get_cat['category_title_hin'] ; ?></h3>
                                                    <div class="box-tools pull-right" style="padding: 5px;" >
                                                    </div><!-- /.box-tools -->
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
												<?php  if($get_cat['parent_category_id'] == 160){ 
                                                  
															$emp = get_employee_details($this->session->userdata('emp_id')); 
															 $curr_financial_year = get_financial_year();
															$cco = incomecheck($emp[0]->emp_unique_id,$curr_financial_year);
													
															if(count($cco) == 1){ ?>
															
															
															 <a href="<?php echo base_url(); ?>incom_tax/showicometax/<?php echo $cco[0]->in_id;?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> स्वयं के आवेदन देखे </button></a>
															 
														
															<?php }else{
															?>
															   <a href="<?php echo base_url(); ?>incom_tax/index/<?php echo $get_cat['parent_category_id']; ?>/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> आवेदन करें</button></a>
															<?php } ?>
													
													 <a href="<?php echo base_url(); ?>incom_tax/register"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> वेतन रजिस्टर </button></a>
                                                
                                                    <button type="button" onclick="open_rules_pdf(<?php echo $get_cat['master_category_id']; ?>)" value="<?php echo $get_cat['master_category_id']; ?>" class="btn btn-primary get_rules_pdf"><i class="fa fa-fw fa-paperclip"></i> नियम</button>

												<?php } else{?>
												     <a href="<?php echo base_url(); ?>establishment/user_service_forms/<?php echo $get_cat['parent_category_id']; ?>/<?php echo $get_cat['master_category_id']; ?>"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> आवेदन करें</button></a>
                                                    <a href="<?php echo base_url(); ?>establishment/user_app_list/<?php echo $get_cat['master_category_id']; ?>/<?php echo $this->session->userdata('emp_id'); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> स्वयं के आवेदन</button></a>
                                                    <button type="button" onclick="open_rules_pdf(<?php echo $get_cat['master_category_id']; ?>)" value="<?php echo $get_cat['master_category_id']; ?>" class="btn btn-primary get_rules_pdf"><i class="fa fa-fw fa-paperclip"></i> नियम</button>
												
												<?php }?>
                                                </div><!-- /.box-body -->
                                            </div><!-- /.box -->
                                        </div>
                                    <?php }}  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div><!-- /.box -->
<?php } ?>
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
<script>
    function open_rules_pdf(pdf){
        var pdf = pdf;

        $('#modal-application_pdf').modal('show');
        var app_masterid = pdf ;
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "est_service_module/get_masers_rules",
            datatype: "json",
            async: false,
            data: {app_master: app_masterid},
            success: function(data) {
                var r_data = JSON.parse(data);
                var i = 1 ;
                var otpt1 = '';
                $.each(r_data, function( index, value ) {
                    otpt1 += '<a href="'+HTTP_PATH+''+value.attach_path+'" target="_blank" class="btn btn-primary margin">नियम '+i+'</a> ';
                    i++;
                });
                otpt1 += '';
                if(otpt1 == ''){
                    otpt1 = '<div class="text-center text-danger">कोई नियम संलग्न  नही |</div>';
                }
                $("#rules_pdf_btn").html(otpt1);
            }
        });
    }
</script>
<!--receive model-->

<div class="modal fade" id="modal-application_pdf" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-fw fa-paperclip"></i> नियम </h4>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                 <div id="rules_pdf_btn"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <span id="show_payid" class="pull-left"></span>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--End-->
