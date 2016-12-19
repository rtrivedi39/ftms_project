<div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <label for="Document">नस्ती / पत्र  का प्रकार </label> <span class="text-danger">*</span>
                            <select class="form-control" name="scan_file_types" id="scan_file_types" required="">
                                <option value="">चयन करें </option>
                                <option value="1">बाह्य पत्राचार</option>
                                <option value="2">बाह्य नोटशीट</option>
                                <option value="3">विभागीय नोटशीट</option>
                                <option value="4">विभागीय पत्राचार</option>
                            </select>
                            <?php echo form_error('scan_file_types');?>
                        </div>
                        <div class="col-xs-6">
                            <label for="Document">नस्ती / पत्र  का उप प्रकर </label> <span class="text-danger">*</span></label>
                            <select class="form-control" name="scan_subfile_types" id="scan_subfile_types" required="">
                            </select>
                        </div>
                    </div>
                </div>
<div class="form-group">
		<label for="Title">नस्ती / पत्र  का नाम</label>
		<input type="text" name="file_title" id="file_title" value="<?php if ($this->input->post('file_title')){ echo $this->input->post('file_title');} ?>" placeholder="File title" class="form-control" required>
</div>   
<div class="form-group"><label>नई नस्ती / पत्र  को अपलोड करने के लिए सभी  फील्ड्स को भरना अनिवार्य हें !</label></div>
<div class="form-group">
    <input id="uploadImage1" type="file" name="file_upload" onchange="PreviewImage(1);" style="float: left" required/>
	नस्ती / पत्र  का अपलोड साइज़ : 10 MB
    <input type="button" id="reset_pdf" value="Remove doc" style="float: right"/>
    <span id="dis_file_size"></span>
</div>
<div class="form-group" style="border: 1px solid gray;height: 600px;" id="scan_file_div">
    <!--  <object id="uploadPreview1" data="<?php echo base_url()?>/uploads/Viwer_example.pdf" width="100%" height="600px"></object>-->
</div>
<script type="text/javascript">
    function PreviewImage(no) {
        var  file_size1 = document.getElementById("uploadImage"+no).files[0].size/ 1048576;
        
        if(file_size1 <= '10') {
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage" + no).files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview" + no).data = oFREvent.target.result;
            };
            var sf = document.getElementById("uploadImage"+no).files[0].name;
            sf = sf.substring(0, sf.indexOf('.'));
            $('#file_title').val(sf);
        }
        else{
            alert('u choose more then 10 mb file');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            $('#uploadImage1').val('');
        }
    }
    $(document).ready(function(){
        $('#reset_pdf').on('click', function() {
            $('#uploadImage1').val('');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
        });
		
		 $("#scan_file_types").change(function() {
            var scan_file_types = $(this).val();
            
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "scan_files/get_subfiletype",
                datatype: "json",
                async: false,
                data: {scan_file_id: scan_file_types},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    
                    var otpt = '<option value="">Select</option>';
                    $.each(r_data, function( index, value ) {
                        
                        if(value.sub_file_type_hi != null) {
                            otpt += '<option value="' + value.type_id + '">' + value.sub_file_type_hi + '</option>';
                        }else{
                            otpt += '<option value="' + value.type_id + '">' + value.sub_file_type + '</option>';
                        }
                    });
                    $("#scan_subfile_types").html(otpt);
                }
            });
        });
		
    });
</script>