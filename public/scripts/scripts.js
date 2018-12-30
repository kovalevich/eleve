
$(document).ready(function(){

    $('#check_type').unbind().change(function(e) {
        $('#type_account').slideUp('fast');
        $('#type_account_discount').slideUp('fast');
        messages =
            [
                'Да, я хочу получать новости и уведомления об акциях и закрытых рапсродажах для держателей дисконтной карты. 1',
                'Да, я хочу получать новости и уведомления об акциях и закрытых рапсродажах для держателей дисконтной карты. 2',
                'Да, я хочу получать новости и уведомления об акциях и закрытых рапсродажах для держателей дисконтной карты. 3',
                'Да, я хочу получать новости и уведомления об акциях и закрытых рапсродажах для держателей дисконтной карты. 4'
            ];
        $('#label').html(messages[$(this).val()]);
        if($(this).val() == 1) {
            $('#type_account').slideDown('fast');
            return false;
        }
        if($(this).val() == 3) {
            $('#type_account_discount').slideDown('fast');
            return false;
        }
    });

    var is_caledoscop = false;
    var i = 1;
    var j = 1;
    speed = 5;
    position = 0;
    cSiza = $(".caledoscop img").size();

    $(".caledoscop img").preload(function(){
        $(".load").fadeOut();
        is_caledoscop = true;
    });

    $('html').mousemove(function(e){
        if(position == speed){
            position = 0;
            $(".caledoscop img").css("display", "none");
            $(".caledoscop img:eq("+j+")").css("display", "block");
            if ((j == 1 && i == -1) || (j == cSiza-1 && i == 1)) i *= -1;
            j += i;
        }
        else position ++;
    });

    $(".vacancy .name:first").addClass("active");
    $(".vacancy .one_vacancy:first").show();

    $(".vacancy .name").unbind().click(function(){
        $('.one_vacancy:visible').slideUp("slow");
        $('.name').removeClass("active");

        $(this).next(".one_vacancy").slideDown("slow");
        $(this).toggleClass("active");
        return false;
    });

    $(".model_img a").fancybox();


    /* input focus
     -------------------------------------*/
    $().ready(function() {
        $('input.tx, textarea').each(function(index, element) {
            var $element = $(element);
            var defaultValue = $element.val();
            $element.focus(function() {
                var actualValue = $element.val();
                if (actualValue == defaultValue) {
                    $element.val('');
                }
            });
            $element.blur(function() {
                var actualValue = $element.val();
                if (!actualValue) {
                    $element.val(defaultValue);
                }
            });
        });
    });
});

function deleteImage(idel, el)
{
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/profile/deleteimage/id/'+idel,
        data: {
        },
        beforeSend: function(){

        },
        success: function(html){
            $('#'+el).hide();
        }
    });
}

var id = 1;

function addFileform()
{
    $('#file-' + id).show();
    id += 1;
}