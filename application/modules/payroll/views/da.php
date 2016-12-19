
<?php 
foreach ($dataval as $key => $pay) {
	# code...
?>
          <input  type="text" name="da" id="da" value="<?php echo $pay->salary_da;  ?>" class="form-control">
<input  type="hidden" name="id" id="id" value="<?php echo $pay->salary_id;  ?>" class="form-control">
<input  type="hidden" name="no_updated" id="id" value="<?php echo $pay->no_updated + 1 ;  ?>" class="form-control">

          <?php } ?>
