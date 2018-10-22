<?php
$json='{1:"х**",2:"охуевший", 3:"охреневший"}';
$arr=json_decode($json,true);//преобразуем данные из json в массив
for ($i=0;i<2;i++)
if (<?php echo htmlspecialchars($_POST['name-input'])==$arr[i])//прогнать имя на наличие бана
//вывести ошибку
<?php>
