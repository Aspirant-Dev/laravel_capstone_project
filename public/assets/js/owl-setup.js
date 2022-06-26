var owl = $('.owl-carousel');

owl.owlCarousel({
    loop:true,
    nav:true,
    margin:10,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        960:{
            items:5
        },
        1200:{
            items:4
        }
    }
});