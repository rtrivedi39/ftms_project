
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
              <div class="box">
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                      <a href="<?php echo base_url('establishment');?>/add_work">
                        <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                      </a>
                    </div>
                    <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
				<div class="box-header">
                 <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); }?>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('category_sno'); ?></th>
						<th><?php echo $this->lang->line('est_word_alloted_emp'); ?></th>
                        <th><?php echo $this->lang->line('work_name');?></th>                       
                        <th><?php echo $this->lang->line('category_action'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  if((count($get_alloted_lists)>0) && is_array($get_alloted_lists)) {?>
                      <?php $i=1; foreach (@$get_alloted_lists as $key => $category) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo getemployeeName($category['est_word_alloted_emp_id'], true);?></td>
                          <td><?php $categories = explode(',', $category['est_word_alloted_work_id']);
								foreach($categories  as $cat){
									$cat_details = $this->est_category_master_model->fetch_category_yid($cat);
									$cat_name[] = $cat_details[0]['category_title_hin'];
								}
								echo implode(', ', $cat_name); unset($cat_name);  ?>						  
						  </td>                        
                         
                          <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url('establishment');?>/edit_work/<?php echo $category['est_word_alloted_id'];?>" class="btn  btn-twitter">Edit</a>
                               <?php if(checkUserrole() == 1 ) { ?> 
								<a href="<?php echo base_url('establishment');?>/delete_work/<?php echo $category['est_word_alloted_id'];?>" onclick="return is_delete();" class="btn  btn-danger">Delete</a>
							   <?php } ?>
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
    