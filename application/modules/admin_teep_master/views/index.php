<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
		    <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                  <div style="float:right">
                    <a href="<?php echo base_url('admin');?>/manage_teep">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                    </a>
                    </div>
                </div><!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); ?>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th><?php echo $this->lang->line('label_teep_title'); ?></th>
                        <th><?php echo $this->lang->line('label_teep_emp_role'); ?> Hindi / English</th>
                        <th><?php echo $this->lang->line('label_teep_status'); ?> </th>
                        <th><?php echo $this->lang->line('label_created'); ?></th>
                        <th><?php echo $this->lang->line('label_updated'); ?></th>
                        <th><?php echo $this->lang->line('teep_action_label'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($get_teeps as $key => $teep) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $teep['title'];?></td>
                          <td><?php  $lvl_ids = explode(',',$teep['emprole_level_id']);
									foreach($lvl_ids as $lid){ 								 
									$teep_master = new Admin_teep_master();
									echo $teep_master->get_employee_lavel_name($lid)  ;
									echo "<br>";
									} ?></td>
                          <td><?php if($teep['status'] == 1 ){ echo "Enabled"; }else{ echo "Disabled"; }?></td>
                          <td><?php if(!empty($teep['created_at']) && $teep['created_at'] != '0000-00-00 00:00:00') { echo date('d-m-Y' , strtotime($teep['created_at'])); } ?></td>
                          <td><?php if(!empty($teep['created_at']) && $teep['created_at'] != '0000-00-00 00:00:00') { echo date('d-m-Y' , strtotime($teep['updated_at'])); } ?></td>
                          <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url('admin');?>/manage_teep/<?php echo $teep['autoload_teep_master_id'];?>" class="btn  btn-twitter"><?php echo $this->lang->line('label_teep_action_button'); ?></a>
                                <a href="<?php echo base_url('admin');?>/delete_teep/<?php echo $teep['autoload_teep_master_id']?>" onclick="return is_delete();" class="btn  btn-twitter">Delete</a>
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
    