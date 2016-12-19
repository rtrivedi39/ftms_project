<!-- Content Header (Page header) -->
 
 <style type="text/css" media="print">
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


}
</style>

<meta charset="UTF-8">
<section class="content-header">
    <h1>
        <?php //echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php //echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header no-print">
                    <h1 ><?php echo " वेतन एरियर्स  डी. ए . पत्रक " ;?>
                  </h1>
                </div>
                <div class="box-body">
                    <h3 style="text-align: right;"></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
<div class="box-tools pull-right no-print">
                       <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
                        <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>

                    </div>
               <div class="box-body">

                        
                        <div class="fix_table-container">
					
              <div id="divname">     <?php $cate_id  = $this->uri->segment(3);  ?>      
                  <?php $k=0; $uid="";  foreach($getemp as $emp){ $uid .= $emp->pay_emp_unique_id.",";    }
                	$stringe = rtrim($uid, ", \t\n"); 
             
  $uni = explode(",", $stringe);
  $uni = array_unique($uni);

    foreach($uni as $val){ ?>
<table cellspacing="0" cellpadding="0">


 
<tr height="67">
      <td height="67"> विषय : </td>
    <td>&nbsp;</td>
    <td colspan="15" width="926"> </td>
  </tr>
 
  <tr height="28">
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="15"><h3><?php  echo get_employee_gender(getemppenno($val)['emp_id'])." " .getemppenno($val)['emp_full_name_hi']." (". get_employee_designation_id(getemppenno($val)['emp_id']).")";?><h3></td>
  </tr>
   
  <tr height="30">
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="15"><h3>वेतन एरियर्स गणना पत्रक <h3></td>
  </tr>
  <tr height="121">
    <td height="121">अवधि</td>

    <td colspan="5">वेतन भुगतान किया जाना था</td>
    <td colspan="4">वेतन भुगतान किया गया</td>
    <td>&nbsp;</td>
    <td width="57">वेतन अन्ेतर</td>
    <td width="70">ग्रेड-पे अन्तर</td>
    <td width="70">मंहगाई भत्ता</td>
    <td width="58"> गृह भाडा भत्ता</td>
    <td width="79">भुगतान की जाने वाली कुल अन्तर की राशि</td>
  </tr>
  
  <tr height="50">
    <td height="50">&nbsp;</td>

    <td width="64">वेतन बेड</td>
    <td width="64">ग्रेडपे	</td>
    <td width="64">मंहगाई भत्ता	</td>
    <td width="54">गुह भाडा भत्ता</td>
    <td>योग</td>
    <td width="64">वेतन बेड</td>
    <td width="64">ग्रेडपे	</td>
    <td width="64">मंहगाई भत्ता	</td>
    <td width="54">गुह भाडा भत्ता</td>
    <td>योग</td>
    <td width="64">वेतन बेड</td>
    <td width="64">ग्रेडपे	</td>
    <td width="64">मंहगाई भत्ता	</td>
    <td width="54">गुह भाडा भत्ता</td>
    <td>&nbsp;</td>
  </tr>
    <?php $k=0;  $totaldiff=0;   foreach($getemp as $emp){ if($val == $emp->pay_emp_unique_id ){ $k++;?>
  <tr height="55">
    <td height="55" width="75"><?php echo $emp->pay_month_given." ".$emp->pay_year_given; ?></td>
  
    <td><?php echo $emp->pay_basic ?></td>
    <td><?php echo $emp->pay_grp ?></td>
    <td><?php echo $emp->pay_da ?></td>
    <td><?php echo $emp->pay_hra ?></td>
    <td><?php echo $emp->pay_total ?></td>
  <td><?php echo $emp->pay_basicold ?></td>
    <td><?php echo $emp->pay_grpold ?></td>
    <td><?php echo $emp->pay_daold ?></td>
    <td><?php echo $emp->pay_hraold ?></td>
    <td><?php echo $emp->pay_total_diff ?></td>
   <td><?php echo $emp->pay_basic_diff ?></td>
    <td><?php echo $emp->pay_grp_diff ?></td>
    <td><?php echo $emp->pay_da_diff ?></td>
    <td><?php echo $emp->pay_hra_diff ?></td>
    <td><?php echo $emp->pay_diff;  $totaldiff = $totaldiff + $emp->pay_diff; ?></td>
  </tr>
    <?php }} ?>
  
  <tr height="27">
    <td height="27">&nbsp;</td>
    <td colspan="16">Rs. <?php echo convert_number_to_words($totaldiff);?>.</td>
  </tr>
</table>
    <?php }?>
<div id="bottom_anchor"></div>
</div>
  



    </div>   
    </div>
</div>
  </div>
    </div>
  </section>
  						  </form>    

  <?php function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
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
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
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


function paychnage(id)
{

$(".show"+id).show();
$(".hide"+id).hide();
}
function checkda(id)
{
 basic = $("#basic"+id).val(); 
    <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
pay_gpf = $("#pay_grp"+id).val();
 <?php }else{ ?>
pay_gpf = 0;
<?php } ?>
    pay_danew = $("#danew").val(); 
	   //   alert(pay_danew);

  var dd = parseInt(basic) + parseInt(pay_gpf);
var  dane = parseInt(dd) * parseInt(pay_danew);
var  dane1 = parseInt(dd) * parseInt(119);

  var dd1 = Math.round(parseInt(dane)/100);
 var dd2 = Math.round(parseInt(dane1)/100);
  pay_didi = $("#da"+id).val(dd1);
    pay_didi = $("#daold"+id).val(dd2);

  

}
function onsubmited(id){

   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
     
        basic = $("#basic"+id).val();
		pay_grp = $("#pay_grp"+id).val();
  		pay_didi = $("#da"+id).val();
 		 gpf = $("#gpf"+id).val();
  		caseamount = $("#caseamount"+id).val();
		no_updated  = $("#no_updateds"+id).val();
	
		$.post("<?php echo base_url()?>payroll/updatepapaer/<?php echo  $this->uri->segment(3); ?>",
		{ "basic": basic,
		"pay_grp": pay_grp,
		"pay_didi": pay_didi,
		"gpf": gpf,
		"pay_id":id,
		"no_updated":no_updated,
		"caseamount":caseamount
		},
		function(a){location.reload();});

    } else {
        txt = "You pressed Cancel!";
    }
  
}
  </script>
    