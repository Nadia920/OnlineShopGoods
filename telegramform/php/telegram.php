<?php

// Токен
  const TOKEN = '5722517899:AAHQlRphXL6M24ur9AOdmHh3M1H28D6W67E';

  // ID чата
  const CHATID = '-691949630';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fileSendStatus = '';
  $textSendStatus = '';
  $msgs = [];
  console.log("1");
  // Проверяем не пусто ли поле
  if (!empty($_POST['number'])) {

    // Если не пустые, то валидируем эти поля и сохраняем и добавляем в тело сообщения. Минимально для теста так:
    $txt = "";

    // Номер
   if (isset($_POST['number']) && !empty($_POST['number'])) {
           $txt .= "Номер товара: " . strip_tags(trim(urlencode($_POST['number']))) . "%0A";
       }


    // Не забываем про тему сообщения
    if (isset($_POST['theme']) && !empty($_POST['theme'])) {
        $txt .= "Тема: " . strip_tags(urlencode($_POST['theme']));
    }

    $textSendStatus = @file_get_contents("https://api.telegram.org/bot{$TOKEN}/sendMessage?chat_id={$CHATID}&parse_mode=html&text={$txt}");

    if( isset(json_decode($textSendStatus)->{'ok'}) && json_decode($textSendStatus)->{'ok'} ) {

          $urlFile =  "https://api.telegram.org/bot" . TOKEN . "/sendMediaGroup";

          // Путь загрузки файлов
          //$path = $_SERVER['DOCUMENT_ROOT'] . '/telegramform/tmp/';

          // Загрузка файла и вывод сообщения
          /*$mediaData = [];
          $postContent = [
            'chat_id' => CHATID,
          ];

          /*for ($ct = 0; $ct < count($_FILES['files']['tmp_name']); $ct++) {
            if ($_FILES['files']['name'][$ct] && @copy($_FILES['files']['tmp_name'][$ct], $path . $_FILES['files']['name'][$ct])) {
              if ($_FILES['files']['size'][$ct] < $size && in_array($_FILES['files']['type'][$ct], $types)) {
                $filePath = $path . $_FILES['files']['name'][$ct];
                $postContent[$_FILES['files']['name'][$ct]] = new CURLFile(realpath($filePath));
                $mediaData[] = ['type' => 'document', 'media' => 'attach://'. $_FILES['files']['name'][$ct]];
              }
            }
          }

          $postContent['media'] = json_encode($mediaData);
*/
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
          curl_setopt($curl, CURLOPT_URL, $urlFile);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $postContent);
          $fileSendStatus = curl_exec($curl);
          curl_close($curl);
          /*$files = glob($path.'*');
          foreach($files as $file){
            if(is_file($file))
              unlink($file);
          }*/
      }
      echo json_encode('SUCCESS');
    } else {
      echo json_encode('ERROR');
      //
      // echo json_decode($textSendStatus);
    }
  } else {
    echo json_encode('NOTVALID');
  }
} else {
  header("Location: /");
}




