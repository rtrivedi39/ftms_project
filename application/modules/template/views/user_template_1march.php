<?php //echo Modules::run('admin_header'); ?>
<?php $this->load->view('admin/admin_header'); ?>

<?php $this->load->view('admin/left_sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php //$this->load->view($module_name.'/'.$view_file); ?>
   <!-- <marquee class="bg-light-blue-active color-palette" behavior="alternate" ><i style="animation: 0.75s linear 0s normal none infinite running blink;">कम्‍प्‍यूटर संबंधी शिकायतों /मरम्‍मत कार्य हेतु ऑनलाईन आवेदन करने पर ही शिकायत पर कार्य किया जाएगा।</i> </marquee>-->
	<?php
	if(show_view_as_lvl()!='404'){
		$total_file =  count_total_ps_monitor_files();
        if($total_file>0){
            $empssection = empdetails(emp_session_id());
                 $total_file=null;                
                if($empssection[0]['role_id']==3 && checkUserrole()!=3){ ?><a href="<?php echo base_url(); ?>ps_file_monitor"><marquee class="bg-navy" ><i style="animation: 0.75s linear 0s normal none infinite running blink;">प्रमुख सचिव विधि के मोनिट में नई फ़ाइल जोड़ी गयी हैं</i> </marquee>	</a>
                <?php } else if( isset($userrole) && $userrole==3){ ?>
						<!--<a href="<?php echo base_url(); ?>ps_file_monitor"><marquee class="bg-navy"><i style="animation: 0.75s linear 0s normal none infinite running blink;">PS have you marked some PS Monitoring File please click here.</i> </marquee>	</a>-->
				<?php }else{ 
                    $is_file_alloted= check_ps_monitor_file_is_alloted('count',$this->session->userdata("emp_id"));
                 if($is_file_alloted>0 && checkUserrole()!=3){?>
                    <a href="<?php echo base_url(); ?>ps_file_monitor?empid=<?php echo $this->session->userdata("emp_id"); ?>"><marquee class="bg-navy"><i style="animation: 0.75s linear 0s normal none infinite running blink;">प्रमुख सचिव विधि के मोनिट में नई फ़ाइल जोड़ी गयी हैं </i> </marquee>	</a>
	<?php }}} }?>
    <?php $this->load->view($view_file); ?>
</div><!-- /.content-wrapper -->
<?php //echo Modules::run('admin_footer'); ?>

<?php $this->load->view('admin/admin_footer'); ?>