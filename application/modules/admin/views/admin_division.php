<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!--<small>Optional description</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo $this->lang->line('division') ?></li>
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
                    <a href="<?php echo base_url('admin');?>/add_division">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_division') ?></button>
                    </a>
                    </div>
                </div><!-- /.box-header -->
                  <?php if($this->session->flashdata('update') || $this->session->flashdata('insert') || $this->session->flashdata('delete') ){ ?>  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>
                              <?php  echo $this->session->flashdata('update');
                              echo $this->session->flashdata('delete');
                              echo $this->session->flashdata('insert'); ?>
                      </strong><br>
                      </div>
                  <?php }?>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('sno') ?></th>
                        <th><?php echo $this->lang->line('division_hi') ?></th>
                        <th><?php echo $this->lang->line('division_en') ?></th>
                        <th><?php echo $this->lang->line('action') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($get_division as $key => $division) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $division['division_name_hi'];?></td>
                          <td><?php echo $division['division_name_en'];?></td>
                         <td>
                              <div class="btn-group">
                                <a href="<?php echo base_url('admin');?>/manage_division/<?php echo $division['division_id'];?>" class="btn  btn-twitter"><?php echo $this->lang->line('edit') ?></a>
								 <a onclick="return confirm('Are you sure you want to delete..!!')" href="<?php echo base_url('admin');?>/division_delete/<?php echo $division['division_id'];?>" class="btn  btn-info ">Delete</a>
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
    