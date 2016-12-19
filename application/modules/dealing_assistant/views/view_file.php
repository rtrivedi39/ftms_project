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
              <div class="box">
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right"> <button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                  
                </div><!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('view_file_type'); ?></th>
                        <th><?php echo $this->lang->line('view_mark_section'); ?></th>
                        <th><?php echo $this->lang->line('view_mark_section_date'); ?></th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($assistant_files as $key => $files) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $files->file_subject;?>
						  <br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id); }?></td>
                          <td><?php echo getFileType($files->file_type) ;?></td>
                          <td><?php echo getSection($files->file_mark_section_id); ?></td>
                          <td><?php echo $files->file_mark_section_date;?></td>
                          <td>
                              <div class="btn-group">
                                  <?php echo ucfirst($files->file_hardcopy_status) ; ?>
                                  <!-- <a href="<?php echo base_url();?>dealing_assistant/viewprofile/<?php echo $files->file_id; ?>" class="btn  btn-twitter"><?php echo $this->lang->line('edit_details') ?></a>
								  <a href="<?php echo base_url();?>dealing_assistant/viewprofile/<?php echo $files->file_id; ?>" class="btn  btn-twitter"><?php echo $this->lang->line('view_details') ?></a>
                                 <a href="<?php //echo base_url('admin');?>/delete_section/<?php //echo $sections['section_id'];?>" onclick="return is_delete();" class="btn  btn-twitter">Delete</a> -->
                              </div>
                            </td>
                        </tr>
                      <?php $i++; } ?>
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
    