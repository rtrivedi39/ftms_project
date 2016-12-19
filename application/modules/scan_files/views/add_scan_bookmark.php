<div id="modal-send_mark" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Scan id : <span id="scan_id"></span></h4>
            </div>
            <form method="post" id="bookmark_scan">
                <div class="modal-body">
                    <div class="box-body no-padding">
                        <input type="text" name="add_bookmark" class="form-control" placeholder="Add important page no. of selected pdf file. eg : pageno.=pagetitle,">
                        example : 1=noteshee,2=order,3=otherpage (pageno.=pagetitle)
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> <button type="submit"  class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function open_model2_addbookmark(scanid_id){
        var scanid_id = scanid_id;
        $('#bookmark_scan').attr('action','<?php echo base_url()?>scan_files/manage_sacn_bookmark/'+scanid_id);
        $("#scan_id").html(scanid_id);
        $('#modal-send_mark').modal('show');
    }
</script>
