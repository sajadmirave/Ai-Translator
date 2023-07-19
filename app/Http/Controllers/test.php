<?php

// $output = [];
// $command = "node -v";
// exec($command,$output);

// foreach($output as $i){
//     echo $i;
// }
// $path = "/public/sample.pdf";
// $file = fopen($path,"r");
// echo fread($file,filesize($path));
// fclose($file);


// $x = "s";
// $y = "a";
// $all = "$x$y";
// echo $all;

// sprintf("x,
// ")

// $all_data = [];
// $path = "public/info.txt";
// $file = fopen($path, "r");
// $data = fread($file, filesize($path));

// for ($i = 1; $i <= 2; $i++) {
//     $file = fopen("public/info$i.txt", 'r');
//     $input = fread($file, filesize("public/info$i.txt"));
//     $allData = ["key" => $input];
//     fclose($file);
// }

// // $all_data = ["1" => $data];



// foreach ($all_data as $key) {
//     echo $key;
// }



// $allData = [];

// for ($i = 1; $i <= 2; $i++) {
//     $file = fopen("public/info$i.txt", 'r');
//     $input = fread($file, filesize("public/info$i.txt"));
//     $allData["page$i"] = $input;
//     fclose($file);


$x = "dadsadads.pdf";
$y = str_replace("pdf","tiff",$x);
echo $y;