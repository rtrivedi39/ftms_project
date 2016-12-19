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
          <?php //pr($this->session->flashdata); 
               echo $this->session->flashdata('message');
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                  <div style="float:right">
                    <a href="<?php echo base_url();?>advocate/post/add">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                    </a>
                  </div>
                  <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
						<th>पदस्ता का प्रकार </th>
                        <th><?php echo $this->lang->line('adv_designation_label'); ?></th>
						<th><?php echo $this->lang->line('adv_full_post_label'); ?></th>
                        <th style="width: 150px;"><?php echo $this->lang->line('adv_vacancies_label'); ?></th>
                        <th><?php echo $this->lang->line('adv_state_label'); ?></th>
                        <th><?php echo $this->lang->line('adv_district_label'); ?></th>
						<th><?php echo "तहसील"; ?></th>
						<th><?php echo $this->lang->line('adv_taluka_label'); ?></th>
                       
                      
						<th style="width:90px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
                        foreach ($advocate_post as $key => $post) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
							 <td><?php if(array_key_exists($post['advocate_type'] ,advocate_posttype_array())){ echo advocate_posttype_array($post['advocate_type']); } ?></td>
 <td><?php echo isset($post['approved_posts'])?$post['approved_posts']:''?></td>                           
 <td><?php echo isset($post['vacant_seats'])?$post['vacant_seats']:''; ?></td>
                           
							<td><?php echo isset($post['filled_posts'])?$post['filled_posts']:''; ?></td>
                            <td><?php echo !empty( $post['state_id'])? getState( $post['state_id']):''?></td>
                            <td><?php echo !empty( $post['district_id'])? getDistrict_name($post['district_id']):'' ?></td>
                         <td><?php echo !empty( $post['tahsil_id'])? get_tahsil_name($post['tahsil_id']):'' ?></td>
							<td><?php echo !empty( $post['taluka_id'])? getTaluka_name($post['taluka_id']):'' ?></td>
                            <td>
                             <div class="btn-group">
                                <a href="<?php echo base_url('advocate');?>/edit_post/<?php echo $post['advocate_posting_id'];?>" class="btn  btn-twitter">Edit</a>
                                
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
        <style type="text/css">
        #leave_employee_filter{
          clear: both;
        }
        </style>
    
