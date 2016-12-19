<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
    function receive_DA(file,file_status){
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
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}

		}
		
        $('#modal-id2').val(file2);
        $('#modal-da_receive_file').modal('show');
        $('#form_submit_link_for_da').attr('action','<?php echo base_url() ;?>view_file/dealing_file/receive_file_da/'+file2);
    }
</script>
<div class="modal fade" id="modal-da_receive_file" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form id="form_submit_link_for_da"  method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल प्राप्त करे </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <div class="form-group">
                                        <label>कृप्या सुनिश्चित करे की आपके पास फाइल आई है अथवा नही |</label>
                                    </div>
                                    <div class="form-group checkbox">
                                        <label>
                                            <input type="checkbox" id="p+hysical_file" name="file_status[]" class="form-group physical_file" value="p" >Physical File

                                        </label>
                                        <label>
                                            <input type="checkbox" id="electronic_file" name="file_status[]" value="e" class="form-group electronic_file"  >E-File


                                        </label>
                                    </div>
                                    <div class="efile_div">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> प्राप्त करें</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function open_model_csu(file){
	var file_status12 = $('.btn_mark_csu').data('file_status12'); /*// get file_status12*/
	if(file_status12 == 'e'){
		file_status12 = 'e,p';
		}
    var file5 = file;
    $('#modal-mark_to_csu').modal('show');
	$('#csu_mark').html(file5);
	$('#file_status12').val(file_status12);
	$('#form_submit_csu').attr('action','<?php echo base_url()?>scan_files/file_mark_cus/'+file5);
}
</script>
<!--receive model-->
<div class="modal fade" id="modal-mark_to_csu" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form role="form" method="post" action="<?php echo base_url()?>view_file/Dealing_file/Sent_to_DA">-->
        <form method="post" id="form_submit_csu">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>सेंट्रल स्कैन यूनिट में भेजें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
									<input type="hidden" id="file_status12" name="file_status12" />
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="cus_remark"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button onclick="return confirm('क्या फाइल को आप सेंट्रल स्कैन यूनिट में मार्क करना कहते है |')" type="submit" name="return_tocr" value="return_tocr" class="btn btn-primary"><i class="fa fa-share"></i> Return</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->