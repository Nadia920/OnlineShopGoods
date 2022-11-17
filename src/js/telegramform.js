
$(document).ajaxError(function(e, jqxhr, settings, exception) {
    if (jqxhr.readyState == 0 || jqxhr.status == 0) {
        alert("������");
    }
});
$(document).ready(function () {
    $("#form").submit(function (e) { // ������������� ������� �������� ��� ����� � id=form
        e.preventDefault();
        let form_data = $(this).serialize(); // �������� ��� ������ �� �����

        $.ajax({
            type: "POST", // ����� ��������
            url: "http://localhost/OnlineShopGoods/src/php/telegram.php", // ���� �� php ����� �����������
            data: form_data,
            success: function (response) {
                document.getElementById('operationStatus').style.display='inline-block';
            },
            error: function (jqXHR, exception) {
                alert("������");
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