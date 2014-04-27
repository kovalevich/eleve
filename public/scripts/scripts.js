	
$(document).ready(function(){

	$(".vacancy .name:first").addClass("active");
	$(".vacancy .one_vacancy:first").show();
 
	$(".vacancy .name").click(function(){
		$(this).next(".one_vacancy").slideToggle("slow")
		.siblings(".one_vacancy:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings(".name").removeClass("active");
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

    photos = $('.photo');
    for(var i=0; i<photos.length; i++) {
        image = photos[i];
        image.with = 130;
        image.height = 194;
    }
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