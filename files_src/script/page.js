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

jQuery(document).ready(function () {

    var disableRightClick = function (e) {
        e.preventDefault();
    }

    $('.ppl-list.tns-slider .item').click(function () {
        var ppls = $('.ppl .media#' + $(this).data('target'))
        if (ppls.length > 0) {
            $('.ppl .media.active').removeClass('active');
            ppls.addClass('active');
        }
    });

    $('.periodicals .item .cover').on('contextmenu', disableRightClick).on('click', function () {
        var gallery = $(this).find('img').data('gallery');
        $.fancybox();
        $.fancybox.open(gallery);
    });
});