
<?php

$number = $_POST['number'];
$theme = $_POST['theme'];
/*$number = 7786;
$theme = "ssss";*/

 $token = '5722517899:AAHQlRphXL6M24ur9AOdmHh3M1H28D6W67E';

  $chat_id = '-1001882834783';

$arr = array(
  'Номер товара:' => $number,
  'Тема сообщения:' => $theme,

);

foreach($arr as $key => $value) {
    $txt .= " " . $key . " "  . $value . "\n";

};
$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}";
$urlFile = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}";

// Отправить сообщение
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,
    'https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    'chat_id='.$chat_id.'&text='.urlencode($txt));
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$result=curl_exec($ch);
curl_close($ch);


?>