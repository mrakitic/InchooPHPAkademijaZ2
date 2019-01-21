<!doctype html>
<html lang="en">
<head>
    <style>
        .naslov{text-align: center}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Brojevi</title>
</head>
<body>
<h1 class="naslov">Druga zadaća</h1>
<h2 class="naslov">Unesite brojeve odvojene zarezom</h2>
<form method="POST" class="w3-container">
    <label>Unesite brojeve:</label>
    <input type="text" name="brojevi">
    <br />
    <input type="submit" value="Predaj">

</form>

<?php

$brojevi = $_POST['brojevi'];
$primljeniNiz= explode(',',$brojevi);
foreach ($primljeniNiz as $item){
    $item = preg_replace('/\D/','',$item);
}


$primljeniNiz = array_map('intval', array_filter($primljeniNiz, function($value){
    return $value !== '';
}));
$nepraniBrojevi = [];


for($i = 0;$i <= count($primljeniNiz); $i++){
    if($primljeniNiz[$i] % 2 !==0){
        $nepraniBrojevi[] = $primljeniNiz[$i];
        continue;
    }
}

$ariSredina = array_sum($primljeniNiz) / count($primljeniNiz);
$primljeniNiz = array_values(array_diff($primljeniNiz, $nepraniBrojevi));
$primljeniNiz = array_unique($primljeniNiz);

echo "<hr />";
$najbliziBroj = null;

foreach($primljeniNiz as $key => $value){
    if($value >= $ariSredina && $value %2 == 0){
        $najbliziBroj = $value;
        break;
    }
}

$korjenovanjePlusJedan = intval(sqrt(max($primljeniNiz))) + 1;

echo "Aritmetička sredina navedenog niza je: " . $ariSredina;
echo "<br />";
echo "Najveci broj poslje aritmetičke sredine je: " . $najbliziBroj;
echo "<br />";
echo "Korjen najveceg broja +1 je: " . $korjenovanjePlusJedan;
echo "<br />";

echo "<table>";
$y = 1;
for($i = 0; $i < $korjenovanjePlusJedan; $i++){
    echo "<tr>";

        for($j = 0;$j < $korjenovanjePlusJedan; $j++){
            if(in_array($y,$primljeniNiz) && $y == $najbliziBroj){
                echo "<td><b>", $y ,"</b> </td>";
            }elseif(in_array($y,$primljeniNiz)){
                echo "<td>", $y, "</td>";
            }else{
                echo "<td>" , "</td>";
            }
            $y++;

        }
        echo "</tr>";
}
echo "</table>";


?>

</body>
</html>
