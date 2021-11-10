// palaralx
// about
$(window).on('load', function () {
    $('.pLeft').addClass('pMuncul');
    $('.pRight').addClass('pMuncul');
});

$(window).scroll(function() {
    var wScroll = $(this).scrollTop();

    // jumbotron
    $('.jumbotron .rounded-circle').css({
        'transform' : 'translate(0px, '+ wScroll/4 +'%)'
    });
    $('.jumbotron h1').css({
        'transform' : 'translate(0px, '+ wScroll/2 +'%)'
    });
    $('.jumbotron p').css({
        'transform' : 'translate(0px, '+ wScroll/1.2 +'%)'
    });

    // projects
    if (wScroll > $('.projects').offset().top - 250) {
        $('.projects .card').each(function (i) {
            setTimeout(function () {
                $('.projects .card').eq(i).addClass('muncul');
            }, 300*(i+1));
        });
    }
});