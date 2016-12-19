<!DOCTYPE html>
<meta charset="utf-8">
<title>Web Speech API Demo</title>
<style>
  * {
    font-family: Verdana, Arial, sans-serif;
  }
  a:link {
    color:#000;
    text-decoration: none;
  }
  a:visited {
    color:#000;
  }
  a:hover {
    color:#33F;
  }
  .button {
    background: -webkit-linear-gradient(top,#008dfd 0,#0370ea 100%);
    border: 1px solid #076bd2;
    border-radius: 3px;
    color: #fff;
    display: none;
    font-size: 13px;
    font-weight: bold;
    line-height: 1.3;
    padding: 8px 25px;
    text-align: center;
    text-shadow: 1px 1px 1px #076bd2;
    letter-spacing: normal;
  }
  .center {
    padding: 10px;
    text-align: center;
  }
  .final {
    color: black;
    padding-right: 3px; 
  }
  .interim {
    color: gray;
  }
  .info_1 {
    font-size: 14px;
    text-align: center;
    color: #777;
    display: none;
  }
  .right {
    float: right;
  }
  .left {
    float: left;
  }
  .sidebyside {
    display: inline-block;
    width: 45%;
    min-height: 40px;
    text-align: left;
    vertical-align: top;
  }
  #headline {
    font-size: 40px;
    font-weight: 300;
  }
  #info {
    font-size: 20px;
    text-align: center;
    color: #777;
    visibility: hidden;
  }
  #results {
    font-size: 14px;
    font-weight: bold;
    border: 1px solid #ddd;
    padding: 15px;
    text-align: left;
    min-height: 150px;
  }
  #start_button {
    border: 0;
    background-color:transparent;
    padding: 0;
  }
</style>
 <?php if($this->uri->segment(2)=='voic_input'){?>
 <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo $title; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
 <?php } ?>	
<div id="info">
  <p id="info_start">माइक्रोफ़ोन आइकन पर क्लिक करें और फिर बोलें। <br/>(Click on the microphone icon and begin speaking.)</p>
  <p id="info_speak_now">अब बोलें (Speak now.)</p>
  <p id="info_no_speech">
    कंप्यूटर में स्पीच का पता नहीं चला था। आप अपने माइक्रोफोन सेटिंग्स को समायोजित करने की आवश्यकता हो सकती है।
    <br/>/>No speech was detected. You may need to adjust your
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
      microphone settings</a>.</p>
  <p id="info_no_microphone" style="display:none">
    No microphone was found. Ensure that a microphone is installed and that
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
    microphone settings</a> are configured correctly.</p>
  <p id="info_allow">Click the "Allow" button above to enable your microphone.</p>
  <p id="info_denied">Permission to use microphone was denied.</p>
  <p id="info_blocked">Permission to use microphone is blocked. To change,
    go to chrome://settings/contentExceptions#media-stream</p>
  <p id="info_upgrade">Web Speech API is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
</div>
<div class="right">
  <button id="start_button" onclick="startButton(event)">
    <img id="start_img" src="<?php echo base_url();?>themes/site/images/mic.gif" alt="Start"></button>
</div>
<div id="results">
  <!--<span id="final_span" class="final"></span>-->
  <lable>आपके द्वारा बोला गया कंटेंट</lable>  
  <textarea id="final_span" class="final" <?php if($this->uri->segment(2)=='voic_input'){?> style="margin:0px;width:1131px;height:379px;" <?php }else { ?>style="margin: 0px; width: 509px; height: 350px;" <?php } ?> ></textarea>
  <br/>
  <lable>आपके द्वारा बोला जा रहा कंटेंट: </lable><br/>
  <span id="interim_span" class="interim"></span>
  <p>
</div>
<div class="center">
  <div class="left">
  <?php if($this->uri->segment(2)=='voic_input'){ /*Its use for draft/voic_input*/?>
	<br/>
	<?php } ?>
    <button id="copy_button" class="btn btn-primary" onclick="copyButton()">कॉपी और पेस्ट</button> &nbsp;
    <div id="copy_info" class="info_1">
      Press Control-C to copy text.<br>(Command-C on Mac.)
    </div>
  </div>  
  <div id="div_language" class="right">
    <select id="select_language" onchange="updateCountry()"></select>
    &nbsp;&nbsp;
    <select id="select_dialect"></select>
  </div>
</div>
 <?php if($this->uri->segment(2)=='voic_input'){?>
	<div class="box-footer">		
		<button type="button" id="btn_clear" class="btn btn-danger"><i class="fa fa-times"></i>  डाटा क्लियर करे</button>
	</div>
</section>
 <?php } ?>
<script>
var img_path = '<?php echo base_url();?>themes/site/images/';
var langs =
[['हिंदी में बोलें',['hi-IN','भारत']],['English',['en-US', 'United States']],];

for (var i = 0; i < langs.length; i++) {
  select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 0;
updateCountry();
select_dialect.selectedIndex = 0;
showInfo('info_start');

function updateCountry() {
  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
    select_dialect.remove(i);
  }
  var list = langs[select_language.selectedIndex];
  for (var i = 1; i < list.length; i++) {
    select_dialect.options.add(new Option(list[i][1], list[i][0]));
  }
 /* //select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';*/
}

