<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "समयमान जोड़े"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "समयमान जोड़े"; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                  <?php foreach ($pay_salary as $key => $pay) {
                    # code...
                  ?>
                    <h1 ><?php echo get_employee_gender(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id) ." ". emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi." [ ".get_employee_role(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id) ." ] ";   ?></h1><?php } ?>
                </div>
                <div class="box-body">
                    <?php $this->load->view('payroll_header') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
            
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo "समयमान जोड़े" ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                         <div class="col-xs-6">
                            <form action="<?php echo base_url();?>payroll/addsamaymaan"   method="post" >
                  
              <div class="form-group">
                <label for="email"><?php echo "वेतन नियमन दिनाक"  ?></label>
                <input type="text" class="form-control date1" name="pay_emp_date" id="pay_emp_date">
                <input  type="hidden" name="pay_emp_samay_man" id="id" value="<?php if(isset($pay->pay_emp_samay_man)){ echo $pay->pay_emp_samay_man + 1; }else{echo 0; }  ?>" class="form-control">
    <input  type="hidden" name="pay_emp_unique_idpay_emp_unique_id" id="id" value="<?php echo $_GET['uid'] ;  ?>" class="form-control">

              </div>
			  
			  
			  
                 <div class="form-group">
                <label for="email"><?php echo "आदेश नंबर"  ?></label>
                <input type="text" class="form-control" name="pay_order_no" id="pay_order_no">
              </div>
                  <div class="form-group">
                <label for="email"><?php echo "आदेश कि कॉपी"  ?></label>
              <input id="uploadImage1" type="file" name="file_upload" onchange="PreviewImage(1);" style="float: left" >
                <span id="dis_file_size"></span>
              </div>
<div class="form-group" style="border: 1px solid gray;height: 600px;" id="scan_file_div">
    <!--  <object id="uploadPreview1" data="<?php echo base_url()?>/uploads/Viwer_example.pdf" width="100%" height="600px"></object>-->
</div>
                <div class="form-group">
                <label for="email"><?php echo "मूल वेतन"  ?></label>
                <input type="text" class="form-control" name="pay_basic_new" id="pay_basic_new">
              </div>
             
    <div class="form-group">
                <label for="email"><?php echo "ग्रेड वेतन"  ?></label>
                <input type="text" class="form-control" name="pay_grp_new" id="pay_grp_new">
              </div>
               <div class="form-group">
                <label for="email"><?php echo "रिमार्क"  ?></label>
                <textarea name="pay_remark" rows="3" class="form-control"></textarea>
              </div>
            


   </div>

              </div>

              <button type="submit" class="btn btn-default">Submit</button>
</form>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<script type="text/javascript">
    function PreviewImage(no) {
        var  file_size1 = document.getElementById("uploadImage"+no).files[0].size/ 1048576;
        //  document.getElementById("dis_file_size").innerHTML = "File size is "+file_size1;
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
            //  alert(scan_file_types);
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
                        // console.log(value);
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