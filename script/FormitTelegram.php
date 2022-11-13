<?php

$token = "5722517899:AAHQlRphXL6M24ur9AOdmHh3M1H28D6W67E";
$chat_id = "978926595";
echo "php";
$values = $hook->getValues();

#Получаем название формы
$formName = $modx->getOption('formName', $formit->config, 'form-'.$modx->resource->get('id'));

#Получаем ip адрес отправителя
$ip = $modx->getOption('REMOTE_ADDR', $_SERVER, '');

#Данные с формы
$number = $values['number'];


#Создаем массив
$arr = array(
"Номер товара" => $number,
"Название формы" => $formName,
"Айпи" => $ip);

/*Цикл по массиву (собираем сообщение) */
foreach($arr as $key => $value) { 
     $txt .= "<b>".$key."</b>: ".$value."%0A"; 
  }

#Отправляем сообщение
$fp=fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

#Возвращаем true
return true;