 <?php $setion_id = getEmployeeSection();
	$notice_boards = getNoticeBoardInformation($setion_id); ?>
 <div class="box">
                <div class="box-header">
                 <h3 class="box-title"><?php echo $this->lang->line('dashboard_noticeboard'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-striped dataTable">
				  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Subject</th>
                      <th>Date</th>
					  <th>File</th>
                      <th style="width: 40px"></th>
                    </tr>
					</thead>
					<tbody>
					<?php
					$i =1;
					//pre($notice_boards);
					if(count($notice_boards)>0){
						foreach($notice_boards as $notice_board)
						{
							?>
							  <tr>
							  <td><?php echo $i; ?>.</td>
							  <td><?php echo isset($notice_board->notice_subject)?$notice_board->notice_subject:''; ?></td>
							  <td><?php echo isset($notice_board->notice_created_date)?date('d-m-Y' ,strtotime($notice_board->notice_created_date)):''; ?> </td>
							  <td><?php echo isset($notice_board->notice_attachment)?$notice_board->notice_attachment:''; ?> </td>
							  <td>
							  	<?php if ($this->session->userdata('admin_logged_in')){ ?>
							  		<a href="<?php echo base_url();?>admin/edit_notice/<?php echo $notice_board->notice_id;?>">View </a>
							  	<?php } ?>
							  </td>
							</tr>
							<?php 
							$i++;
						}
					}else{
						?><tr>  <td colspan="3"><?php echo "No Records Found"; ?></td></tr><?php 
		
					} 
					?>
					</tbody>
                   </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->