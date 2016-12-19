<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php //echo $title_tab_header;     ?></h3>
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
                        <h3 class="box-title"><?php echo $title_tab; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                            <form action="<?php echo base_url();?>payroll/add_fixstion" method="post" >
                  
              <div class="form-group">
                <label for="email"><?php echo "फिक्सशन  नाम" ?></label>
                <input type="text" class="form-control" name="pf_name" id="pf_name">
              </div>
             
                          <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "फिक्सेशन सैलरी  हेड"; ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pf_cate_id" required class="form-control">
                                <option value=""><?php echo "फिक्सेशन सैलरी  हेड"; ?></option>
                                <?php foreach ($pay_cate as $key => $pcate) {
                                  # code...
                                
     
     ?>
                                    <option value="<?php echo $pcate->pay_cate_id ?>"  ><?php echo $pcate->pay_cate_name ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>

 <div class="form-group">
                <label for="email"><?php echo "फिक्सशन  विवरण  " ?></label>
               
                <textarea class="form-control" rows="3" placeholder="फिक्सशन  विवरण  ..."  name="pf_discription"></textarea>
              </div>
 <div class="form-group">
                <label for="email"><?php echo "फिक्सेशन अमाउंट टाइप " ?></label>
               <select name="pf_type" required class="form-control">
                                <option value=""><?php echo "फिक्सेशन अमाउंट टाइप "; ?></option>
                               <option value="0"  ><?php echo "पर्सेंटेज" ?></option>
                                <option value="1"  ><?php echo "फिक्स्ड" ?></option>
                            </select>  </div>

              </div>
<div class="form-group">
                <label for="email"><?php echo "पर्सेंटेज इंक्रेमनेंट  अमाउंट" ?></label>
                <input type="text" class="form-control" name="pf_parcentage_val" id="pf_parcentage_val">
              </div>

              <div class="form-group">
                <label for="email"><?php echo "पर्सेंटेज रेंज अमाउंट" ?></label>
                <input type="text" class="form-control" name="pf_range" id="pf_range">
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
