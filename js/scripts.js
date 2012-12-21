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
	var baseurl = "http://tbinary/";
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
	$(".digital").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}});
	$(".negative").keypress(function(e){if(e.which!=8 && e.which!=46 && e.which!=0 && e.which!=45 && (e.which<48 || e.which>57)){return false;}});
	$(".none").click(function(event){event.preventDefault();});
	
	$("#login-btn").click(function(event){
		var err = false;$("#login-form em").hide();
		event.preventDefault();
		$("#login-form .valid-required").each(function(i,element){if($(this).val()==''){$("#login-form em").html('Fields is empty<br/>').show();err = true;}});
		if(!err && !isValidEmailAddress($("#login-email").val())){$("#login-form em").html('Not valid email address<br/>').show();$("#login-form .FieldSend").val('');err = true;}
		if(!err){
			var postdata = myserialize($("#login-form .FieldSend"));
			$.post(baseurl+"login",{'postdata':postdata},function(data){
				if(data.status){$("#login-form").remove();$("#login-block").html(data.newlink);
				}else{$("#login-form .FieldSend").val('');$("#login-form em").html(data.message).show();}},"json");
		}
	});
})(window.jQuery);