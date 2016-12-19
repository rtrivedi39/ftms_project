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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button class="btn btn-block btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->

                <!-- Various colors -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Generate Notesheet</h3>
                    </div>
                    <div class="box-body" align="center">
                        <?php if (isset($file_dat_show)) { ?>
                            <p>
                                File No :- <?php echo $file_dat_show[0]['file_uo_or_letter_no'] ?><br/>
                                File Date :-  <?php echo $file_dat_show[0]['file_uo_or_letter_date'] ?><br/>
                                File Subject :-  <?php echo $file_dat_show[0]['file_subject'] ?>
                                <?php  // $this->session->set_userdata('file_r',$file_dat_show[0]['file_uo_or_letter_no']);
                                // pr($this->session->userdata('file_r'));
                                ?>
                            </p>
                        <?php } ?>
                        <p><?php //pre($get_notesheet); ?>
                            <?php   $i=1; foreach($get_notesheet as $key => $docdata){
                                if ($i%2 == 1) { $cls = "class='btn bg-purple btn-flat margin'"; }else{
                                    $cls = "class='btn bg-olive btn-flat margin'"; } ?>
                                <?php if (isset($file_dat_show)) { ?>
                                    <a  target="_blank" href="<?php echo base_url();?>admin_notesheet_master/get_file_notesheet/<?php echo $docdata['file_name'] ?>?fileid=<?php if (isset($file_dat_show)) { echo $file_dat_show[0]['file_id']; } ?>&ntype=<?php if(isset($docdata['notesheet_type'])){ echo $docdata['notesheet_type']; } ?>&nid=<?php if(isset($docdata['notesheet_id'])){ echo $docdata['notesheet_id']; } ?>" <?php echo $cls; ?> target="_blank" ><?php echo $docdata['notesheet_title']; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url();?>Attached/Doc_File/<?php echo $docdata['notesheet_menu_id'] ?>" <?php echo $cls; ?> ><?php echo $docdata['notesheet_menu_title_hi']; ?></a>
                                <?php } ?>
                                <?php $i++; }?>
                        </p>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
