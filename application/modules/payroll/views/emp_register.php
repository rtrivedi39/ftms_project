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
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
  
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!-- small box -->
            <div class="box box-warning">
                <div class="box-header">
                  <!--  <h3>यह आपकी पर्सनल जानकारी है अगर इसमे किसी प्रकार की त्रुटी दिखाई दे तो हमें अवश्य सूचित करे|</h3> -->
                </div>
           <div class="container"><h2><?php echo $title;?></h2>
  
<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
   <form action="<?php echo base_url(); ?>payroll/showrigtser" method="<?php echo base_url(); ?>payroll/showdetails" >
        <div class="box-body">
     
                    <div class="col-md-6">
                        <!-- general form elements -->
   
              <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_unique_code'); ?><span class="text-danger">*</span></label>
                <input type="text" name="uid" id="emp_unique_code" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="" class="form-control">
                <?php echo form_error('category_title_hin');?>
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन साल"; ?><span class="text-danger">*</span></label>
            <select name="pay_year" name="pay_year" class="form-control">
                                <option value=""><?php echo "साल "; ?></option>
                                <?php for ($my=2015; $my<=date("Y")+1; $my++) {$lastyear = $my-1;
   
     ?>
                                    <option value="<?php echo $lastyear."-".$my ?>"  ><?php echo $lastyear."-".$my; ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
              </div>

              <div id="div1"></div>
                    </div><!-- col 6 -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
        </form>
        
      </div><!-- /.box -->
    </div><!-- col 12-->
    </div><!-- /.row -->
 
    </div>
</section><!-- /.content -->
