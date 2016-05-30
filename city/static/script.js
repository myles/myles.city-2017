$(window).on('DOMContentLoaded load resize scroll', function () {
    var images = $('.post-list .post--cover[data-src]');
    
    // load images that have entered teh viewport
    $(images).each(function (index) {
        if (isElementInViewport(this)) {
            var data_src = $(this).attr('data-src');
            $(this).css("background-image", "url(" + data_src + ")");
            $(this).removeAttr('data-src');
        }
    })
    
    // if all the images are loaded, stop calling the handler
    if (images.length == 0) {
        $(window).off('DOMContentLoaded load resize scroll');
    }
})

// source: http://stackoverflow.com/a/7557433/43363
function isElementInViewport (el) {
    var rect = el.getBoundingClientRect();

    return (rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= $(window).height() &&
            rect.right <= $(window).width());
}
