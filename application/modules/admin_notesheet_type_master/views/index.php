<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url('admin').'/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                    <a href="<?php echo base_url('admin');?>/add_notesheet_master_menu">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_notesheet_label')?></button>
                    </a>
                  </div>
                </div>
                <!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); ?>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th><?php echo $this->lang->line('list_label_notesheet_sectionid'); ?></th>
                        <th><?php echo $this->lang->line('list_label_notesheet_title_hi'); ?></th>
                        <th><?php echo $this->lang->line('list_label_notesheet_title_en'); ?></th>
                        <th><?php echo $this->lang->line('list_label_datetime'); ?></th>
                        <th><?php echo $this->lang->line('action'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($nt_menu_master_list as $key => $mastmenu) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td>
                              <?php $section_detail= get_list(SECTIONS,null, array('section_id'=>$mastmenu['section_id']));?>
                              <?php echo $section_detail[0]['section_name_hi']?>(<?php echo $section_detail[0]['section_name_en']?>)
                          </td>
                          <td><?php echo $mastmenu['notesheet_menu_title_hi'];?></td>
                          <td><?php echo $mastmenu['notesheet_menu_title_en'];?></td>
                          <td><?php echo $mastmenu['notesheet_menu_created_date'];?></td>
                          <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url('admin');?>/edit_notesheet_master_menu/<?php echo $mastmenu['notesheet_menu_id'];?>" class="btn  btn-twitter"><?php echo $this->lang->line('edit'); ?></a>
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
    