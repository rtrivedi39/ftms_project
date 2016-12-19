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
                      <a href="<?php echo base_url('admin');?>/manage_heads">
                        <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                      </a>
                    </div>
                    <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                 <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); }?>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th width="20%"><?php echo $this->lang->line('heads_section'); ?></th>
                        <th width="30%"><?php echo $this->lang->line('heads_code'); ?></th>
                        <th><?php echo $this->lang->line('heads_title'); ?></th>
                        <th width="100px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  if((count($get_heads)>0) && is_array($get_heads)) {?>
                      <?php $i=1; foreach (@$get_heads as $key => $head) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo  (@$head['section_id'])?getSection($head['section_id']):'';   ?></td>
                          <td><?php echo $head['head_code'];?></td>
                          <td><?php echo $head['head_title'];?></td>
                         
                         
                          <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url('admin');?>/edit_heads/<?php echo $head['head_master_id'];?>" class="btn  btn-twitter">Edit</a>
                                <a href="<?php echo base_url('admin');?>/delete_head/<?php echo $head['head_master_id'];?>" onclick="return is_delete();" class="btn  btn-danger">Delete</a>
                              </div>
                            </td>
                        </tr>
                      <?php $i++; } }else {?>
						<tr>
							<td>
								No record found
                            </td>
                        </tr>
					  <?php }?>
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
    