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
								पंजी क्रमांक :- <b><?php  echo get_panji_no($file_dat_show[0]['file_id'],$file_dat_show[0]['file_mark_section_id'],$file_dat_show[0]['file_created_date']);  ?></b><br/>
                                File Date :-  <?php echo $file_dat_show[0]['file_uo_or_letter_date'] ?><br/>
                                File Subject :-  <?php echo $file_dat_show[0]['file_subject'] ?>
                                <?php  // $this->session->set_userdata('file_r',$file_dat_show[0]['file_uo_or_letter_no']);
                                // pr($this->session->userdata('file_r'));
                                ?>
                            </p>
                        <?php } ?>
                        <div class="panel-group" id="accordion">
                            <div class="col-md-5 col-xs-12">
                                <?php
                                $i = 1;
                                //pre($notesheets_menu_list);
                                $count = count($notesheets_menu_list);
                                if (isset($notesheets_menu_list) && !empty($notesheets_menu_list)) {
                                    foreach ($notesheets_menu_list as $key => $docdata) {
                                        if ($i % 2 == 1) {
                                            $clas = "primary";
                                            $cls = "class='btn bg-purple btn-flat margin'";
                                        } else {
                                            $clas = "danger";
                                            $cls = "class='btn bg-olive btn-flat margin'";
                                        }
                                        ?>
                                        <div class="panel panel-<?php echo $clas; ?> template no-padding  margin" >
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>">
                                                        <?php echo $docdata['notesheet_menu_title_hi']; ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php
                                                    $notesheets = $this->notesheet_model->get_all_notesheets($docdata['notesheet_menu_id']);
                                                    if (isset($notesheets) && !empty($notesheets)) {
                                                        foreach ($notesheets as $nkey => $nvalue) {
                                                            ?>
                                                            <?php if (isset($file_dat_show)) { 
                                                                $url = 'admin_notesheet_master/view_file_notesheet/' ;
                                                                $file_id = $file_dat_show[0]['file_id'];
                                                                $target = 'target="_blank"';
                                                                } else {
                                                                    $url = 'attached/doc_file/1/';
                                                                    $file_id = '';
                                                                    $target = '';
                                                                }
                                                                ?>
                                                                <a href="<?php echo base_url().$url; ?><?php echo $nvalue['notesheet_id'] . '/' . $docdata['section_id'] . '/' . $file_id; ?>" <?php echo $cls.' '.$target; ?>  >
                                                                    <?php echo $nvalue['notesheet_title']; ?>
                                                                </a>
                                <?php } ?>
                                                    <?php } else {
                                                       echo 'No notesheet found!'; 
                                                    }
                                                    ?>
                    </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($i % ($count / 2) == 0) {
                                            echo '</div><div class="col-md-5 col-xs-12">';
                                        }
                                        ?>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                <?php } else {
                                        echo 'No notesheet found!'; 
                                     }?>
                            </div>
                        </div> <!-- accordion -->
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
