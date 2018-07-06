$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.product-price').on('blur', function () {

        var elem = $(this);

        $.post(elem.data('url'), {price: elem.val(), id: elem.data('id')}, function (data) {
            console.log(data);
            if (data.res !== true) {
                alert('Возникла ошибка, попробуйте обновить страницу!');
            }
        });
    });
});