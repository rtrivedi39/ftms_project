<style>
    @-webkit-keyframes spaceboots {
        /*   0% { -webkit-transform: translate(2px, 1px) rotate(0deg); }
           10% { -webkit-transform: translate(-1px, -2px) rotate(-1deg); }
           20% { -webkit-transform: translate(-3px, 0px) rotate(1deg); }
           30% { -webkit-transform: translate(0px, 2px) rotate(0deg); }
           40% { -webkit-transform: translate(1px, -1px) rotate(1deg); }
           50% { -webkit-transform: translate(-1px, 2px) rotate(-1deg); }
           60% { -webkit-transform: translate(-3px, 1px) rotate(0deg); }
           70% { -webkit-transform: translate(2px, 1px) rotate(-1deg); }
           80% { -webkit-transform: translate(-1px, -1px) rotate(1deg); }
           90% { -webkit-transform: translate(2px, 2px) rotate(0deg); }
           100% { -webkit-transform: translate(1px, -2px) rotate(-1deg); }*/
        10%, 90% {
            transform: translate3d(-1px, 0, 0);
        }

        20%, 80% {
            transform: translate3d(2px, 0, 0);
        }

        30%, 50%, 70% {
            transform: translate3d(-4px, 0, 0);
        }

        40%, 60% {
            transform: translate3d(4px, 0, 0);
        }
    }
    .shake{
        -webkit-animation-name: spaceboots;
        -webkit-animation-duration: 1.0s; /* for change shake speed*/
        -webkit-transform-origin:50% 50%;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
    }
    .shake:hover  {
        -webkit-animation-duration: 0.0s;
        -webkit-animation-iteration-count: zero;
        -webkit-animation-timing-function: zero;
    }
    .shake:focus  {
        -webkit-animation-duration: 0.0s;
        -webkit-animation-iteration-count: zero;
        -webkit-animation-timing-function: zero;
    }
</style>

<div class="col-md-12" id="dynamictabstrp"> <!--shake-->
    <div class="box box-warning direct-chat direct-chat-warning direct-chat-contacts-open">
        <div class="box-header with-border">
            <h3 class="box-title">पी .एस. मॉनिटर फ़ाइलें जिसमे मोनिट अवधि पूर्ण हो चुकी है या आज पूर्ण होने वाली है |</h3>
            <div class="box-tools pull-right">
                <button onclick="printContents('dynamictabstrp')" class="btn btn-primary no-print">प्रिंट</button>
                <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12">
                <?php $arr_ps = ps_monitor_marked_report('data',"today" , emp_session_id()); ?>
                <table class="table table-hover">
                    <tbody>
                    <?php if($arr_ps){
                        foreach($arr_ps as $arr_ps1){?>
                            <tr>
                                <td width="150px">
                                    <?php $rrt = all_getfilesec_id_byfileid($arr_ps1['file_id']);
                                    foreach($rrt as $rrt1){ $sechi =  getSectionName($rrt1['section_id']);
                                        echo "<b>".$rrt1['section_number'] ."</b> - <span title='पंजी क्रं' style='font-size: 12px'>".$sechi."</span><br/>";
                                    }?>
                                </td>
                                <td><a class="text-black" href="<?php echo base_url()."view_file/viewdetails/".$arr_ps1['file_id'] ;?>"><?php echo $arr_ps1['file_subject']; ?></a></td>
                                <td width="15%"><a href="<?php echo base_url()."view_file/viewdetails/".$arr_ps1['file_id'] ;?>"><lable style="display: block;" type="button" class="badge bg-light-blue <?php echo $arr_ps1['ps_moniter_date'] < date("Y-m-d")? "shake" : false ?>"><i class="fa fa-fw fa-arrow-left"></i> <?php echo "<b>Monit Date : ".date_format(date_create($arr_ps1['ps_moniter_date']), 'd/m/y')."</b>"; ?></lable></a></td>
                            </tr>
                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer no-print">
            <div class="box-tools pull-right">
                <a class="btn btn-default" href="<?php echo base_url(); ?>ps_file_monitor"><i class="fa fa-fw fa-eye"></i> पी .एस. मॉनिटर फ़ाइलें</a>
                <button class="btn btn-default" data-widget="remove"><i class="fa fa-times"></i> Skip</button>
            </div>
        </div><!-- /.box-footer-->
    </div>
</div>