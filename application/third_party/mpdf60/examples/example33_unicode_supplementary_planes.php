<?php
ini_set("memory_limit","128M");
$html = '<table style="margin:0% auto;" cellspacing="1" cellpadding="0"><tbody><tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</u></b></td></tr><tr><td align="center"><u><h3>मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग</h3></u></td></tr><tr><td align="center"><div style="float:left;text-align:right;"> फा0क्र0 5/20/2016/20/21-(या0),  </div><div style="float:right;">भोपाल, दिनांक 17/03/2016</div></td></tr><tr><td align="left">प्रति, </td></tr><tr><td align="left"><span style="margin-left:8%">अतिरिक्त महाधिवक्ता</span>,</td></tr><tr><td align="left"><span style="margin-left:8%">मान0  उच्च न्यायालय</span>,</td></tr><tr><td align="left"><span style="margin-left:8%">जबलपुर, मध्यप्रदेश</span></td></tr><tr><td align="left">विषय:-<span style="margin-left:5%">test gh</span></td></tr><tr><td align="center">--------------</td></tr><tr><td>&nbsp;</td></tr><tr><td align="left">महोदय, </td></tr><tr><td align="left"><p><span style="margin-left:8%"></span>उपरोक्त विषय में उल्लेखित याचिका माननीय सर्वोच्च न्यायालय में प्रस्तुत की गई है। उक्त याचिका में म0प्र0 शासन को पक्षकार बनाया गया है। अत: म0प्र0 शासन की ओर से माननीय उच्चतम न्यायालय में पक्ष-समर्थन करने की कार्यवाही करने का कष्ट करें। </p> </td></tr><tr><td align="left"><p><span style="margin-left:8%"></span>माननीय उच्चतम न्यायालय में याचिका की प्रस्तुति एवं पक्ष- समर्थन हेतु प्रत्यावर्तन प्रस्तुत करने हेतु माननीय उच्चतम न्यायालय से प्राप्त सूचना- पत्र तथा याचिका की प्रति विभाग द्वारा बनाये गये प्रभारी अधिकारी के द्वारा आपको उपलब्ध कराई जायेगी, प्रकरण में की गई कार्यवाही की सूचना इस विभाग को प्रेषित करें।</p> </td></tr><tr><td align="left"><p><span style="margin-left:8%"></span>हस्ताक्षरयुक्त वकालतनामा संलग्न कर भेजा जा रहा है।</p></td></tr><tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr><tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(अमिताभ मिश्र)</div></td></tr><tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">अतिरिक्त सचिव</div></td></tr><tr><td align="right"><div style="width:50%; text-align:center;">मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग</div></td></tr><tr><td align="center"><div style="float:left;"> फा0क्र0 5/20/2016/20/21-(या0),  </div><div style="float:right;">भोपाल, दिनांक 17/03/2016</div></td></tr><tr><td align="left">प्रतिलिपि:-</td></tr><tr><td><p><span style="margin-left:8%"></span>सचिव, म0प्र0 शासन,‍  गृह विभाग,  भोपाल की ओर उनके यू0ओ0क्र0 45645, दिनांक   17/03/2016 के संदर्भ में उनकी विभागीय नस्ती के साथ भेजकर निवेदन है कि प्रकरण के प्रभारी अधिकारी को निर्देश दें कि वह तत्काल उपरोक्त अधिवक्ता से नई दिल्ली में संपर्क कर आवश्यक कार्यवाही करवाये । स्थायी अधिवक्ता को मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग द्वारा नियुक्ति की शर्तों एवं समय-समय पर किये गये आदेशों का  शुल्क, टाईपिंग, अनुवाद आदि का व्यय विधि विभाग के माध्यम से ही अधिवक्ता द्वारा देयक प्रस्तुत किये जाने पर देय होगा। प्रकरण में की गई कार्यवाही की सूचना इस विभाग को भी देवें। </p> </td></tr><tr><td>&nbsp;</td></tr><tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(अमिताभ मिश्र)</div></td></tr><tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">अतिरिक्त सचिव</div></td></tr><tr><td align="right"><div style="width:50%; text-align:center;">मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग</div></td></tr></tbody></table>';
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
include("../mpdf.php");
$mpdf=new mPDF(); 
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
?>