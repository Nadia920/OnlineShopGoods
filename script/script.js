$(document).ready(function () {
    $("#form").submit(function (e) { // Устанавливаем событие отправки для формы с id=form
        e.preventDefault();
         var form_data = $(this).serialize(); // Собираем все данные из формы
         $.ajax({
             type: "POST", // Метод отправки
             url: "FormitTelegram.php", // Путь до php файла отправителя
             data: form_data,
             success: function () {
                 // Код в этом блоке выполняется при успешной отправке сообщения
                 alert("Операция проведена успешно. Заказанные товары смотрите в разделе 'доставки' вашего личного кабинета!");
             },
             error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            },
         });
     });
});    