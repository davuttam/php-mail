$(document).ready(function() {

	$("#contactUsform").submit(function(){
		if(!$("#captcha").val()) {
			$("#captcha-info").html("(required)");
			$("#captcha").css('border-color','#ff0000fc');
			valid = false;
	}
		// return false;
	});
});

//change CAPTCHA on each click or on refreshing page
function refreshCaptcha() {
	$("#captcha_code").attr('src','captcha.php');
}