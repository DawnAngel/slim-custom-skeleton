$(function () {
    $(document.body).attr('style', 'margin-bottom:' + $('#footer').outerHeight() + 'px;');

    $(window).resize(function () {
        $(document.body).attr('style', 'margin-bottom:' + $('#footer').outerHeight() + 'px;');
    });
});
