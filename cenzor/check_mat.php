<?php

$db = mysqli_connect('localhost', 'mihopol', 'mihpol', 'Censor-bot') or die(mysqli_error($db));

    for ($i = 0; $i < mb_strlen($_POST['name'], 'UTF-8'); $i++){
        if (mb_substr($_POST['name'], $i, 1, 'UTF-8')=='.'){
            if (preg_match("/\pL{2}/u", mb_substr($_POST['name'], $i+1, 2, 'UTF-8'))) {
                if ((($i+3)==mb_strlen($_POST['name'], 'UTF-8')) || (($i+4)==mb_strlen($_POST['name'], 'UTF-8'))) {
                    echo "1";
                } elseif ((preg_match("/[^\pL]/u", mb_substr($_POST['name'], $i + 3, 2, 'UTF-8')))) {
                    echo "1";
                }
            }
        }
    }

    for ($i = 0; $i < mb_strlen($_POST['comment'], 'UTF-8'); $i++) {
        if (mb_substr($_POST['comment'], $i, 1, 'UTF-8') == '.') {
            if (preg_match("/\pL{2}/u", mb_substr($_POST['comment'], $i + 1, 2, 'UTF-8'))) {
                if ((($i + 3) == mb_strlen($_POST['comment'], 'UTF-8')) || (($i + 4) == mb_strlen($_POST['comment'], 'UTF-8'))) {
                    echo "1";
                } elseif ((preg_match("/[^\pL]/u", mb_substr($_POST['comment'], $i + 3, 2, 'UTF-8')))) {
                    echo "1";
                }
            }
        }
    }

    for ($i = 1; $i <= 7; $i++) {
        $query = mysqli_query($db, "SELECT word FROM censorwords WHERE id='".$i."'") or die(mysqli_error($db));
        $badword = mysqli_fetch_row($query);
        $badword = $badword[0];
        $word_start = 0;
        $space_found = true;
        $space_place = 0;
        while ($space_found) {
            $space_found = false;
            if ($space_place > 0) {
                $word_start = $space_place + 1;
                for ($j = $word_start; $j < mb_strlen($_POST['name'], 'UTF-8'); $j++) {
                    if (!((preg_match("/\pL+/u", mb_substr($_POST['name'], $j, 1, 'UTF-8'))))) {
                        $space_found = true;
                        $space_place = $j;
                        break;
                    } elseif ($j==(mb_strlen($_POST['name'], 'UTF-8')-1)) {
                        $space_place = mb_strlen($_POST['name'], 'UTF-8');
                    }
                }
            } else {
                for ($j = 0; $j < mb_strlen($_POST['name'], 'UTF-8'); $j++) {
                    if (!((preg_match("/\pL+/u", mb_substr($_POST['name'], $j, 1, 'UTF-8'))))) {
                        $space_found = true;
                        $space_place = $j;
                        break;
                    } elseif ($j==(mb_strlen($_POST['name'], 'UTF-8')-1)) {
                        $space_place = mb_strlen($_POST['name'], 'UTF-8');
                    }
                }
            }

            if (mb_strtolower(mb_substr($_POST['name'], $word_start, ($space_place - $word_start), 'UTF-8'), 'UTF-8') == $badword) {
                echo "2";
                break 2;
            }
        }
    }

    for ($i = 1; $i <= 21; $i++) {
        $query = mysqli_query($db, "SELECT stem FROM censorstems WHERE id='".$i."'") or die(mysqli_error($db));
        $badword = mysqli_fetch_row($query);
        $badword = $badword[0];
        $char_range = mb_strlen($_POST['name'], 'UTF-8')-mb_strlen($badword, 'UTF-8');

        for ($j = 0; $j <= $char_range; $j++){
            if((mb_strtolower(mb_substr($_POST['name'],$j,mb_strlen($badword, 'UTF-8'),'UTF-8'), 'UTF-8'))==$badword){
                echo "2";
                break 2;
            }
        }
    }

    for ($i = 1; $i <= 7; $i++) {
        $query = mysqli_query($db, "SELECT word FROM censorwords WHERE id='" . $i . "'") or die(mysqli_error($db));
        $badword = mysqli_fetch_row($query);
        $badword = $badword[0];
        $word_start = 0;
        $space_found = true;
        $space_place = 0;
        while ($space_found) {
            $space_found = false;
            if ($space_place > 0) {
                $word_start = $space_place + 1;
                for ($j = $word_start; $j < mb_strlen($_POST['comment'], 'UTF-8'); $j++) {
                    if (!((preg_match("/\pL+/u", mb_substr($_POST['comment'], $j, 1, 'UTF-8'))))) {
                        $space_found = true;
                        $space_place = $j;
                        break;
                    } elseif ($j==(mb_strlen($_POST['comment'], 'UTF-8')-1)) {
                        $space_place = mb_strlen($_POST['comment'], 'UTF-8');
                    }
                }
            } else {
                for ($j = 0; $j < mb_strlen($_POST['comment'], 'UTF-8'); $j++) {
                    if (!((preg_match("/\pL+/u", mb_substr($_POST['comment'], $j, 1, 'UTF-8'))))) {
                        $space_found = true;
                        $space_place = $j;
                        break;
                    } elseif ($j==(mb_strlen($_POST['comment'], 'UTF-8')-1)) {
                        $space_place = mb_strlen($_POST['comment'], 'UTF-8');
                    }
                }
            }

            if (mb_strtolower(mb_substr($_POST['comment'], $word_start, ($space_place - $word_start), 'UTF-8'), 'UTF-8') == $badword) {
                echo "2";
                break 2;
            }
        }
    }

    for ($i = 1; $i <= 21; $i++) {
        $query = mysqli_query($db, "SELECT stem FROM censorstems WHERE id='".$i."'") or die(mysqli_error($db));
        $badword = mysqli_fetch_row($query);
        $badword = $badword[0];
        $char_range = mb_strlen($_POST['comment'], 'UTF-8')-mb_strlen($badword, 'UTF-8');

        for ($j = 0; $j <= $char_range; $j++){
            if ((mb_strtolower(mb_substr($_POST['comment'],$j,mb_strlen($badword, 'UTF-8'),'UTF-8'), 'UTF-8'))==$badword) {
                echo "2";
                break 2;
            }
        }
    }
?>