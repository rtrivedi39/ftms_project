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
    <?php echo $this->session->flashdata('message');    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="clearfix"></div>
                <div id="ajax_tbl"></div>
                <table id="advocates_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>जिला</th>
                        <th>तहसील</th>
                        <th>नाम</th>
                        <th>स्थिति</th>
						<th>विवरण</th>
                        <th>दिनांक</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
                    foreach ($get_pannel as $key => $users) { ?>
                        <tr>
                            <td>
                                <?php if(!empty($users['panel_district_id'])){ echo getDistrict_name($users['panel_district_id']);}else { echo 'N/A'; }?><br/>
                            </td>
                            <td>
                                <?php if(!empty($users['panel_tehsil_id'])){ echo get_tahsil_name($users['panel_tehsil_id']);   }else { echo 'N/A'; }?><br/>
                                <?php if(!empty($users['panel_taluka_id'])){ echo getTaluka_name($users['panel_taluka_id']);   }else { echo ''; }?>
                            </td>
                            <td>
                                <?php echo $users['scm_name_hi']; ?>
                                <br/>
                                <?php echo advocate_posttype_array($users['panel_post_id']); ?>
                            </td>
                            <td>
                                <?php echo @$users['panel_status'] == 'Y' ? 'हाँ' : ''; ?>
                                <?php echo @$users['panel_status'] == 'N' ? 'नही' : ''; ?>
                            </td>
							<td>
                                <?php echo $users['panel_discription'] ; ?>
                            </td>
                            <td>
                                <?php echo @$users['panel_status'] == 'Y' ? date('d-m-Y',strtotime($users['panel_create_date'])) : ''; ?>
                                <?php echo @$users['panel_status'] == 'N' ? date('d-m-Y',strtotime($users['panel_close_date'])) : ''; ?>
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
