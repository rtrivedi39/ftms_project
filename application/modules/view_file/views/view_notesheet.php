<html>
    <head>
        <meta charset="UTF-8">
        <title>View and print notesheet</title>
        <link href="<?php echo base_url(); ?>themes/notesheet_style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div contenteditable="true" class="show_content" style="width:70%;">
            <?php echo htmlspecialchars_decode($contains); ?>
        </div> 
        <div class="sticky sticky_class no-print">
            <button type="button" onclick="window.print()" class="no-print btn bg-maroon margin">Print Content</button>
			 <button type="button" onclick="save_notesheet();"  class="btn btn-primary margin" value="" name="savepdf">Save and Continue</button> 
        </div>
    </body>
    <?php $this->load->view('admin_notesheet_master/footer_js.php'); ?>
</html>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>

<script>
function save_notesheet(){

	var content1 = $('.show_content').html(); 
	content1 = encrypt('encode',content1);
	var file_log_id = "<?php echo $this->uri->segment(4) ?>"; 
	var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                url: HTTP_PATH + "admin_notesheet_master/notesheet_generate/again_save_notesheet/",
                type: 'POST',
                data: {
                content1: content1,file_log_id:file_log_id
                },       
                success: function(data) {
					alert(data);
					
				}
			});
}
</script>
<style>
p{ text-indent: 0;  }
td.top_class {vertical-align: top;}
.text_for_post{ width:70%; text-align:center;}
td.top_class {vertical-align: top;}
.text-justify{text-align: justify }
.font-large{ font-size:26px; }
.officer-center{ width:70%; text-align:center; }
.shift-left{ text-indent:50px }
</style>