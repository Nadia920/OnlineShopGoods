$(document).ajaxError(function(e, jqxhr, settings, exception) {
    if (jqxhr.readyState == 0 || jqxhr.status == 0) {
        alert("Произошла ошибка");
    }
});
$(document).ready(function () {
    $("#form").submit(function (e) { // Устанавливаем событие отправки для формы с id=form
        e.preventDefault();
        let form_data = $(this).serialize(); // Собираем все данные из формы
        $.ajax({
            type: "POST", // Метод отправки
            url: "http://localhost/OnlineShopGoods/src/php/telegram.php", // Путь до php файла отправителя
            contentType: 'charset=utf-8',
            data: form_data,
            success: function (response) {
                document.getElementById('operationStatus').style.display='inline-block';
                },
            error: function (jqXHR, exception) {
                alert("Ошибка");
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
            }
        });
    })
    return false;
});