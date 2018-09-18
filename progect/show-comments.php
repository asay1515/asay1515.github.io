
<?php
$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));
$query = mysqli_query($db, "SELECT * FROM comments") or die(mysqli_error($db));
$comments = array();
while ($comment = mysqli_fetch_row($query)){
    $comments[] = $comment;
}
foreach (array_reverse($comments) as $comment): ?>
    <div class="comment" id="<?=$comment[0]?>">
    <div class="name"><?=$comment[1]?></div><hr>
    <div class="comment-text">&nbsp;&nbsp;&nbsp;&nbsp;<?=$comment[2]?></div>
    <div class="date"><?=$comment[3]?></div>
    </div>
<?php endforeach?>
