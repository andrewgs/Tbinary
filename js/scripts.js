/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
function isValidEmailAddress(emailAddress){
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
};

function isValidPhone(phoneNumber){
	var pattern = new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i);
	return pattern.test(phoneNumber);
};

function myserialize(objects){
	var data = '';
	$(objects).each(function(i,element){
		if(data === ''){
			data = $(element).attr('name')+"="+$(element).val();
		}else{
			data = data+"&"+$(element).attr('name')+"="+$(element).val();
		}
	});
	return data;
};

function backpath(path){window.location=path;}

(function($){
	var baseurl = "http://test.sysfx.us/";
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
	$(".digital").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}});
	$(".negative").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && e.which!=45 && (e.which<48 || e.which>57)){return false;}});
	$(".none").click(function(event){event.preventDefault();});
	
	$(".sendForm").click(function(event){
		var parentFrom = $(this).parents("form");
		var err = false; $(parentFrom).find(".control-group").removeClass('error');$(parentFrom).find(".help-inline").hide();
		$(parentFrom).find(".input-valid").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).tooltip('show');err = true;}});if(err){event.preventDefault();$("html, body").animate({scrollTop:'0'},"slow");}
	});
	
	$("#login-btn").click(function(event){
		var err = false;event.preventDefault();
		$("#login-form .valid-required").each(function(i,element){if($(this).val()==''){$(this).tooltip('show');err = true;}});
		if(!err && !isValidEmailAddress($("#login-email").val())){$("#login-email").attr('data-original-title','Not valid email address').tooltip('show');err = true;}
		if(!err){
			var postdata = myserialize($("#login-form .FieldSend"));
			$.post(baseurl+"login",{'postdata':postdata},function(data){
				if(data.status){$("#login-form").remove();$("#login-block").html(data.newlink);$("#login-block").parents('div:first').addClass('auth-data');
					$(".signup-btn").attr("disabled","disabled").addClass('none').html('Not active'); $("#TradeLink").replaceWith('<a class="btn btn-action" href="'+baseurl+'trade">Start trade now</a>');}
				else{$("#login-email").attr('data-original-title','Logon failure').tooltip('show');}},"json");
		}
	});
	$("#ForgotPassword").click(function(){
		var popover_content = $("#popover-content").html();
		if($(this).attr("data-popshow") == 0){
			$("#ForgotPassword").attr("data-content",popover_content).popover('show');$(this).attr("data-popshow",1);
			$(".ForgotBtn").live('click',function(event){event.preventDefault();forgot_password();});
		}
	});
	function forgot_password(){
		var err = false;
		var forgot_mail = $("#ForgotEmail").val();
		if(forgot_mail==''){$("#ForgotEmail").tooltip('show');err = true;};
		if(!err && !isValidEmailAddress(forgot_mail)){$("#ForgotEmail").attr('data-original-title','Not valid email address').tooltip('show');err = true;}
		if(!err){$.post(baseurl+"forgot-password",{'user_email':forgot_mail},function(data){
				if(data.status){$("#login-form .forgot-block").html(data.message);}$("#login-form .popover-title").html(data.title);},"json");}
	}
	$(".signup-btn").click(function(event){
		var thisObj = $(this);
		var err = false;event.preventDefault();
		var account = $(this).attr('data-account');
		var email = $("#signup-email-"+account).val();
		$("."+account+" .valid-required").each(function(i,element){if($(this).val()==''){$(this).tooltip('show');err = true;}});
		if(!err && !isValidEmailAddress(email)){$("#signup-email-"+account).attr('data-original-title','Not valid email address').tooltip('show');err = true;}
		if(!err){
			var postdata = myserialize($("."+account+" .FieldSend"));
			var coach = 0;
			if($("#coach-"+account+":checked").length == 1){coach = 1;}
			postdata = postdata+"&coach="+coach;
			if(account == 'demo'){postdata = postdata+"&demo=1"}else{postdata = postdata+"&demo=0"}
			$(thisObj).html('Please wait...');
			$.post(baseurl+"registering",{'postdata':postdata},
				function(data){
					if(data.status){
						$(thisObj).attr("disabled","disabled").html('Account created').css('background','none repeat scroll 0 0 #A6BD01').die('click');
						$("#login-form").remove();$("#login-block").html(data.newlink);$("#login-block").parents('div:first').addClass('auth-data');
						$("#TradeLink").replaceWith('<a class="btn btn-action" href="'+baseurl+'trade">Start trade now</a>');
						$(".FieldSend").val('');}else{$(thisObj).html('Open accaunt');alert(data.message);}
				},
			"json");
		}
	});
})(window.jQuery);