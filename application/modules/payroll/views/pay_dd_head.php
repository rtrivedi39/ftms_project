   <table  class="display" cellspacing="0" width="100%">

<tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr>
   <?php  $dd_key = $this->uri->segment(3); if($dd_key == "pay_gpf" || $dd_key == "pay_dpf"){ ?>

   
       <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">मुख्य शीष 29-2052-सचिवालय सामान्य सेवायें </h3></td>
    
    </tr>

     <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">9057 विधि और विधायी कार्य विभाग</h3></td>
    
    </tr>
         <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">090 सचिवालय विभाग</h3></td>
    
    </tr>
	<?php if($dd_key == "pay_dpf"){ ?>
          <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">    माह <?php echo $this->uri->segment(5);?> 2016 सामान्य  विभागीय  निधि अंशदान कटोत्री पत्रक ।</h3></td>
    
    </tr>
	<?php }else{ ?>
	     <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">    माह <?php echo $this->uri->segment(5);?> 2016 सामान्य भविष्य निधि अंशदान कटोत्री पत्रक ।</h3></td>
    
    </tr>
	<?php }?>
   <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">    माह <?php echo $this->uri->segment(5);?>  2016 देयक क्रमाक ---------- दिनांक  ----------</h3></td>
    
    </tr>
   <tr style="text-align:center;padding: 0px;">
    <td colspan="32"><h3 style="padding: 0px;margin: 0px;">    माह <?php echo $this->uri->segment(5);?>  2016 कम्प्यूटर  देयक क्रमाक ---------- दिनांक  ----------
	</h3></td>
    
    </tr>

    <?php }if($dd_key == "pay_income_tax") {?>
    <tr height="32" style="text-align:center">
    <td height="32" colspan="4" width="497"><h3 style="padding: 0px;margin: 0px;">    Law and Legislative Affairs Department Bhoal</h3></td>
   
  </tr>
  <tr height="32" style="text-align:center">
    <td height="32" colspan="3"> <h3 style="padding: 0px;margin: 0px;">    Government of Madhya Pradesh </h3></td>
  
  </tr>
  <tr height="32" style="text-align:center">
    <td height="32" colspan="3"><h3 style="padding: 0px;margin: 0px;">     Vindhiyachal Bhawan Bhopal</h3></td>
   
  </tr>
    <tr height="32" style="text-align:center">
    <td colspan="6" height="32"><h3 style="padding: 0px;margin: 0px;">    Sub: Deduction of Incom Tax pay for the month of <?php echo $this->uri->segment(5);?> - 2016</h3></td>
  </tr>
  <tr height="32" style="text-align:center">
    <td height="34" colspan="3"><h3 style="padding: 0px;margin: 0px;">    TAN    No. BPL    L00340 E</h3></td>
   
  </tr>
  <tr height="32" style="text-align:center">
    <td height="34" colspan="3"><h3 style="padding: 0px;margin: 0px;">    हेड-0021</h3></td>
    
  </tr>
  <tr height="32" style="text-align:center">
    <?php $last_month = Date('F', strtotime($this->uri->segment(5) . " next month"));?>
    <td colspan="6" height="27"><h3 style="padding: 0px;margin: 0px;">    Month of  <?php echo $this->uri->segment(5); ?> - 2016 Paid&nbsp;    <?php echo $last_month; ?>- 2016 </h3></td>
  </tr>
    <?php }?>
    <?php if($dd_key == "pay_professional_tax"){?>
     <tr height="32" style="text-align:center">
    <td height="56"><h1><h1>माह <?php echo $this->uri->segment(5);?> 2016 के वेतन से वृत्तिकर कटोती  की सूची</h1></td>
  </tr>
  <tr height="32" style="text-align:center">
    <td height="42">हेड-0028</td>
  </tr>
    <?php } ?>
       <?php if($dd_key == "pay_house_rent"){?>    

       <tr height="39">
    <td height="39" align="center"><h1>माह <?php echo $this->uri->segment(5);?> 2016 के वेतन से काटी गई शासकीय आवास गृह कटोती  की सूची </h1>
</td>
  </tr>
  <tr height="35">
    <td height="35" align="center">हेड- 2016</td>
  </tr>
       <?php } ?>

       <?php if($dd_key == "pay_grain_adv"){?>  
   <tr height="39">

    <td height="39" align="center"><h1>विषयः- माह  <?php echo $this->uri->segment(5);?>  2016 के वेतन से अनाज अग्रिम /ब्याज कटोती की सूची ।</h1>
</td>
  </tr>

       <?php }?>
       <?php if($dd_key == "pay_festival_adv"){?>  
   <tr height="39">
    <td height="39" align="center"><h1>विषयः- माह  <?php echo $this->uri->segment(5);?>  2016  के वेतन से  त्यौहार अग्रिम कटोती की सूची </h1>
  </tr>
 
       <?php }?>

              <?php if($dd_key == "pay_fuel_charge"){?>  
   <tr height="39">
    <td height="39" align="center"><h1>विषयः- माह  <?php echo $this->uri->segment(5);?>  2016  के वेतन देयक से काटे गये ईधन कटोती की सूची ।</h1>
  </tr>
 
       <?php }?>


              <?php if($dd_key == "pay_house_loan"){?>  
   <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> Office of the Legal Remembrancer to Govt. of MP Bhopal</h3></td>
  </tr>
  <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> Schedul    for recoveries of House Bulding&nbsp;    Advance </h3></td>
  </tr>
  <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> for the month of <?php echo $this->uri->segment(5);?>  2016</h3> </td>
  </tr>
 
       <?php }?>
	              <?php if($dd_key == "pay_total"){  if($this->uri->segment(4)  == 2 || $this->uri->segment(4)  == 8 ){?>  
   <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः- पारिभाषित अंशदायी शासकीय सेवकों का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
 
 
       <?php }elseif($this->uri->segment(4)  == 3 ){?>
	    <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः- प्रथम,द्वितीय एवं तृतीय श्रेणी शासकीय सेवकों का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
       <?php }elseif($this->uri->segment(4)  == 4 ){?>
	    <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः-  चतुर्थ श्रेणी शासकीय सेवकों का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
        <?php }elseif($this->uri->segment(4)  == 1 ){?>
	    <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः-  न्यायिक सेवा अधिकारियों का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
      <?php }elseif($this->uri->segment(4)  == 5 ){?>
	    <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः- तृतीय श्रेणी शासकीय सेवकों का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>    <?php }elseif( $this->uri->segment(4)  == 7  ){?>
	    <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः-  चतुर्थ श्रेणी शासकीय सेवक का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
	    <?php }elseif( $this->uri->segment(4)  == 6  ){?>
	  <tr height="34">
    <td height="34" align="center"><h3 style="padding: 0px;margin: 0px;"> विषयः- पारिभाषित अंशदायी शासकीय सेवक का मंहगाई भत्ता ऐरियर्स राशि बैंक में जमा करने हेतु सूची ।
</h3></td>
  </tr>
	   <?php }}?>

</table>