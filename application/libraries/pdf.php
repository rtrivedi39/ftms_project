<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  include_once APPPATH.'/third_party/tcpdf/tcpdf.php';
  
//require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}

 // Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Set font
		$this->SetFont('mangal', 'B', 12);
		// Title
		$this->Cell(0, 15, 'विधि और विधायी कार्य विभाग , भोपाल', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('mangal', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */