var config = {
    "container": "#list",
    "items": 4,
    "controls": false,
    "slideBy": 1,
    "mouseDrag": true,
    "swipeAngle": false,
    "speed": 400,
    "autoplay":true,
};
tns(config);

jQuery(document).ready(function () {
    $('img').on('contextmenu', function (e) {
        e.preventDefault();
    });
    $('.periodicals .item .cover').click(function () {
        var gallery = $(this).find('img').data('gallery');
        $.fancybox(gallery);
    });
});