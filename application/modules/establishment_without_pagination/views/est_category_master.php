<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url('admin');?>/sections"></a></li>
        <li class="active"><?php echo $page_title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">				
                <div class="box-header">
                    <h3 class="box-title"><?php echo $page_title;?></h3>
                    <div class="box-tools pull-right">
						<?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory') ){  ?>
							<a href="<?php echo base_url('establishment');?>/subcategory/<?php echo $this->uri->segment(3); ?>">
								<button type="button" class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?></button>
							</a>
						<?php } ?>
						<?php  if(($this->uri->segment(2) == 'edit_category')|| ($this->uri->segment(2) == 'managecategory') || ($this->uri->segment(2) == 'category')){ ?>
							<a href="<?php echo base_url('establishment');?>/managecategory">
								<button type="button" class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?></button>
							</a>
						<?php } ?>
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
				<?php if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')){
				?>
                <!-- form start -->
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>establishment/est_master_category/addsub_category<?php if(isset($category_id)){ echo '/'.$category_id;} ?><?php if(isset($subcategory_id)){ echo '/'.$subcategory_id;} ?>">
				<input type="hidden" name="category_id" id="category_id" value="<?php echo (@$category_id? $category_id:'')?>">
				<?php }else{ ?>
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>establishment/est_master_category/manage_category/<?php if(isset($id)){ echo '/'.$id;} ?>">
				<?php } ?>
				<div class="box-body">
					<?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
					$msg = $this->session->flashdata('message') ? 'success' : 'danger'; ?>
						<div class="alert alert-<?php echo $msg; ?> alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>
								<?php  echo $this->session->flashdata('message');
								echo $this->session->flashdata('error'); ?>
							</strong>
							<br/>
						</div>
					<?php } ?>
                    <div class="col-md-6">
                        <!-- general form elements -->
						<?php if(($this->uri->segment('2') == 'subcategory')||($this->uri->segment('2') == 'edit_subcategory')){?>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo $this->lang->line('category_list_label'); ?><span class="text-danger">*</span></label>
								<select class="form-control" name="parent_category_id"><option> -Select Category-</option>
								<?php if($all_categoris){
									foreach($all_categoris as $key =>$category){
									   if($this->uri->segment(3) == $category['master_category_id']){
											echo "sdfsd<option selected='selected' value=".$category['master_category_id']."> ".$category['category_title_hin'].'('. $category['category_title_en'].")</option>";
										}else{
											echo "<option  value=".$category['master_category_id']."> ".$category['category_title_hin'].'('. $category['category_title_en'].")</option>";
										}
									 }
								}?>
								</select>
								<?php echo form_error('parent_category_id');?>
							</div>
						<?php } ?>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')){ echo $this->lang->line('label_subcategory_name_hi');  }else { echo $this->lang->line('category_hindi'); } ?><span class="text-danger">*</span></label>
								<input type="text" name="category_title_hin" id="category_title_hin" placeholder="<?php echo $this->lang->line('label_category_name_hi'); ?>" <?php if($this->uri->segment('2') != 'subcategory'){  ?> value="<?php echo (@$category_detail['category_title_hin'] ? @$category_detail['category_title_hin']:''); ?>" <?php }else { } ?> placeholder="" class="form-control">
								<?php echo form_error('category_title_hin');?>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1"><?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')){ echo $this->lang->line('label_subcategory_name_en');  }else {  echo $this->lang->line('category_english'); }?><span class="text-danger">*</span></label>
								<input type="text" name="category_title_en" id="category_title_en" placeholder="<?php echo $this->lang->line('label_category_name_hi'); ?>"  <?php if($this->uri->segment('2') != 'subcategory'){  ?> value="<?php echo (@$category_detail['category_title_en'] ? @$category_detail['category_title_en']:''); ?>" <?php }else { } ?> placeholder="" class="form-control">
								<?php echo form_error('category_title_en');?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')){  echo $this->lang->line('subcategory_description_label');  }else { echo $this->lang->line('category_description'); } ?><span class="text-danger">*</span></label>
								<textarea name="category_description" id="category_description" class="form-control"><?php if($this->uri->segment('2') != 'subcategory'){  ?> <?php echo (@$category_detail['category_description'] ? @$category_detail['category_description']:''); ?><?php }else { } ?></textarea>
								<?php echo form_error('category_description');?>
							</div>
						<?php  if(($this->uri->segment(2) == 'edit_category')|| ($this->uri->segment(2) == 'managecategory')){ ?>
						<div class="form-group">
							<label for="exampleInputEmail1"><?php  echo $this->lang->line('is_every_emp_create');?><span class="text-danger">*</span></label>
							<input type="checkbox" name="is_every_emp_create" id="is_every_emp_create"  <?php echo (isset($category_detail['is_every_emp_create']) && $category_detail['is_every_emp_create'] == 1 ? 'checked' : '' ); ?> >
							<?php echo form_error('is_every_emp_create');?>
						</div>
						<?php } ?>
                    </div><!-- col 6 -->
				</div><!-- /.box-body -->
				<div class="box-footer">
					<button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
				</div>
				</form>
			</div><!-- /.box -->
		</div><!-- col 12-->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#section_div').hide();
        $('#notice_type_id').change(function(){
          //  alert('hello');
            if($('#notice_type_id').val() == '2'){
                $('#section_div').show();
            } else {
                $('#section_div').hide();
            }

        })
    })
</script>


    