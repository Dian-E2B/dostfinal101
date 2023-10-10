<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class PrintController extends Controller
{
    //
    public function index(Request $request)
    {
        $filePath = public_path("sample.pdf");
        $outputFilePath = public_path("sample_output.pdf");
        $this->fillPDFFile($filePath, $outputFilePath);
        return response()->file($outputFilePath);
    }


    public function fillPDFFile($file, $outputFilePath)

    {
        $fpdi = new FPDI;
        $count = $fpdi->setSourceFile($file);
        for ($i = 1; $i <= $count; $i++) {

            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));

            $fpdi->useTemplate($template);
            $fpdi->SetFont("Arial", "", 9);

            $fpdi->SetTextColor(0,0,0);

            $left = 133;
            $top = 42;

            $text = now();

            $formattedDate = $text->format('F j, Y');

            $fpdi->Text($left, $top, $formattedDate);


            // Load the image
            $imagePath = public_path('media/new-sign.jpg');


            $editedImagePath = public_path('media/edited-image.png');
            $fpdi->Image($editedImagePath, 40, 90);


        }

        return $fpdi->Output($outputFilePath, 'F');

    }
}
