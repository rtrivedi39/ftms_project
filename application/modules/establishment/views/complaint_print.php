<html >
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
    </head>
    <body>	
	<div style="margin:0% auto; width:70%;">
		<table>
			<?php $contain = '';
			if(isset($get_complaint)) {
				$get_complaint = $get_complaint[0];
				$contain .= '<tr><td>'.$get_complaint['complaint_subject'].'</td></tr>';
				$contain .= '<tr><td>------00-----</td></tr>';				
				$contain .= '<tr><td></td></tr>';				
				$contain .= '<tr><td><p style="intent:10px;">'.$get_complaint['complaint_containts'].'<p></td></tr>';
			}
			echo $contain;
			?>
		</table>
		</div>
    </body>
</html>



