<?php
    ini_set('max_execution_time', 0);
    error_reporting(E_ERROR);
    ini_set("display_errors", 1);
    set_time_limit(0);
?>
<html>
<head>
    <title>Convert image to base64 string</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:900,800,700,600,500,400,300&amp;subset=latin,cyrillic-ext,cyrillic,latin-ext" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <p id="back-top" style="display: none">
        <a title="Scroll up" href="#top"></a>
    </p>
    <h1>Convert image to base64 string</h1>
<?php

    $objects1 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('files/html/src'), RecursiveIteratorIterator::SELF_FIRST);
    foreach($objects1 as $name1 => $object){
        if(is_dir($name1)==1){
            $dest_name1 = str_replace('src', 'out', $name1);
            mkdir($dest_name1);
        } else if(is_dir($name1)!=1){
            $dest_name1 = str_replace('src', 'out', $name1);
            $data1 = file_get_contents($name1);

            $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('files/images/src'), RecursiveIteratorIterator::SELF_FIRST);
            foreach($objects as $name => $object){
                if(is_dir($name)!=1){
                    $type = pathinfo($name, PATHINFO_EXTENSION);
                    $data = file_get_contents($name);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $data1 = str_replace(basename($name), $base64, $data1);
                    echo '<br />'. basename($name);
                }
            }
            echo '<br />============================';
            echo '<br />'. $dest_name1;
            file_put_contents($dest_name1, $data1);
        }
    }
?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/arrowup.min.js"></script>
</body>
</html>