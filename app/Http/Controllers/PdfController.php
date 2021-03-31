<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function graphs()
    {
        return view('graph');
    }

    // function to generate PDF
    public function graphPdf()
    {   
        $options = array(
            'orientation' => 'landscape', 
            'enable-javascript' => true, 
            'javascript-delay' => 1000, 
            'no-stop-slow-scripts' => true, 
            'no-background' => false, 
            'lowquality' => false,
            'page-height' => 600,
            'page-width'  => 1000,
            'encoding' => 'utf-8',
            'images' => true,
            'cookie' => array(),
            'dpi' => 300,
            'image-dpi' => 300,
            'enable-external-links' => true,
            'enable-internal-links' => true
        );
        $pdf = PDF::loadView('graph');

        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);

        foreach($options as $key => $value){
            $pdf->setOption($key ,$value);
        }
        return $pdf->download('和解書.pdf');
    }
}

