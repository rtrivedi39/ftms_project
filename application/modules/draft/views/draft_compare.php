<link rel="stylesheet" href="<?php echo base_url(); ?>themes/compare/diffview.css">
<script src="<?php echo base_url(); ?>themes/compare/diffview.js"></script>
<script src="<?php echo base_url(); ?>themes/compare/difflib.js"></script>
<style type="text/css">

.top {
	text-align: center;
}
.textInput {
	display: block;
	width: 99%;
	float: left;
}
textarea {
	width:100%;
	height:300px;
}
label:hover {
	text-decoration: underline;
	cursor: pointer;
}
.spacer {
	margin-left: 10px;
}
.viewType {
	font-size: 16px;
	clear: both;
	text-align: center;
	padding: 1em;
}
#diffoutput {
	width: 100%;
}
</style>

<script type="text/javascript">

function diffUsingJS(viewType) {
	"use strict";
	var byId = function (id) { return document.getElementById(id); },
		base = difflib.stringAsLines(byId("baseText").value),
		newtxt = difflib.stringAsLines(byId("newText").value),
		sm = new difflib.SequenceMatcher(base, newtxt),
		opcodes = sm.get_opcodes(),
		diffoutputdiv = byId("diffoutput"),
		contextSize = byId("contextSize").value;

	diffoutputdiv.innerHTML = "";
	contextSize = contextSize || null;

	diffoutputdiv.appendChild(diffview.buildView({
		baseTextLines: base,
		newTextLines: newtxt,
		opcodes: opcodes,
		baseTextName: "Base Text",
		newTextName: "New Text",
		contextSize: contextSize,
		viewType: viewType
	}));
}

</script>
	
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary box-solid">				
					<div class="box-header">
						<i class="fa fa-th"></i><h3 class="box-title">विकल्प</h3>  
						<div class="box-tools pull-right">
							<button data-widget="collapse" class="btn bg-primary btn-sm"><i class="fa fa-minus"></i></button>
						</div>				
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft" class="btn btn-primary"></i> इनबॉक्स पर जाए</a>
							</div>
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft/send_draft" class="btn btn-primary"></i> भेजे गए पर जाए</a>
							</div>
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft/draft_viewer/<?php echo $this->uri->segment('4'); ?>" class="btn btn-warning"></i> ड्राफ्ट पर जाए</a>
							</div>
							<div class="col-xs-2">
							</div>
							<div class="col-xs-2">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row"  class="">  
           <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo getemployeeName($draft_data_log[0]->draft_log_creater, true) .' - '.get_employee_role($draft_data_log[0]->draft_log_creater); ?></h3>               
					<div class="box-tools pull-right">
						<a href="<?php echo base_url().'draft/draft/draft_viewer/'.$this->uri->segment('4').'/1'; ?>" class="btn btn-flat btn-danger"><i class="fa fa-compress"></i> View E-file</a>
					</div>
			    </div><!-- /.box-header -->
                <div class="box-body textInput">
					<textarea id="baseText"><?php echo strip_tags($draft_data_log[0]->draft_content); ?></textarea>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  
                </div><!-- /.box-footer -->
                
              </div><!-- /. box -->
            </div><!-- /.col --> 
			<div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo getemployeeName($draft_data_log[1]->draft_log_creater, true) .' - '.get_employee_role($draft_data_log[1]->draft_log_creater); ?></h3>               
                </div><!-- /.box-header -->
                <div class="box-body textInput spacer">
				<textarea id="newText"><?php echo strip_tags($draft_data_log[1]->draft_content); ?></textarea>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  
                </div><!-- /.box-footer -->
                
              </div><!-- /. box -->
            </div><!-- /.col -->
			 
			<div class="top">
				<input type="hidden" id="contextSize" value="" />
			</div>
			<div class="viewType">
				<button type="radio" name="_viewtype" id="sidebyside" class="btn btn-success" onclick="diffUsingJS(0);" />एक के बाद एक</button>
				&nbsp; &nbsp;
				<button type="radio" name="_viewtype" id="inline" class="btn btn-warning" onclick="diffUsingJS(1);" >लाइन से</button>
			</div>
			<div id="diffoutput"> </div>
			<!--<iframe src='https://docs.google.com/viewer?url=http://calibre-ebook.com/downloads/demos/demo.docx&embedded=true' frameborder='0'; width="100%"; height="300px;" ></iframe>
			<iframe src='https://docs.google.com/viewer?url=<?php echo base_url().'uploads/E-office_prt2.docx' ?>&embedded=true' frameborder='0'; width="100%"; height="300px;" ></iframe>-->
		</div><!-- /.row -->
		
   </section><!-- /.content -->

