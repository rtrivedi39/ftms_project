<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<div class="modal fade" id="modal-send_despetch_section" data-backdrop="static">
    <div class="modal-dialog">
       
        <form id="form_submit_despetch_section"  method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल  जावक शाखा को भेजे
					</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <div class="form-group">
                                        <label>कृप्या सुनिश्चित करे की आप नस्ती/पत्र की E-file/P-file की कापी को भेजना चाहते हैं ?</label>
                                    </div>
                                    <div class="form-group checkbox">
                                        <label>
                                            <input type="checkbox" id="physical_file" name="file_status[]" class="form-group physical_file" value="p"  > Physical File
                                        </label>
                                        <label>
                                            <input type="checkbox" id="electronic_file" name="file_status[]" value="e" class="form-group electronic_file"  >E-File
                                        </label>
                                    </div>
									<div class="efile_div"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> भेजें</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
/*send to despetch section*/
	function send_despetch_section(file , file_status){
        var file2 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){

			 $(".physical_file").prop( "checked", true );
			 $(".physical_file").prop( "disabled", true );

			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
		}
		else{
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".physical_file").prop( "checked", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
			
			
			
		}
        $('#modal-id2').val(file2);
        $('#modal-send_despetch_section').modal('show');
        $('#form_submit_despetch_section').attr('action','<?php echo base_url() ;?>manage_file/dispatch_file_byso/'+file2);
    }
	/*send to despetch section*/
	
</script>