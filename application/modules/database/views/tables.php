<table id="advocate_table" class="table table-bordered table-striped" padding="10" style="border:1px solid #000">
	<thead>
	  <tr>
		<th>क्रमांक</th>
		<th>जिला</th>
	   	<th>तहसील</th>
	   	<th>नाम</th>
		<th> प्रथम<br>नियुक्ति दिनांक </th>
		<th> नवीनीकरण<br>दिनांक </th>
		<th> परिवीक्षा काल </th>
		<th> बार कांउसिल <br> पंजीयन क्रमांक </th>
		<th>जन्म तिथि</th>
		<th> मोबाईल  </th>
		<th> ईमेल </th>
		<th>पता </th>
	</tr>
	</thead>
	<tbody>
	  <?php $i=1; 
	  //pre($advocate_details);
		foreach ($advocate_details as $key => $users) { ?>
		<tr>
		<td><?php echo $i; ?></td>
			<td>
				<?php if(!empty($users['scm_district_id'])){ echo $users['district_name_hi'];}else { echo 'N/A'; }?>
			</td>
			<td>
			<?php if(!empty($users['scm_tahsil_id'])){ echo $users['tahsil_name_hi'];    }else { echo 'N/A'; }?>
			</td>
			<td><?php if($users['scm_name_hi']!=''){ echo $users['scm_name_hi']; }else{ echo $users['scm_name_hi']; }?>
			</td>
			
			<td><?php if(!empty($users['posting_date'])&& $users['posting_date']!='1970-01-01'&& $users['posting_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['posting_date']));}else{ echo 'N/A';} ?></td>
			<td><?php if(!empty($users['post_renew_date'])&& $users['post_renew_date']!='1970-01-01' && $users['post_renew_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['post_renew_date']));}else{ echo 'N/A';}?></td>
			<td><?php if($users['provision_pirod']){ echo $users['provision_pirod'];}else{ echo 'N/A';}?></td>
			
			
		
			<td><?php echo @$users['once_registration_number_council'] ?></td>
			<td><?php if( !empty($users['post_renew_date'])&& $users['scm_dob']!='1970-01-01'&& $users['scm_dob']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['scm_dob']));}else{ echo 'N/A';}?></td>
			<td><?php if(!empty($users['contact_no'])){  echo $users['contact_no']; }else { echo 'N/A';}?></td>
			<td><?php if(!empty($users['email_id'])){  echo $users['email_id']; }else { echo 'N/A';}?></td>
			<td><?php if(!empty($users['scm_address_hi'])){ echo $users['scm_address_hi']; }else { echo 'N/A';}?></td>
			
		</tr>
	  <?php $i++; } ?>
	</tbody>
</table>