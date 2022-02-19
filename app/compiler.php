<?php

    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    $input = $_POST['input'];

    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    $inputFile = fopen("input.txt", "w");
    fwrite($inputFile, $input);
    fclose($inputFile);

    if($language == "c"){
        $outputExe = $random . ".exe";
        shell_exec("gcc $filePath -o $outputExe");    
        $output = shell_exec("$outputExe < input.txt 2>&1");
        echo nl2br($output);
    }
    else if($language == "cpp"){
        $outputExe = $random . ".exe";
        $error = shell_exec("g++ $filePath -o $outputExe  2>&1");   
        echo $error;
        $output = shell_exec("$outputExe < input.txt 2>&1");
        echo nl2br($output);
    }
    else if($language == "php"){
        $output = shell_exec("php.exe $filePath < input.txt 2>&1");
        echo nl2br($output);
    }
    else if($language  == "py"){
        $output = shell_exec("python.exe $filePath < input.txt 2>&1");
        echo nl2br($output);
    }
    else if($language == "js"){
        $output = shell_exec("node $filePath < input.txt 2>&1");
        echo nl2br($output);
    }
?>
