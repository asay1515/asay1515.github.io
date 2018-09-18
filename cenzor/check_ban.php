<?php
$ban = false;

$ip = $_SERVER['REMOTE_ADDR'];

$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));

$query = mysqli_query($db, "SELECT num FROM breaches WHERE ip='".$ip."'") or die(mysqli_error($db));
$num = mysqli_fetch_row($query);
$num = $num[0];

if ($num==5){
    $query = mysqli_query($db, "SELECT date FROM breaches WHERE ip='".$ip."'") or die(mysqli_error($db));
    $last_date = mysqli_fetch_row($query);
    $last_date = $last_date[0];
    $date = date('d/m/Y H:i:s');
    if (($date[0]>$last_date[0])||($date[1]>$last_date[1])||($date[3]>$last_date[3])||($date[4]>$last_date[4])||($date[6]>$last_date[6])||($date[7]>$last_date[7])||($date[8]>$last_date[8])||($date[9]>$last_date[9])||($date[11]>$last_date[11])||($date[12]>$last_date[12])){
        $query = mysqli_query($db, "UPDATE breaches SET num='0' WHERE ip='".$ip."'") or die(mysqli_error($db));
    } else {
        $ban = true;
    }
}

echo $ban;

?>