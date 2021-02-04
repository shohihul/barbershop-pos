<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Invoice #' . $pelanggan['id_kunjungan'] . '');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<h1><img src="public/image/barber.png" style="width: 30px; margin-right:50px;">Invoice Karisma Barber Shop</h1> <br/>
<p>Jl. Sumatra No.21-A, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</p> <br/>
  <p style="font-size: 15px;"><span style="font-size: 15px; font-weight: bold;">Invoice Number : </span>' . $pelanggan['id_kunjungan'] . '</p>
  <p style="font-size: 15px;"><span style="font-size: 15px; font-weight: bold;">Customer : </span>' . $pelanggan['nama_pelanggan'] . '</p>
  <p style="font-size: 15px;"><span style="font-size: 15px; font-weight: bold;">Barber : </span>' . $pelanggan['nama_barber'] . '</p>
  <p style="font-size: 15px;"><span style="font-size: 15px; font-weight: bold;">Tanggal : </span>' .  $pelanggan['check_out'] . '</p><br/>
  <h3>Tagihan</h3>
  <table style="border: 1px solid black;">
    <tr>
      <th style="text-align: center; border: 1px solid black;">Layanan</th>
      <th style="text-align: center; border: 1px solid black;">Deskripsi</th>
      <th style="text-align: center; border: 1px solid black;">Harga</th>
    </tr>';

foreach ($services as $s) {
  $jasa = $this->pelayanan->getJasaByID($s['id_jasa']);
  $html .= '
              <tr>
                <td style="text-align: center; border: 1px solid black;">' . $jasa['jasa'] . '</td>
                <td style="border: 1px solid black;">' . $jasa['deskripsi'] . '</td>
                <td style="text-align: center; border: 1px solid black;">' . $jasa['harga'] . '</td>
              </tr>
          ';
}

$html .= '<tr>
            <td colspan="2" style="text-align: center; border: 1px solid black;">Total Harga</td>
            <td style="text-align: center; border: 1px solid black;">' . $pelanggan['tagihan'] . '</td>
            </tr>
            <tr>
            <td colspan="2" style="text-align: center; border: 1px solid black;">Bayar</td>
            <td style="text-align: center; border: 1px solid black;">' . $pelanggan['bayar'] . '</td>
            </tr>
            <tr>
            <td colspan="2" style="text-align: center; border: 1px solid black; background-color: #d4d3d2">Kembalian</td>
            <td style="text-align: center; border: 1px solid black; background-color: #d4d3d2">' . ($pelanggan['bayar'] - $pelanggan['tagihan']) . '</td>
            </tr>

            <br/>

            <h4 style="text-align: right;">Jember, ' . date("d-m-Y", time()) . '</h4> <br/>
            <h4 style="text-align: right;">Karisma Barbershop</h4>
            <p> *Dibuat otomatis, tidak memerlukan tanda tangan </p>
          
          </table>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Invoice' . $pelanggan['id_kunjungan'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
