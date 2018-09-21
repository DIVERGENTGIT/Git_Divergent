$(document).ready(function() {
    $('.responsive').slick( {
        dots:false, infinite:false, autoplay:true, speed:500, slidesToShow:12, slidesToScroll:1, responsive:[ {
            breakpoint:1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: false
            }
        }
        , {
            breakpoint:600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }
        }
        , {
            breakpoint:480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }
        ]
    }
    );
    $('.responsive2').slick( {
        dots:false, infinite:false, autoplay:true, speed:500, slidesToShow:4, slidesToScroll:4, responsive:[ {
            breakpoint:1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: false
            }
        }
        , {
            breakpoint:600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }
        }
        , {
            breakpoint:480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }
        ]
    }
    );
}

);