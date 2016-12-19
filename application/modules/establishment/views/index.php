<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<?php echo $title; ?>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active"><?php echo $this->lang->line('notice_heading'); ?></li>
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
			<h3 class="box-title"><?php if($this->uri->segment(2)=='view_subcategory'){echo $this->lang->line('subcategory_label'); }?><?php echo $title_tab;?></h3>
			<div class="box-tools pull-right">
				<?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')|| ($this->uri->segment(2)=='view_subcategory') ){  ?>
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
					<button type="button" class="btn btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
				</a>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
		 <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); }?>

		  <table id="view_table" class="table table-bordered table-striped">
			<thead>
			  <tr>
				<th width="10%"><?php echo $this->lang->line('category_sno'); ?></th>
				<th width="20%"><?php if($this->uri->segment(2)=='view_subcategory'){echo $this->lang->line('subcategory_name_label'); }else {?> <?php echo $this->lang->line('category_hindi').'/'.$this->lang->line('category_english'); ?> <?php } ?></th>
				<th width="50%"><?php if($this->uri->segment(2)=='view_subcategory'){
					 echo $this->lang->line('subcategory_description_label');
				}else{
					 echo $this->lang->line('category_description');
				} ?>

				<th width="10%"><?php echo "दिनांक"; ?></th>
				<th width="30%"><?php echo $this->lang->line('category_action'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php  if((count($get_category)>0) && is_array($get_category)) {?>
			  <?php $i=1; foreach (@$get_category as $key => $category) { ?>
				<tr>
				  <td><?php echo $i;?></td>
				  <td><?php echo $category['category_title_hin'] .'/ '.$category['category_title_en'];?></td>

				  <td><?php echo $category['category_description'];?></td>
				 
				   <td><?php echo $category['created_date'];?></td>
					<td>
						<div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							कार्यवाही <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu bg-warning">
								<li><?php if($this->uri->segment(2)!='view_subcategory'){?>
								<li> <a href="<?php echo base_url('establishment');?>/edit_category/<?php echo $category['master_category_id'];?>" >बदलाव</a></li>
								<li><a href="<?php echo base_url('establishment');?>/delete_category/<?php echo $category['master_category_id'];?>" onclick="return is_delete();" >हटाना</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url('establishment');?>/subcategory/<?php echo $category['master_category_id'];?>"  >उप श्रेणी जोड़े</a></li>
								<li><a href="<?php echo base_url('establishment');?>/view_subcategory/<?php echo $category['master_category_id'];?>" >उप श्रेणी देखें</a></li>
							<?php  } else { ?>
								<li><a href="<?php echo base_url('establishment');?>/edit_subcategory/<?php echo $category['parent_category_id'];?>/<?php echo $category['master_category_id'];?>">बदलाव</a></li>
								<li><a href="<?php echo base_url('establishment');?>/delete_subcategory/<?php echo $category['parent_category_id'];?>/<?php echo $category['master_category_id'];?>" onclick="return is_delete();">हटाना</a></li>
							<?php  } ?>
						  </ul>
						</div>
					  
					</td>
				</tr>
			  <?php $i++; } }
			  else {
				  echo '';
				  }?>
			</tbody>
		</table>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->
	</div>
	</div><!-- /.row -->
          <!-- Main row -->
</section><!-- /.content -->
<script type="text/javascript">
  function is_delete(){
	var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
	if(res===false){
	  return false;
	}
  }
</script>
    