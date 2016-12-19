<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo $this->lang->line('notesheet_title_label'); ?></li>
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
                    <a href="<?php echo base_url('admin');?>/add_notesheet">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_notesheet_label')?></button>
                    </a>
                  </div>
                  <div style="float:right;margin-right: 10px;">
                    <a href="javascript:history.go(-1)">
                      <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </a>
                  </div>
                </div>
                <!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); ?>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th><?php echo $this->lang->line('list_label_notesheet_title'); ?></th>
                        <th><?php echo $this->lang->line('list_label_notesheet_sectionid'); ?></th>
                        <th><?php echo $this->lang->line('list_label_notesheet_headid'); ?></th>
                        <th><?php echo $this->lang->line('list_label_notesheet_fileattach'); ?></th>
                        <th><?php echo $this->lang->line('list_label_datetime'); ?></th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($notesheet_list as $key => $notesheet) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $notesheet['notesheet_title'];?></td>
                          <td>
                              <?php 
                                $section_master_list = get_list(SECTIONS, null,array('section_id'=>$notesheet['section_id']));
                              ?>
                              <span title="<?php echo $section_master_list[0]['section_name_en']; ?>"><?php echo $section_master_list[0]['section_name_hi']; ?></span>
                          </td>
                          <td>
                            <?php if($notesheet['head_id']!='' && $notesheet['head_id']!=0){ ?>
                            <?php $notesheet_head_detail = get_list(FILE_NOTESHEET_HEADER_MASTER, null,array('head_id'=>$notesheet['head_id']));?>
                              <span title="<?php echo $notesheet_head_detail[0]['head_court']; ?>"><?php echo $notesheet_head_detail[0]['head_title'];?>-(<?php echo $notesheet_head_detail[0]['head_code'];?>)</span>
                              <?php }else{ ?>
                              <?php }?>
                          </td>
                          <td>
                            <a target="_blank" href="<?php echo base_url();?>admin_notesheet_master/view_file_notesheet/<?php echo $notesheet['notesheet_id'].'/'.$notesheet['section_id'];?>" class="btn btn-primary"><i class="fa fa-download"></i> Notesheet(<?php echo getSection($notesheet['section_id'], true).'/'.$notesheet['notesheet_id']; ?>)</a>
                            <?php //echo $notesheet['file_name'];?>
                          </td>
                          <td><?php echo $notesheet['created_datetime'];?></td>
                          <td>
                              <div class="btn-group">
                                <a  href="<?php echo base_url('admin');?>/edit_notesheet/<?php echo $notesheet['notesheet_id'];?>" class="btn  btn-twitter"><?php echo $this->lang->line('edit'); ?></a>
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
          clear:both;
        }
        </style>
    