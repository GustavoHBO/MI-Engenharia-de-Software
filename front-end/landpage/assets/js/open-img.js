$(document).ready(function () {
    $('img').on('click', function () {
        var image = $(this).attr('src');
        var imgprincipal = $(".img-item").attr('src');

        $("#myImg").on('click', function () {
            $(".item-mini").attr("src", imgprincipal);
            $(".img-item").attr("src", image);
        });
    });
});