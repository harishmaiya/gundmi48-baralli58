var infinityCarousel = function ( $scope ) {
    var $carousel   = $('.slide_li', $scope),
        initidx     = 0,
        activeidx   = 0,
        setlength   = 0;

    createCarousel();

    function createCarousel() {
        var $slideset   = $carousel.html(),
            slidewidth  = $carousel.children().width(),
            $initslide  = $carousel.children().eq(0).addClass('active'),
            initLeftPos = 0;

        setlength = $carousel.children().length;

        $carousel.append( $slideset ).prepend( $slideset );

        initLeftPos = $initslide.position().left * -1;
        initidx     = $initslide.index();
        activeidx   = initidx;

        applyCarouselPos( initLeftPos, true );

        $scope.on('click', '.nav', function (e) {
            e.preventDefault();
            var direction = $(this).hasClass('prev') ? 'left' : 'right';
            moveCarousel( direction );
        });

        $(window).resize(function () {
            var currentLeftPos = $carousel.children().eq( activeidx ).position().left * -1;
            applyCarouselPos( currentLeftPos );
        });
    }

    function applyCarouselPos( leftPos, disableTransition ) {
        if (disableTransition) {
            $carousel.addClass( 'no-transition' );
        }

        if (Modernizr.csstransforms3d) {
            $carousel.css({ transform: 'translate3d(' + leftPos + 'px, 0, 0)' });
        } else {
            $carousel.css({ left: leftPos });
        }

        if (disableTransition) {    
            $carousel.height(); // trigger reflow
            $carousel.removeClass( 'no-transition' );
        }
    }

    // Let's move the slide left and right, 1 slide at a time
    function moveCarousel( direction ) {
        var $active     = $('.active', $carousel),
            $next       = $('.active', $carousel).next(),
            $lastSlideStandIn     = $carousel.children().eq( initidx - 1 ),
            $firstSlideStandIn    = $carousel.children().eq( initidx + setlength ),
            firstSlideStandInPos  = $firstSlideStandIn.position().left * -1,
            lastSlideStandInPos   = $lastSlideStandIn.position().left * -1;

        if (direction == 'left') {
            $next = $('.active', $carousel).prev();
            if (activeidx == initidx) {
                applyCarouselPos( firstSlideStandInPos, true );
                $next = $firstSlideStandIn.prev();
            }
        } else {
            if (activeidx == initidx + setlength - 1) {
                applyCarouselPos( lastSlideStandInPos, true );
                $next = $lastSlideStandIn.next();
            }
        }

        $active.removeClass( 'active' );
        $next.addClass( 'active' );
        activeidx = $next.index();

        var nextSlidePos = $next.position().left * -1;
        applyCarouselPos( nextSlidePos );
    }
};

$(function(){
    $('.infinity-carousel').each(function() {
        infinityCarousel( $(this) );
    });
});