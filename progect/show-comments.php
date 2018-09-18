
<?php

foreach (array_reverse($comments) as $comment): ?>
    <div class="comment" id="<?=$comment[0]?>">
    <div class="name"><?=$comment[1]?></div><hr>
    <div class="comment-text">&nbsp;&nbsp;&nbsp;&nbsp;<?=$comment[2]?></div>
    <div class="date"><?=$comment[3]?></div>
    </div>
<?php endforeach?>
