<?php //pre($payslip);?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>

<table border="1" cellpadding="0" cellspacing="0" bordercolor="#666">
<?php foreach ($payslip as $key => $pay) {
  //pre($pay_bill);
	# code...?>

  <tr height="27">
    <td colspan="20" height="27"><div align="center"><strong>Govt of M.P Law and Legislative Affairs Department, Vindhyachal Bhawan, Bhopal</strong><br />
    </div></td>
  </tr>
  <tr height="28">
    <td height="28" colspan="20" align="center"><strong>Salary Slip for the  month of <?php echo $pay->pay_month .",". $pay->pay_year  ;?> </strong></td>
  </tr>
  <tr height="28">
    <td colspan="20" height="28">
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
          <th width="33%" align="center" style="border-right: solid 2px #666;">Name of employee :<?php echo $pay->emp_full_name?> </th>
          <th width="33%" align="center" style="border-right: solid 2px #666;">Post of employee :<?php echo getemployeeRole($pay->designation_id);?> </th>
          <th width="33%" align="center">Unique code of employee :<?php echo $_POST['uid'];?></th>
        </tr>
      </table>
    </td>
  </tr>

    <tr align="center" style="font-size: 14px;" height="60">
      <td height="60" colspan="20"><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr align="center">
          <td width="11%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Gross Amount</strong></td>
          <td width="10%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Net Amount</strong></td>
          <td width="13%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Computer Bill</strong></td>
          <td width="8%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Office Bill</strong></td>
          <td width="8%"bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Voucher No</strong></td>
          <td width="7%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Voucher  Date</strong></td>
          <td width="10%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>PAN Number</strong></td>
          <td width="12%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>SGS / DPF / PRAN  Number</strong></td>
          <td width="11%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Aadhaar card Number</strong></td>
          <td width="10%" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;"><strong>Govt Quarter Number</strong></td>
        </tr>
        <tr>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo  @$pay_bill[0]->pbill_gross_amount  ; ?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo  @$pay_bill[0]->pbill_net_amont  ; ?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo @$pay_bill[0]->pbill_computer_no; ?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo @$pay_bill[0]->pbill_office_no; ?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo @$pay_bill[0]->pbill_vocher_no; ?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo @$pay_bill[0]->pbill_vocher_date;?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo $pay->emp_pen_no?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo $pay->emp_gpf_dpf_code?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo $pay->emp_adhar_card_no?></td>
          <td align="center" bordercolor="#999999" bgcolor="#FFFFFF" style="border-right: solid 2px #666;border-top:solid 2px #666"><?php echo $pay->emp_house_no?></td>
        </tr>
      </table></td>
    </tr>
    <tr height="30">
      <td colspan="20" align="center"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
          <td colspan="10" align="center"><span class="style1">Details of pay</span></td>
          <td colspan="17" align="center"><span class="style1">Deduction Amount</span></td>
        </tr>
        <tr>
          <td align="center"><?php echo $this->lang->line('basic_pay'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_gradepay'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_special'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_da'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_others')  ?></td>
          <td align="center"><?php echo $this->lang->line('pay_sa')  ?></td>
          <td align="center"><?php echo $this->lang->line('pay_ma'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_sp')  ?></td>
          <td align="center"><?php echo $this->lang->line('pay_ca')  ?></td>
          <td align="center"><?php echo $this->lang->line('pay_sum'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_gpf'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_gpf_adv'); ?></td>
          <td width="6%" align="center"><?php echo $this->lang->line('pay_dpf')  ?></td>
          <td width="6%" align="center"><?php echo $this->lang->line('pay_dpf_adv')  ?></td>
          <td width="6%" align="center"><?php echo $this->lang->line('pay_gis'); ?></td>
          <td width="2%" align="center"><?php echo $this->lang->line('pay_define'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_home_loan'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_house_rent'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_car_loan'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_fule_charge'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_grain_adv'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_festival_adv'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_professional_tax')  ?></td>
          <td align="center"><?php echo $this->lang->line('pay_income_tax'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_other_adv'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_total_cut'); ?></td>
          <td align="center"><?php echo $this->lang->line('pay_amount'); ?></td>
        </tr>
        <tr>
          <th width="2%" align="center"><?php echo $pay->pay_basic;  ?></th>
          <th width="3%" align="center"><?php echo  $pay->pay_grp;  ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_special;   ?></th>
          <th width="5%" align="center"><?php  echo  $pay->pay_da;  ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_others ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_sa;  ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_madical; ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_sp; ?></th>
          <th width="5%" align="center"><?php echo $pay->pay_ca ?></th>
          <th width="0%" align="center"><?php echo $pay->pay_total_sum; ?></th>
          <th width="7%" align="center"><?php echo $pay->pay_gpf; ?></th>
          <th width="2%" align="center"><?php echo  $pay->pay_gpf_adv; ?></th>
          <th width="6%" align="center"><?php echo   $pay->pay_dpf ?></th>
          <th width="6%" align="center"><?php echo   $pay->pay_dpf_adv ?></th>
          <th width="6%" align="center"><?php echo   $pay->pay_gias ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_defined_contribution ?></th>
          <th width="3%" align="center"><?php echo $pay->pay_house_loan ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_house_rent ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_car_loan ?></th>
          <th width="6%" align="center"><?php echo $pay->pay_fuel_charge; ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_grain_adv ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_festival_adv; ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_professional_tax; ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_income_tax ?></th>
          <th width="2%" align="center"><?php echo $pay->pay_other_adv ?></th>
          <th width="4%" align="center"><?php echo $pay->pay_total_cut; ?></th>
          <th width="4%" align="center"><?php echo $pay->pay_total; ?></th>
        </tr>
      </table>        </td>
    </tr>
  
	<?php }?> 
</table>
  <input  type="button" onclick="window.print();" style="background-color: #052B02;border: solid 2px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" name="Submit" class="no-print"  value="print" /> <input style="background-color: #052B02;border: solid 2px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" class="no-print"  type="button" onclick="window.history.back();" name="Submit" value="Go Back" >

  <style type="text/css" media="print">
  
  @page { size: landscape; }

  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}

</style>