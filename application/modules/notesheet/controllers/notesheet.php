<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Notesheet extends MX_Controller{
      function __construct() { 
		parent::__construct();
	  } 
     function index()
	 {
			require_once('tcpdf/tcpdf.php'); 
			
			
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			// Add a page
			$pdf->AddPage();
			$html = "<h1>Test Page</h1>";
			$pdf->writeHTML($html, true, false, true, false, '');
			$filename = 'example_001.pdf';
			
			
			 $filelocation = "D:\\xampp\\htdocx\\ftams\\uploads\\pdf";//windows
            

			$fileNL = $filelocation."\\".$filename;//Windows
           

			$pdf->Output($fileNL,'F');
			 $pdf->Output($filename,'D'); // you cannot add file location here
			
			
			
      }
}
?>