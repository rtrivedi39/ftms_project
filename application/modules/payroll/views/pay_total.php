<style>  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


}
</style>

<table width="100%" border="1" align="center" bordercolor="#000000"  >
<thead>   <tr>
      <th width='15%'>&nbsp;</th>
                                    <th width='25%'><?php   $dd_key = $this->uri->segment(3); echo $this->lang->line('emp_unique_code')  ?></th>
                                   <th width='25%'><?php  
                                     if($this->uri->segment(4) == 1 ){ echo " अधिकारी नाम"; }elseif($this->uri->segment(4) == 4){echo "  कर्मचारी नाम ";}else{echo "  अधिकारी / कर्मचारी नाम "; } ?></th>
                                   
                                     
                                
                          <th width='25%'><?php echo  "नगद  राशी"; ?></th>
                        
                                       
                                </tr>
  </thead>                  <?php $k =0;$total =0; $tt = 0;foreach ($pay_salary as $key => $pay) { 


                                  if($dd_key == "pay_gpf"){$dd =$pay->pay_gpf; }
                                    elseif($dd_key == "pay_dpf"){$dd =$pay->pay_dpf; }
                                       elseif($dd_key == "pay_gias"){$dd =$pay->pay_gias ;}
                                         elseif($dd_key == "pay_defined_contribution"){$dd =$pay->pay_defined_contribution; }
                                           elseif($dd_key == "pay_house_loan"){$dd =$pay->pay_house_loan; }
                                             elseif($dd_key == "pay_car_loan"){$dd =$pay->pay_car_loan ;} 
                                              elseif($dd_key == "pay_house_rent"){$dd =$pay->pay_house_rent ;}
                                                elseif($dd_key == "pay_fuel_charge"){$dd =$pay->pay_fuel_charge; }
                                                  elseif($dd_key == "pay_festival_adv"){$dd =$pay->pay_festival_adv ;}
                                                    elseif($dd_key == "pay_grain_adv"){$dd =$pay->pay_grain_adv; }
                                          elseif($dd_key == "pay_professional_tax"){$dd =$pay->pay_professional_tax; }
                                                  elseif($dd_key == "pay_income_tax"){$dd =$pay->pay_income_tax; }
												               elseif($dd_key == "pay_total"){$dd =$pay->pay_total; }
                                                                        if($dd != 0){         $k++;    ?> 
                                                          <tr id="<?php echo $pay->pay_id; ?>" class="ck">
                               
                           

                                  <td ><?php echo $k;?></td> 
                                         <td width='25%'><?php echo get_tr_unicode($pay->pay_emp_unique_id);    ?></td>
                                 <td ><?php echo get_employee_gender(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id) ." ". emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                
                               
                                    <td width='25%'> <?php echo $dd;$total =$total + $dd; ?></td>    
      

                              
                              

                                  
                                </tr>
                         
  <?php } } ?>
      <tr style="background-color: #8BC34A; font-size: 16px;font-weight: bold;    color: #000;">

                                  
                                <th width="10%"></th> 
                                    <th width="10%"></th> 
                                  
                                     <th width="10%">Total </th>
                                  
                                    
 <th width="10%"><?php echo  $total; ?></th>
                           
    </tr><tr>

                                  
                              
                                              
                                    <th colspan="16"align="center"><h3><center>
<?php 
$number = $total;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo ucfirst($result . "Rupees  " . $points) ;
?>
</center></h3></th> 
                              
                                </tr>


</table> 
                                     
                                     
                                </tr>
                    

</table> <?php  function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'Nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'Ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}?>
<script type="text/javascript">

function chckboxval()
{ var allVals = [];

  $('.ck :checked').each(function() {
       allVals.push($(this).val());
     });
    console.log(allVals);alert(allVals);
        $(".checkvalgpf").val(allVals);
}function toggle(source) {
   var allVals = [];
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;


  } 

$('.ck :checked').each(function() {
       allVals.push($(this).val());
     });


         $(".checkvalgpf").val(allVals);

}
</script>