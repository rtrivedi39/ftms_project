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
					 
                   
                  </div>
                  <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
					
                </div><!-- /.box-header -->
                
                <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
					<table class="table table-condensed stripeTable12">
                        <tbody>
							<tr>
                            <th>#</th>
                            <th>Advocate</th>
								
                            <th>Total</th>
                            
						</tr>
                        			<?php
									$ss = 1;
									foreach($advocate_records as $record){ ?>					
                                    <tr class="stripeRow">
										<td><?php echo $ss; ?></td>
										<td><?php echo @$record->adm_name ?></td>
                                     	<td style="cursor:pointer" onclick="show_report(<?php echo $record->adm_id?>)">																																
    										<span data-toggle="tooltip" title="" class="badge bg-light-blue">
													<?php echo @$record->countadv; ?></span>
										</td>
										
                                   </tr>
									<?php $ss++ ; } ?>
							 </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
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
			function show_report(post_type)
			{
				window.location = "<?php echo  base_url(); ?>advocate/advocate_report/"+post_type;
			}
        </script>
        <style type="text/css">
        #leave_employee_filter{
          clear: both;
        }
        </style>
    