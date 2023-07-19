<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TranslateController extends Controller
{
    //translate
    public function translate(Request $request)
    {
        // // read file
        // $file = fopen(public_path("info.txt"), 'r');
        // $user = fread($file, filesize(public_path("info.txt")));
        // fclose($file);

        // // PHP_EOL is new line
        // // $words = explode('/ (vs) /', $user);

        // // $user = preg_replace();

        // $words = preg_split('/[ ' . PHP_EOL . '.]/', $user);
        // // $words = preg_split('/[ ]/', $user);

        // // dd($words);
        // // find words
        // $wordDb = DB::table('words')->whereIn('en', $words)->get();

        // $translate = [];
        // foreach ($words as $j)
        //     foreach ($wordDb as $i) {
        //         if ($j == $i->en) {
        //             array_push($translate, $i->fa);
        //             break;
        //         }
        //     }

        // // create sentence
        // $sentence = "";
        // foreach ($translate as $word) {
        //     $sentence .= $word . " ";
        // }

        // return view("translate", compact('sentence'));
        // get input string from user
        //  $input = $request->input('input');

        // // !---------------------- 
        // $file = fopen(public_path("info.txt"), 'r');
        // $input = fread($file, filesize(public_path("info.txt")));
        // fclose($file);

        // // split input string into words
        // $words = str_word_count($input, 1);
        // dd($words);

        // // get word meanings and priorities from database
        // $wordDb = DB::table('words')->whereIn('en', $words)->get();

        // // create translation array
        // $translation = [];
        // foreach ($words as $word) {
        //     foreach ($wordDb as $row) {
        //         if ($row->en == $word) {
        //             $translation[] = [
        //                 'word' => $word,
        //                 'fa' => $row->fa,
        //                 'priority' => $row->priority,
        //             ];
        //             break;
        //         }
        //     }
        // }

        // // sort translation array by priority
        // usort($translation, function ($a, $b) {
        //     return $a['priority'] - $b['priority'];
        // });

        // // create sentence from translation array
        // $sentence = "";
        // foreach ($translation as $word) {
        //     $sentence .= $word['fa'] . " ";
        // }

        // return view("translate", compact('sentence'));

        // get input string from user

        // !------------------
        $file = fopen(public_path("./data/info.txt"), 'r');
        $input = fread($file, filesize(public_path("./data/info.txt")));
        fclose($file);

        // split input string into lines
        $lines = preg_split('/[\r\n]+/', $input);


        // translate each line separately
        $translatedLines = [];
        foreach ($lines as $line) {
            // split line into words
            $words = str_word_count($line, 1);

            // get word meanings and priorities from database
            $wordDb = DB::table('words')->whereIn('en', $words)->get();

            // create translation array
            $translation = [];
            foreach ($words as $word) {
                foreach ($wordDb as $row) {
                    if ($row->en == $word) {
                        $translation[] = [
                            'word' => $word,
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
            $sentence = "";
            foreach ($translation as $word) {
                $sentence .= $word['fa'] . " ";
            }

            // add newline character to end of sentence
            $sentence .= "<br />";
            // dd($sentence);

            $translatedLines[] = $sentence;
        }

        // join translated lines into a single string
        $translatedString = implode("", $translatedLines);

        // return view("translate", compact('translatedString'));
        return $translatedString;
    }
}
