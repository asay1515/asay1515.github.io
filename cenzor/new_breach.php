<?php

$banned = false;

$ip = $_SERVER['REMOTE_ADDR'];

$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));

$query = mysqli_query($db, "SELECT num FROM breaches WHERE ip='".$ip."'") or die(mysqli_error($db));
$num = mysqli_fetch_row($query);
$num = $num[0];
$query = mysqli_query($db, "SELECT ip FROM breaches WHERE num='".$num."'") or die(mysqli_error($db));
$exist = mysqli_fetch_row($query);
$exist = $exist[0];

if (!($exist==0)) {
        $query = mysqli_query($db, "UPDATE breaches SET num='" . ($num + 1) . "' WHERE ip='" . $ip . "'") or die(mysqli_error($db));
} else {
    $date = date('d/m/Y H:i:s');
    $query = mysqli_query($db, "INSERT INTO breaches(ip) VALUES ('".$ip."')") or die(mysqli_error($db));
    $query = mysqli_query($db, "UPDATE breaches SET num='1' WHERE ip='".$ip."'") or die(mysqli_error($db));
    $query = mysqli_query($db, "UPDATE breaches SET date='".$date."' WHERE ip='".$ip."'") or die(mysqli_error($db));
}

if (($num+1) == 5){
    $banned = true;
}

echo $banned;

?>