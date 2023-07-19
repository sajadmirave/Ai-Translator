<?php

namespace App\Http\Controllers;

use App\Models\PdfPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\FlareClient\Http\Exceptions\InvalidData;

use function Psy\debug;
use function Symfony\Component\String\b;

class ConvertFileController extends Controller
{
    public function  convert_tiff(Request $request)
    {
        // premission
        shell_exec("chmod 777 public");
        shell_exec("chmod 777 public/data");
        shell_exec("chmod 777 public/tiff");
        shell_exec("chmod 777 public/pdf");

        // get language convertor
        $language = $request->input("language");
        // dd($language);

        $pdf = $request->file("pdf");
        $pdfName = rand() . $pdf->getClientOriginalName();
        $pdf->move(public_path("pdf"), $pdfName); //store pdf to public/pdf

        $pdfFile = "public/pdf/$pdfName";

        // converted file name
        $tiff_name = str_replace("pdf", "tiff", $pdfName);

        // pdf page number
        $pdf_page_number_command = "pdfinfo $pdfFile | grep 'Pages:' | awk '{print $2}'";
        $pageNumber = shell_exec($pdf_page_number_command);

        $imageFile = "public/tiff";
        $tiff_command = "gs -q -dNOPAUSE -r600x600  -sDEVICE=tiffgray -sOutputFile=$imageFile/'$tiff_name'%ld.tiff  $pdfFile -c quit";
        shell_exec($tiff_command);

        // convert to txt
        for ($i = 1; $i <= intval($pageNumber); $i++) {
            // check language
            switch ($language) {
                case "english-to-persion":
                    $txt_command = "tesseract public/tiff/$tiff_name$i.tiff  public/data/$tiff_name$i -l eng";
                    shell_exec($txt_command);
                    break;
                case "persion-to-english":
                    $txt_command = "tesseract public/tiff/$tiff_name$i.tiff  public/data/$tiff_name$i -l fas";
                    shell_exec($txt_command);
                    break;
                case "french-to-persion":
                    $txt_command = "tesseract public/tiff/$tiff_name$i.tiff  public/data/$tiff_name$i -l fra";
                    shell_exec($txt_command);
                    break;
            }
        }

        // & ---------------------------------------------------------------
        // & -----------------------translate-----------------------
        // & ---------------------------------------------------------------
        // ! missing upload pdf... 

        // initialize an empty array to store the translated output for each page

        // loop through each page number
        // foreach ($pageNumbers as $pageNumber) {
        // $pageNumber = 1;
        // $tiff_name = "fre";
        // $language = "persion-to-english";
        // $language = "english-to-persion";
        // $language = "french-to-persion";

        // check language convertor
        switch ($language) {
            case "persion-to-english":
                $from = "fa";
                $to = "en";
                break;
            case "english-to-persion":
                $from = "en";
                $to = "fa";
                break;
            case "french-to-persion":
                $from = "french";
                $to = "fa";
                break;
        }

        for ($i = 1; $i <= $pageNumber; $i++) {
            // read the input file and split it into lines
            $file = fopen("public/data/$tiff_name$i.txt", "r");
            $input = fread($file, filesize("public/data/$tiff_name$i.txt"));
            fclose($file);
            $lines = preg_split('/[\r\n]+/', $input);


            // translate each line separately
            $translatedLines = [];
            foreach ($lines as $line) {
                // split line into words
                switch ($language) {
                    case "persion-to-english":
                        $words = explode(" ", $line);
                        break;
                    default:
                        // french to english || english to persion
                        $words = str_word_count($line, 1);
                        break;
                }

                // get word meanings and priorities from database
                $wordDb = DB::table('words')->whereIn($from, $words)->get();

                // create translation array
                $translation = [];
                foreach ($words as $word) {
                    foreach ($wordDb as $row) {
                        if ($row->$from == $word) {
                            $translation[] = [
                                'word' => $word,
                                'en' => $row->en,
                                'fa' => $row->fa,
                                'priority' => $row->priority,
                            ];
                            break;
                        }
                    }
                }

                // sort translation array by priority
                usort($translation, function ($a, $b) {
                    return $a['priority'] - $b['priority'];
                });

                // create sentence from translation array
                // convert to language
                $sentence = "";
                foreach ($translation as $word) {
                    $sentence .= $word[$to] . " ";
                }


                // add newline character to end of sentence
                $sentence .= "<br>";

                $translatedLines[] = $sentence;
            }

            // join translated lines into a single string
            $translatedString = implode("", $translatedLines);

            // add the translated output for this page to the array
            $translatedPages["page$i"] = $translatedString;
        }


        // pass the translated output for all pages to the Blade view
        return view("translate", ['data' => $translatedPages]);
    }
}
