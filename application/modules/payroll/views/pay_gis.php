<?php   $dd_key = $this->uri->segment(3);?><table align="center" cellpadding="0" cellspacing="0">
 
  <tr height="36">
    <td width="667" height="36" colspan="11" align="center"><h3 style="padding: 0px;margin: 0px;">  Government  of Madhya Pradesh</h3></td>
  </tr>
  <tr height="36">
    <td height="36" colspan="11" align="center"><h3 style="padding: 0px;margin: 0px;">  Law and Legislative Affairs Department</h3></td>
  </tr>
  <tr height="36">
    <td height="36" colspan="11" align="center" valign="middle"><h3 style="padding: 0px;margin: 0px;">  Vindhyachal Bhawan,    Bhopal</h3></td>
  </tr>
  <tr height="36">
    <td height="36" colspan="11" align="center"><h3 style="padding: 0px;margin: 0px;">  SCHEDULE OF G.I.S. 8011</h3></td>
  </tr>
  <tr height="36">
    <td height="36" colspan="11" align="center"><h3 style="padding: 0px;margin: 0px;">  See Rule    ------------ of the MP Government Employee</h3></td>
  </tr>
  <tr height="36">

    <td width="639" align="center"><h3 style="padding: 0px;margin: 0px;">  Certificate to be    attached to every Esst. Pay Bill</h3></td>
  </tr>
  <tr height="37">

    <td align="center"><h3 style="padding: 0px;margin: 0px;">  Month of&nbsp;&nbsp;    <?php echo $this->uri->segment(5);?> -2016</h3></td>
  </tr>
  <tr height="147">

    <td width="639" align="center"><h3 style="padding: 0px;margin: 0px;">  Certified that the deduction of  contibution to words MP 
      Government Insurance-cum-saving Scheme 2003 have been made at the prescriber Rate from all
       Government Servant whose pay is drown in this Pay bill.</h3></td>
  </tr>
  <tr height="64">

    <td width="639" align="center"><h3 style="padding: 0px;margin: 0px;">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The total deduction amount of <strong>GIS Rs.<?php echo  sumcolumn($dd_key ,$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?>/- Rs <?php echo convert_number_to_words(sumcolumn($dd_key ,$this->uri->segment("4"),$this->uri->segment("5"))['val']); ?></strong>&nbsp;  .&nbsp; This amount has    classified as following.</h3></td>
  </tr>
  <tr height="34">
    <td height="34"  align="center"><h3 style="padding: 0px;margin: 0px;">  Major Head 8011</h3></td>
  </tr>
  <tr height="39">
  
    <td  align="center"><h3 style="padding: 0px;margin: 0px;">  9996</h3></td>
  </tr>
  <tr height="66">

    <td width="639" align="center"><h3 style="padding: 0px;margin: 0px;">  Sub Head 106  Government Service (Group Insurance Cum-Saving-Scheme 2003)</h3></td>
  </tr>
</table>
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