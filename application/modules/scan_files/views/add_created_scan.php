<div class="form-group content_add">
        <input type="button"  class="btn btn-primary btn-block" id="search_scan_file" name="search_scan" value="Extra Search"/>
 </div>
<div class="box box-primary show_list content_add" style="display: none" >
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title rt">Uploaded Files list</h3>
    </div><!-- /.box-header -->
    <div class="box-body" id="display_ul">
    </div><!-- /.box-body -->
    <div id="search_result"></div>
    <div class="box-footer clearfix no-border">
        <input type="button" class="btn btn-default pull-right" disabled id="select_pdf_show" name="" value="Select item" />
    </div>
</div>
<script>
    $(document).ready(function(){
 var HTTP_PATH = '<?php echo base_url(); ?>';
        $("#search_scan_file").on("click", function(){
            $(".show_list").show();
            if($("#meta_key").val() == '' && $("#doc_scan_type").val() == '' && $("#mark_to_section").val() == ''){
                alert('Plz enter meta key or Document type');
            }else {

               var file_offer_by = $("#file_offer_by").val();
                if (file_offer_by == 'v') {
                    var from_place = $("#file_department_id").val();
                } else if (file_offer_by == 'c' || file_offer_by == 'jvn') {
                    var from_place = $("#district_id").val();
                } else if (file_offer_by == 'm' || file_offer_by == 'u') {
                    var from_place = $("#court_bench").val();
                } else if (file_offer_by == 'au') {
                    var from_place = $("#state_id").val();
                } else if (file_offer_by == 'sc') {
                    var from_place = $("#gov_adocate_delhi").val();
                } else {
                    var from_place = $("#file_department_name").val();
                }
                var meta_key = $("#meta_key").val();
            /*  var file_subject = $("#file_subject").val();*/
                var mark_to_section = $("#mark_to_section").val();
            /*  var file_title = $("#file_title").val();*/
                var doc_scan_type = $("#doc_scan_type").val();

                $.ajax({
                    type: "POST",
                    url: HTTP_PATH + "scan_files/search_scan_file",
                    datatype: "json",
                    async: false,
                    data: {
                        meta_key: meta_key,
                        mark_to_section: mark_to_section,
                        scan_type: doc_scan_type
                    }, 
                    success: function (data) {
                      /*   console.log(data);*/
                        var r_data = JSON.parse(data);
                        if (r_data.length > 0) {
                            $("#search_result").html('');
                            $("#select_pdf_show").prop('disabled',false);
                            var otpt = '<ul class="todo-list ui-sortable">';
                            $.each(r_data, function (index, value) {
                                otpt += '<li class=""><input type="checkbox" value="'+value.scan_id+'" name="scan_file_name"><span class="text" id="scan_sub_name_'+value.scan_id+'">' + value.scan_subject + '</span><div class="tools" onclick="pdf_open_file('+value.scan_id+');"><i class="fa fa-fw fa-file-pdf-o"></i> View Pdf</div></li>';
                            });
                            otpt += '</ul>';
                            
                            $("#search_result").html(otpt);
                        }
                        else {
                            $("#search_result").html('Files not Found..!');
                        }
                    }
                });
            }
        });

        $("#select_pdf_show").click(function(){
            var scan_file_id = [];
            var scan_file_name = [];
            $.each($("input[name='scan_file_name']:checked"), function(){
                scan_file_id.push($(this).val());

                var scan_file_name_1 = $("#scan_sub_name_"+$(this).val()).text();
                scan_file_name.push(scan_file_name_1);
            });
            var scan_opt ='';
            scan_opt = "<ul class='todo-list ui-sortable'>";
            
            for(var file = 0;file < scan_file_id.length; file++){
                scan_opt += "<li class='my_scan_file_"+scan_file_id[file]+"'><span class='text' onclick='pdf_open_file("+scan_file_id[file]+")'>"+scan_file_name[file]+"</span><div class='tools' onclick='remove_scan_file("+scan_file_id[file]+")'><i class='fa fa-fw fa-file-pdf-o'></i> Remove</div></li>";
            }
            scan_opt += "<ul>";
            $("#scan_files_id").val(scan_file_id.join(","));
            $("#upload_files_list").html(scan_opt);
            $(".content_add").hide();
            $("#select_pdf_show").hide();
            $("#search_result").hide();
            $(".rt").html('Select Files list');
        });

    });
    function pdf_open_file(scan_id,file_path)
    {
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "scan_file_open",
            datatype: "json",
            async: false,
            data: {scan_id: scan_id },
            success: function(data) {
                $('#modal-scan_file').modal('show');
                $("#show_scan_file").html('<object data="'+HTTP_PATH+'/'+data+'" type="application/pdf" width="100%" height="600px"><p>It appears you dont have a PDF plugin for this browser.No biggie... you can <a href="'+HTTP_PATH+'/'+data+'">click here to download the PDF file.</a></p></object>');
            }
        });
    }

    function  remove_scan_file(scan_id){
		
        if (confirm("कृपया सुनिश्चित करें की आप इसे हटाना चाहते है| ")) {
            $( ".my_scan_file_"+scan_id ).remove();
            var scan_files_id = $("#scan_files_id").val();
           
            if (scan_files_id.indexOf(scan_id) >= 0){
                scan_files_id = scan_files_id.replace(scan_id, "");
				
				var arr = scan_files_id.split(',');
				console.log(arr.length);
				
				if(arr.length == ''){
					$("#scan_files_id").val('');
				}else{
					$("#scan_files_id").val(scan_files_id);
				}                
            }
        }
    }
</script>
<!---- open pdf file ---->
<div class="modal fade" id="modal-scan_file" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">


                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row" align="center" style="height:250px;">
                                <div class="col-xs-12">
                                    <div id="show_scan_file"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">बंद करें</button>

                </div>
            </div>
        </form>
    </div>
</div>
<!--- End PDF File --->
