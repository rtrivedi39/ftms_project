    <div class="col-xs-4"><?php 
foreach ($dataval as $key => $pay) {
	# code...
?><div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('pay_ca');?><span class="text-danger">*</span></label>
             <input  type="text" name="ca" id="ca" value="<?php echo $pay->salary_ca;  ?>" class="form-control">
<input  type="hidden" name="id" id="id" value="<?php echo $pay->salary_id;  ?>" class="form-control">
<input  type="hidden" name="no_updated" id="id" value="<?php echo $pay->no_updated + 1 ;  ?>" class="form-control">
</div>

 <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" value="1"><?php echo "बदले"; ?></button>
        </div>
  
<?php }?>
</div>
