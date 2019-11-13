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

$.fn.pplSlider = function (e) {
    $(this).each(function () {
        var that = $(this);
        var ID = that.find('.ppl-list').attr('id');
        if (ID != 'undefined') {
            config.container = '#' + ID;
            tns(config);
        }

        that.find('.tns-outer .ppl-list .item').click(function (e) {
            $('.tns-outer .ppl-list .item.active').removeClass('active');
            $(this).addClass('active');
            var next = that.find('#' + $(this).data('target')).addClass('active');
            if (next.length == 1) {
                that.find('.media.active').removeClass('active');
                that.find('#' + $(this).data('target')).addClass('active');
            }
        });
    });
};

jQuery(document).ready(function () {

    var disableRightClick = function (e) {
        e.preventDefault();
    };

    $('.ppl.good, .ppl.dark').pplSlider();

    $('.periodicals .item .cover').on('contextmenu', disableRightClick).on('click', function () {
        var gallery = $(this).find('img').data('gallery');
        $.fancybox();
        $.fancybox.open(gallery);
    });

    $('#fotogalerie a.btn#galleryToggle').click(function (e) {
        $(this).toggleClass('shown');
        $(this).html($(this).hasClass('shown') ? 'Skrýt přidané fotografie' : 'Zobrazit více fotografií');

        $('html,body').animate({scrollTop: $('#fotogalerie').offset().top});

    });
    // photogallery fancybox
    $("a.fancybox").attr('rel', 'photogallery').fancybox();
});