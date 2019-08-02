$('.categories-link').mouseover(function () {
    $('.slide-show').css('display', 'block');
    $('.categories-list-slide-show').css('display', 'block');
});

$('.categories-list-slide-show').mouseleave(function () {
    $('.categories-list-slide-show').css('display', 'none');
    $('.slide-show').css('display', 'none');
});
