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
        </div>
    </body>
    <?php $this->load->view('admin_notesheet_master/footer_js.php'); ?>
</html>