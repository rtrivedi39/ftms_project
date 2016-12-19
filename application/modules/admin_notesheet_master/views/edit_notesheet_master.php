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
               <form method="post" name="save_draft" action="<?php echo base_url(); ?>admin_notesheet_master/save_notesheet/<?php echo $this->input->get('dedit_id'); ?>/<?php echo $this->input->get('dlang'); ?>">
					<div class="box-body" id="forPrint" style="">
                        <div  contenteditable="true" class="show_content" >


                            <?php 
							$final_contents = filter_string($draft_data['draft_content_text']);

								if($is_genrate == true){
									echo $final_contents;
								} else {
									echo $final_contents;
								}
							
								
                            ?>							
                        </div>
						  <div class="form-group">
						  <label> अधिकारी के नाम को बदलने के लिये चयन करे</label>
						<?php $selected = $draft_data['order_generat_officer_id']; ?>
						  <?php if($this->input->get('dlang') == 'HI'){ 
								echo get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', '','',$selected);
						  } else { 
								echo get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,"en", '','',$selected);
						  }?>
						</div>
												
						<input type="hidden" value="<?php echo isset($draft_data['draft_file_id'])?$draft_data['draft_file_id']:'' ?>" name="file_id" id="file_id"/>
						
						<input type="hidden" value="" name="final_content" id="final_content"/>
                    </div><!-- /.box-body -->
                    <div class="box-footer" >
                       
                            <div class="sticky sticky_class no-print">
                                <!--<label><input type="checkbox" name="isnotesheet" value="yes" title="नोटशीट निकालना">नोटशीट निकालना</label><br/>-->
                                <button type="submit"  onClick="put_content();"  class="btn btn-success " value="Generate" name="generate">Generate</button>
                            </div>
                      
                    </div>
                </form>
            </div>	<!-- /.box -->
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->
<?php $this->load->view('footer_js.php'); ?>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>
<script>

function put_content(){	
		var res = confirm('कृपया सुनिश्चित कर ले यह  ड्राफ्ट फाइल पर जोड़ रहे है');
		if(res==false){
			return false;
		}	
		var content1 = $('.show_content').html().trim();
		content1 = encrypt('encode',content1);
		$("#final_content").val(content1);
	}
</script>