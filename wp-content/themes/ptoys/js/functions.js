/* global screenReaderText */
/**
 * Theme functions file.
 */

jQuery(document).ready(function($){

    $(function(){
        $('#slides').slides({
            play: 2000,
            pause: 1500,
            effect: 'fade',
            hoverPause: false,
            generateNextPrev: false
        });
    });

    $("#exit").click(function() {
        $('#vspl').hide(500);
        $('.vspl').hide(500);
    });

    $('.jump-menu').click(function () {
        if ($('.sm-menu:visible').length > 0) {
            $('.sm-menu').hide();
        } else {
            $('.sm-menu').show();
        }
    })

    $('#top .sm-menu li a').click(function () {
        $('.sm-menu').hide();
    });

    $(document).ready(function() {
        $("#j-menu li a").click(function(e) {
            $('html,body').stop().animate({
                scrollTop: $($(this).attr("href")).offset().top
            }, 1000);
            e.preventDefault();
        });
    });

    $(".fast-acc-label-fixed .cart-label").click(function(){
        $( "#myModal .modal-body" ).empty();
        $( "#myModal .modal-body" ).append('<img class="ajax-loader" src="http://pamperok.com.ua/wp-content/themes/ptoys/images/ajax-loader.gif" alt="Loader"/>');
        $.ajax({
            url: "/wp-content/themes/ptoys/template-parts/cart-append.php",
            cache: false
        })
        .done(function( html ) {
            $( "#myModal .modal-body .ajax-loader" ).hide();
            $( "#myModal .modal-body" ).append( html );
            $( '#myModal input[name="_wp_http_referer"]').remove();
        });
    });

    $(document).on("submit", '#ajaxform', function () {
        var form = $(this);
        var error = false;

        form.find('input[type="text"]').each( function(){
            if ($(this).val() == '') {
                alert('Заполните поле "'+$(this).attr('data-notice')+'"!');
                error = true;
            }
        });

        if (!error) {
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: '/wp-content/themes/ptoys/template-parts/sendform.php',
                dataType: 'json',
                data: data,
                beforeSend: function(data) {
                    form.find('input[type="submit"]').attr('disabled', 'disabled');
                },
                success: function(data){
                    if (data['error']) {
                        alert(data['error']);
                    } else {
                        $('.vspl').show(500);
                        $('#vspl').show(500);
                    }
                },
                error:  function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }
        return false;
    });
});