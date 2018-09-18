<?php
$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));

$query = mysqli_query($db, "SELECT LAST_INSERT_ID() FROM comments") or die(mysqli_error($db));
$last_id = mysqli_fetch_row($query);

echo $last_id[0];
?>