var create_email = false;
var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;
if (!('webkitSpeechRecognition' in window)) {
  upgrade();
} else {
  start_button.style.display = 'inline-block';
  var recognition = new webkitSpeechRecognition();
  recognition.continuous = true;
  recognition.interimResults = true;

  recognition.onstart = function() {
    recognizing = true;
    showInfo('info_speak_now');
    start_img.src = img_path+'mic-animate.gif';
  };

  recognition.onerror = function(event) {
    if (event.error == 'no-speech') {
      start_img.src = img_path+'mic.gif';
      showInfo('info_no_speech');
      ignore_onend = true;
    }
    if (event.error == 'audio-capture') {
      start_img.src = img_path+'mic.gif';
      showInfo('info_no_microphone');
      ignore_onend = true;
    }
    if (event.error == 'not-allowed') {
      if (event.timeStamp - start_timestamp < 100) {
        showInfo('info_blocked');
      } else {
        showInfo('info_denied');
      }
      ignore_onend = true;
    }
  };

  recognition.onend = function() {
    recognizing = false;
    if (ignore_onend) {
      return;
    }
    start_img.src = img_path+'mic.gif';
    if (!final_transcript) {
      showInfo('info_start');
      return;
    }
    showInfo('');
    if (window.getSelection) {
      window.getSelection().removeAllRanges();
      var range = document.createRange();
      range.selectNode(document.getElementById('final_span'));
      window.getSelection().addRange(range);
    }
    if (create_email) {
      create_email = false;
      createEmail();
    }
  };

  recognition.onresult = function(event) {
    var interim_transcript = '';
    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript += event.results[i][0].transcript;
      } else {
        interim_transcript += event.results[i][0].transcript;
      }
    }
    final_transcript = capitalize(final_transcript);
 /*   //final_span.innerHTML = linebreak(final_transcript);*/
    final_span.value = linebreak(final_transcript);
    interim_span.innerHTML = linebreak(interim_transcript);
    if (final_transcript || interim_transcript) {
      showButtons('inline-block');
    }
  };
}

function upgrade() {
  start_button.style.visibility = 'hidden';
  showInfo('info_upgrade');
}

var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}

var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}

function createEmail() {
  var n = final_transcript.indexOf('\n');
  if (n < 0 || n >= 80) {
    n = 40 + final_transcript.substring(40).indexOf(' ');
  }
  var subject = encodeURI(final_transcript.substring(0, n));
  var body = encodeURI(final_transcript.substring(n + 1));
  window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}

function copyButton() {
  if (recognizing) {
    recognizing = false;
    recognition.stop();
  }
  copy_button.style.display = 'none';
  copy_info.style.display = 'inline-block';
  showInfo('');
}

function emailButton() {
  if (recognizing) {
    create_email = true;
    recognizing = false;
    recognition.stop();
  } else {
    createEmail();
  }
 /* //email_button.style.display = 'none';
  //email_info.style.display = 'inline-block';*/
  showInfo('');
}

function startButton(event) {
  if (recognizing) {
    recognition.stop();
    return;
  }
/*  //final_transcript = '';*/
  recognition.lang = select_dialect.value;
  recognition.start();
  ignore_onend = false;
  /*Code updated by bij*/
  if(final_span.value!=''){
  }else{
  final_span.innerHTML = '';
  }
  /*End code updated by bij*/
  /*//final_span.innerHTML = '';*/
  interim_span.innerHTML = '';
  start_img.src = img_path+'mic-slash.gif';
  showInfo('info_allow');
  showButtons('none');
  start_timestamp = event.timeStamp;
}

function showInfo(s) {
  if (s) {
    for (var child = info.firstChild; child; child = child.nextSibling) {
      if (child.style) {
        child.style.display = child.id == s ? 'inline' : 'none';
      }
    }
    info.style.visibility = 'visible';
  } else {
    info.style.visibility = 'hidden';
  }
}

var current_style;
function showButtons(style) {
  if (style == current_style) {
    return;
  }
  current_style = style;
  copy_button.style.display = style;
  /*//email_button.style.display = style;*/
  copy_info.style.display = 'none';
  /*//email_info.style.display = 'none';*/
}

 <?php if($this->uri->segment(2)=='voic_input'){?>
	 $(document).ready(function(){
		$("#for-print").animate({ scrollTop: $('#for-print').prop("scrollHeight")}, 1000);
        $("#edit").show();
        $("#typewithtext").hide();
        $('#voice_input').click(function(){
            $(".text_editor").hide();
            $("#typewithtext").show();
        });
        $('#btn_close').click(function(){
            $(".text_editor").show();
            $("#typewithtext").hide();
        });
        $('#btn_close_paste').click(function(){
            $(".text_editor").show();
            $("#typewithtext").hide();
			var final_old = CKEDITOR.instances.compose_textarea.getData();
            var final_new = $("#final_span").val();
            var final_data = final_old+' '+final_new;
            CKEDITOR.instances['compose_textarea'].setData(final_data);
			$("#final_span").val('');
        }); 
		$('#btn_clear').click(function(){ 
			var ret =  confirm('सुनिश्चित कर ले आप बोला हुआ डाटा डिलीट करना चाहते है'); 
			if(ret == true){
				$("#final_span").val('');
			} else{
				return false;
			}
        });
    });
<?php } ?>
</script>