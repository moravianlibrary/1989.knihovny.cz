var config = {
    "container": "#list",
    "items": 4,
    "controls": false,
    "slideBy": 1,
    "mouseDrag": true,
    "swipeAngle": false,
    "speed": 400,
    "autoplay": true,
};
tns(config);
config.container = "#list-dark";
tns(config);

jQuery(document).ready(function () {

    var disableRightClick = function (e) {
        e.preventDefault();
    }

    $('.periodicals .item .cover').on('contextmenu', disableRightClick).on('click', function () {
        var gallery = $(this).find('img').data('gallery');
        $.fancybox();
        $.fancybox.open(gallery);
    });
});