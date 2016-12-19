<html>
<head>
    <title>_</title>
    <link href="<?php echo base_url(); ?>themes/notesheet_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="width:750px; margin: auto;" id="p1" class="OnePage">
    <div align="center">
        <u><h3>मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग</h3></u></div>
    <form method="post" name="myForm" action="<?php echo base_url()?>admin_notesheet_master/notesheet_generate/manage_generate_notesheet" onsubmit="return validateForm()">
        <table align="center" style="text-align: justify">
            <tr><td>
                    क्रमांक <?php echo  @$this->input->post('generate1') ? @$this->input->post('num') : '<input type="text" name="num">'; ?>/<?php echo date("Y"); ?>/21-क(या0),  	<div style="float: right">भोपाल, दिनांक  <?php echo  @$this->input->post('generate1') ? @$this->input->post('date1') : '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" />'; ?></div>
                </td></tr>
            <tr><td>
                    प्रेषक:-
                </td></tr>
            <tr><td>
                    <div style="margin-left: 75px">
                        अमिताभ मिश्र,<br/>
                        अतिरिक्त सचिव, विधि
                    </div>
            <tr><td>
                    प्रति,
                </td></tr>
            <tr><td>
                    <div style="margin-left: 75px">
                        विधि परामर्शी/प्रमुख सचिव, <br/>
                        दिल्ली राज्य,<br/>
                        विधि और विधायी कार्य विभाग,<br/>
                        मंत्रालय, दिल्ली
                    </div>
                </td></tr>
            <tr><td>
                    विषय:-<span style="margin-left: 25px">अपील क्रमांक निरंक मेसर्स किम्बर्ले र्क्लक लिवर प्रा0लि0 विरूद्ध दिल्ली राज्य      एवं अन्य में प्रतिरक्षण हेतु।</span>
                </td></tr>
            <tr><td align="center">
                    <div align="center">::0::</div>
                </td></tr>
            <tr><td>
                    <span style="margin-left:75px "></span>उपरोक्त प्रकरण माननीय उच्च न्यायालय दिल्ली में लंबित है, जिसमें म0प्र0 राज्य के मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग, को पक्षकार बनाया गया है। अत: निवेदन है कि प्रकरण में म0प्र0 शासन की ओर से माननीय उच्च न्यायालय दिल्ली में पैरवी करने के लिए महाधिवक्ता/ शासकीय अधिवक्ता को प्राधिकृत करने का कष्ट करें। नियुक्त किये गये शासकीय अधिवक्ता को फीस का भुगतान आपके राज्य में प्रचलित नियमों के अनुसार म0प्र0 शासन के विधि और विधायी कार्य विभाग, द्वारा किया जायेगा। कृपया अधिवक्ता नियुक्ति की सूचना संबंधित विभाग एवं विधि विभाग को भेजे।
                </td></tr>
            <tr><td>
                    <div class="float_right">
                        (<?php echo  @$this->input->post('generate1') ? @$this->input->post('s_name') : '<input type="text" name="s_name">'; ?>)<br/>
                        अतिरिक्त सचिव,<br/>
                        मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग
                    </div>
                </td></tr>
            <tr><td>
                    पृ0 क्रमांक <?php echo  @$this->input->post('generate1') ? @$this->input->post('num2') : '<input type="text" name="num2">'; ?>/<?php echo date("Y"); ?>/21-क(या0),                	<div style="float: right"> भोपाल, दिनांक     <?php echo  @$this->input->post('generate1') ? @$this->input->post('date2') : '<input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy" />'; ?></div>
                </td> </tr>
            <tr><td>
                    प्रतिलिपि:-
                </td></tr>
            <tr><td>
                    <span style="margin-left:75px "></span>प्रमुख सचिव, म0प्र0 शासन,‍ <?php echo  @$this->input->post('generate1') ? @$this->input->post('dept') : '<input type="text" name="dept">'; ?>, मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0<?php echo  @$this->input->post('generate1') ? @$this->input->post('uo_no') : '<input type="text" name="uo_no">'; ?>, दिनांक <?php echo  @$this->input->post('generate1') ? @$this->input->post('date2') : '<input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy" />'; ?>   के संदर्भ में उनकी विभागीय नस्ती के साथ भेजकर निवेदन है कि प्रकरण के प्रभारी अधिकारी को निर्देश दे कि वह तत्काल विधि परामर्शी/ प्रमुख सचिव, दिल्ली राज्य, विधि और विधायी कार्य विभाग, मंत्रालय, दिल्ली राज्य से संपर्क स्थापित कर आवश्यक कार्यवाही करना सुनिश्चित करें।
            </tr></td>
            <tr><td><div class="float_right">
                        (<?php echo  @$this->input->post('generate1') ? @$this->input->post('s_name1') : '<input type="text" name="s_name1">'; ?>)<br/>
                        अतिरिक्त सचिव,<br/>
                        मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग
                    </div>
                </td></tr>
        </table>
        <input type="submit" class="no-print btn btn_color sticky" value="Generate" name="generate1"/>

    </form>
    <?php if ($this->input->post('generate1')){     ?>
        <button onclick="window.print()" class="no-print btn bg-maroon sticky">Print Content</button>
    <?php } ?>
</div>
</body>
</html>
<?php $this->load->view('footer_js.php'); ?>

