$(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    'use strickt';


    /*========== Start Header ==========*/


    $('header .navbar .navbar-toggler').click(function () {

        $(this).children(':first-child,:last-child').toggleClass('toggle-change');

        $(this).children(':nth-child(2)').toggleClass('toggle-appearance');

    });

    $('header .header-body .header-body-bottom i.fa-sort-down').click(function () {

        var position = $('header').height();

        $('html,body').animate({scrollTop: position}, 500);

    });

    if ($(window).width() <= 767) {

        $('header .header-body .header-body-bottom').css({display: 'none'});

    }


    /*========== End Header ==========*/


    /*========== Start Navbar (.inside-nav) ==========*/


    $('.inside-nav .navbar-toggler').click(function () {

        $(this).children(':first-child,:last-child').toggleClass('toggle-change');

        $(this).children(':nth-child(2)').toggleClass('toggle-appearance');

    });

    $('.inside-nav .navbar-collapse .nav-item input').click(function () {

        $(this).css({width: '200px'});

    });

    $('.inside-nav .navbar-collapse .item-click input[type="text"]').blur(function () {

        $(this).css({width: '85px'});

    });

    if ($(window).width() >= 481 && $(window).width() <= 640) {

        $('.inside-nav .navbar-collapse .item-click input[type="text"]').click(function () {

            $(this).css({width: '250px'});

        });

    }

    if ($(window).width() >= 641 && $(window).width() <= 767) {

        $('.inside-nav .navbar-collapse .item-click input[type="text"]').click(function () {

            $(this).css({width: '300px'});

        });

    }

    if ($(window).width() >= 961 && $(window).width() <= 1024) {

        $('.inside-nav .navbar-collapse .item-click input[type="text"]').click(function () {

            $(this).css({width: '195px'});

        });

    }


    if ($(window).width()>=768 && $(window).width() <= 960 ) {
        
        $('.navbar .navbar-collapse .nav-item .fa-search').click(function () {
            
            $('.after-nabvbar').css({top:'-1px'})

        });
            
        $('.after-nabvbar form i').click(function () {
            
            $('.after-nabvbar').css({top:'-75px'})
        
        });
            
        $(document).keydown(function (e) {
            
            if (e.keyCode == 27) {
                
                $('.after-nabvbar').css({top: '-75px'})
            
            }
        });
        
        $(window).scroll(function () {
            
            if ($(window).scrollTop() >= 50) {
                
                $('.after-nabvbar').css({top:'-75px'})
            
            }
        
        })
    
    }


    /*========== End Navbar (.inside-nav) ==========*/


    /*========== Start Add Business && Add Service ==========*/


    $('.add-business form input[type="file"]').change(function () {
    
        $(this).next('span').text($(this).val()).css({color:'#675565',fontWeight: 'bold'})
    
    });

    $('.add-service form input[type="file"]').change(function () {
    
        $(this).next('span').text($(this).val()).css({color:'#675565',fontWeight: 'bold'})
    
    });


    /*========== End Add Business && Add Service  ==========*/


    /*========== Start Sign In && Sign Up  ==========*/


    $('.sign-in i.fa-eye-slash').click(function () {
    
        if ($(this).hasClass('fa-eye-slash')) {
            
            $(this).addClass('fa-eye').removeClass('fa-eye-slash');
            
            $('.sign-in input[type="password"]').attr('type','text');
    
        } else {
            
            $(this).addClass('fa-eye-slash').removeClass('fa-eye');
            
            $('.sign-in input[type="text"]').attr('type','password');
    
        }
    
    });


    $('.sign-up i.fa-eye-slash').click(function () {
    
        if ($(this).hasClass('fa-eye-slash')) {
            
            $(this).addClass('fa-eye').removeClass('fa-eye-slash');
            
            $(this).prev('input[type="password"]').attr('type','text');
    
        } else {
            
            $(this).addClass('fa-eye-slash').removeClass('fa-eye');
            
            $(this).prev('input[type="text"]').attr('type','password');
    
        }
    
    });


    /*========== End Sign In && Sign Up  ==========*/

});
