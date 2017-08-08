$(document).ready(function () {
    $('img').on('click', function () {
        var image = $(this).attr('src');
       
        $('#myModal').on('show.bs.modal', function () {
            $(".img-modal").attr("src", image);
        });
    });
});