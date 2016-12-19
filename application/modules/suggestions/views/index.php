<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?> - <span> कृपया FTMS के लिए  सुझाव यहाँ जोड़े , प्रिंटर /कंप्यूटर के लिए आवेदन "<a href="<?php echo base_url(); ?>/establishment/add_complaints"><u>आवेदन</u></a>" पर जा कर करें |</span>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
			 <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">					
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php }  ?>
				<div class="box-header">
				 <h3 class="box-title"><?php echo $title_tab;?></h3>
				   <div class="btn-group">
						<a href="?type=p"  class="btn btn-warning <?php echo ($this->input->get('type') && $this->input->get('type') == 'p' || $this->input->get('type') == '') ? 'disabled' : ''; ?>">Pending</a>
						<a href="?type=f"  class="btn btn-success <?php echo ($this->input->get('type') && $this->input->get('type') == 'f') ? 'disabled' : ''; ?>">Finished </a>
						<a href="?type=all"  class="btn btn-primary <?php echo ($this->input->get('type') && $this->input->get('type') == 'all') ? 'disabled' : ''; ?>">All </a>
				   </div>
                    <div class="box-tools pull-right">
                    <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                    <a href="<?php echo base_url();?>add_suggestion"  class="btn btn-warning">सुझाव जोड़े</a>
					<a href="javascript:history.go(-1)">
						<button class="btn  btn-warning" type="button"><?php echo $this->lang->line('Back_button_label'); ?></button>
					</a>
					</div>
				</div><!-- /.box-header -->		
				<div class="box-body">	
					
						<table class="table table-bordered table-striped dataTable"> 
						<thead>
						<tr><th>क्रमांक</th><th>विषय</th><th>स्थिति</th><th>सुझाव दिनांक</th><th>निराकरण दिनांक</th>
						<?php if(checkUserrole() == 1) { ?> <th>सुझावकर्ता </th> <?php } ?><th>कार्यवाही </th>
						</tr>
						</thead>
						<?php  if($get_suggestion_list != '') {?>
						<tbody>
						<?php $i = 1; foreach($get_suggestion_list as $suggestion){ ?>
						<tr>
							<td><?php echo $i ; ?></td>
							<td><?php echo $suggestion['suggestion_name']; ?></td>
							<td><?php  if($suggestion['suggestion_status'] == '0') { ?>
								<label class="label label-danger">कार्यवाही की जा रही है</label>
							<?php } else { ?>
								<label class="label label-success">कार्यवाही पूर्ण</label>
							<?php } ?></td>
							<td><?php echo get_date_formate($suggestion['suggestion_createat']); ?></td>
							<td><?php $days = day_difference_dates($suggestion['suggestion_createat'], $suggestion['suggestion_solved_date']);
							if($days <= 3){ $lb_class = 'primary'; } else if($days > 3 && $days <= 7){ $lb_class = 'warning'; } else if($days > 7 ){ $lb_class = 'danger'; }
							echo $suggestion['suggestion_status'] == '1' ? 
							get_date_formate($suggestion['suggestion_solved_date']).'<br/><label class="label label-'.$lb_class.'">'.$days.' days</label>' :
							'N/A';  ?></td>
							<?php if(checkUserrole() == 1) { ?>
							<td><?php echo getemployeeName($suggestion['suggestion_emp'],true); ?></td>
							<?php } ?>
							<td>
							<a href="<?php echo base_url();?>view_suggestion/<?php echo $suggestion['suggestion_id'];?>"  class="btn btn-block btn-primary">View</a>
							<?php if(checkUserrole() == 1 && $suggestion['suggestion_status'] == '0') { ?>
							<a href="<?php echo base_url();?>finish_suggestion/<?php echo $suggestion['suggestion_id'];?>"  class="btn btn-block btn-success" onClick="return confirm('क्या आप इसे बंद करना चाहते है');">Finish</a>
							<?php } ?>
							</td>
							
						</tr>
							
						<?php $i++; } ?>
						</tbody>
					<?php } else {
						//echo "No record";
					} ?>
					</table>
				</div><!-- /.box 

				-->
            </div><!-- /.box -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->


    