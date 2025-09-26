<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $arr = array("PHP", "HTML", "CSS", "JS");
        foreach($arr as $value){
            echo "$value";
        }
        $arr2 = array("PHP" => "PHP", "HTML" => "HTML", "CSS" => "CSS", "JS" => "JS");
        foreach($arr2 as $key => $value){
            echo "$key = $value <br>";
        }
    ?>
</body>
</html>