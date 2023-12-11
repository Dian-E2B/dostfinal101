<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\Text;



class WordController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'wordFile' => 'required|file|mimes:docx'
        ]);

        $file = $request->file('wordFile');
        // $filePath = $file->store('uploads');

        $phpWord = IOFactory::load($file->getRealPath());
        $sections = $phpWord->getSections();
        // dd($sections);
        // dd($phpWord); // Debug statement

        // Output the text content
        $thirdColumnContent = $this->getThirdColumnText($phpWord);
        dd($thirdColumnContent);
        foreach ($thirdColumnContent as $content) {
        }
        // return view('word.read', ['textContent' => $textContent]);
    }


    // WordController.php

    // WordController.php

    private function getThirdColumnText($phpWord)
    {
        $thirdColumnContent = [];

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                // Check if the element is a table
                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    foreach ($element->getRows() as $row) {
                        // Check if the row has at least 3 cells
                        if (count($row->getCells()) >= 3) {
                            // Access the 3rd cell directly and extract its text, handling hyperlinks
                            $thirdColumnText = $this->extractTextWithHyperlinks($row->getCells()[2]);

                            // Add the extracted text to the result array
                            $thirdColumnContent[] = $thirdColumnText;
                        }
                    }
                }
            }
        }

        // Use the result array as needed
        return $thirdColumnContent;
    }

    private function extractTextWithHyperlinks($cell)
    {
        $text = '';

        // Iterate through paragraphs in the cell
        foreach ($cell->getElements() as $paragraph) {
            if ($paragraph instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($paragraph->getElements() as $runElement) {
                    // Check if the element is text or a hyperlink
                    if ($runElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text .= $runElement->getText();
                    } elseif ($runElement instanceof \PhpOffice\PhpWord\Element\Link) {
                        // Extract the text from the hyperlink
                        $text .= $runElement->getText();
                    }
                }
            } elseif ($paragraph instanceof \PhpOffice\PhpWord\Element\Text) {
                // Handle text outside of TextRun
                $text .= $paragraph->getText();
            }
        }

        return $text;
    }
}
