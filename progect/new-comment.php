<?php
header("Content-Type: application/json", true);
$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));
$date = date('d/m/Y H:i:s');
$query = mysqli_query($db, "INSERT INTO comments (date) VALUES ('".$date."')") or die(mysqli_error($db));
$query = mysqli_query($db, "UPDATE comments SET name='".$_POST['name']."' WHERE date='".$date."'") or die(mysqli_error($db));
$query = mysqli_query($db, "UPDATE comments SET comment='".$_POST['comment']."' WHERE date='".$date."'") or die(mysqli_error($db));
$query = mysqli_query($db, "SELECT * FROM comments WHERE date='".$date."'") or die(mysqli_error($db));
$comments = array();
while ($comment = mysqli_fetch_assoc($query)){
    $comments[] = $comment;
}
echo json_encode($comments);
