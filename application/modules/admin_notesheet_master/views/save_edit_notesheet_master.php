<!-- Content Header (Page header) -->
<link href="<?php echo base_url(); ?>themes/e_file_style.css" rel="stylesheet" type="text/css" />
<?php 
$uber_sect = 7 ;
$secetry = 4 ;
$add_secetroy = 5 ;
//get  secretary law

?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'dashboard'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin');?>/notesheets"> <?php echo $title; ?></a></li>
            <li class="active"><?php echo $page_title; ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <!-- Various colors -->
            <div class="box box-primary">
                <div class="box-header no-print">
                    <h3 class="box-title"><?php echo $page_title; ?></h3>
					
					<div class="box-tools pull-right">
						 <!--<button type="button" onclick="return window.close();" >बंद करे</button>-->
						<button class="btn btn-warning" onclick="goBack()" data-toggle="tooltip" data-original-title="Back"><?php echo $this->lang->line('Back_button_label'); ?></button>
					</div>
				</div>
				<?php //print_r($draft_data);?>
               <form method="post" name="save_draft" action="<?php echo base_url(); ?>admin_notesheet_master/save_notesheet?dedit_id=<?php echo $this->input->get('dedit_id'); ?>">
					<div class="box-body" id="forPrint" style="">



                        <div  contenteditable="true" 	style="" class="show_content" >
						<?php echo filter_string($draft_content_text); ?>
						</div>
						 <input type="hidden" value="<?php echo $this->input->post('sing_user'); ?>" name="sing_user" id="sing_user"/>
						 <input type="hidden" value="<?php echo $this->input->post('file_id'); ?>" name="file_id" id="file_id_txt"/>
                    </div><!-- /.box-body -->
                    <div class="box-footer" >
                       
                            <div class="sticky sticky_class no-print">
                                 <button type="button" onclick="update_notesheet();" id="btnsave_content" class="btn btn-primary margin" value="" name="संशोधित करे" title="संशोधित किया गया डाटा सुरक्षित करे">सुरक्षित करे </button> <!--data-loading-text="Saving..."-->
                                <button type="button" onclick="goBack()" class="no-print btn btn-warning margin">पुनः संशोधित करे</button>
                                <button type="button" onclick="printDiv('forPrint')" class="no-print btn bg-maroon margin">Print Content</button>
                            </div>
                       
                           
                      
                    </div>
                </form>
            </div>	<!-- /.box -->
        </div>
    </div><!-- /.row -->
            </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
        
       
<?php $this->load->view('footer_js.php'); ?>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>
<script>
function update_notesheet(){

 
	var conf = confirm('कपया सुनिश्चित करें कि आप इसे सुरक्षित करना चाहते है | ') ;
	
	if(conf == false ){
		return false;
	}
	$('#btnsave_content').button('loading');
	var content1 = $('.show_content').html().trim();
	content1 = encrypt('encode',content1);

	
	var file_id = $("#file_id_txt").val(); 
	var draft_id = "<?php echo $this->uri->segment(3) ?>"; 
	var officer_id = $("#sing_user").val(); 
	var yes_ajax = 'yes_ajax';
	var HTTP_PATH='<?php echo base_url(); ?>';
           $.ajax({
                url: HTTP_PATH + "admin_notesheet_master/update_notesheet_content/",
                type: 'POST',
				
                data: {
                 content1: content1,officer_id:officer_id,draft_id:draft_id,file_id:file_id,req_type:yes_ajax

                },       
                success: function(data) {
					
					window.location="<?php echo base_url(); ?>efile/"+file_id;

				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("some error"+textStatus);
					}
			});
}
</script>