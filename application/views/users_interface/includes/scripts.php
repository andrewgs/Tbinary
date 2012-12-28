<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
<script src="<?=$baseurl;?>js/vendor/bootstrap.min.js"></script>
<script src="<?=$baseurl;?>js/scripts.js"></script>
<script type="text/javascript">
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
	$("li[data-url='<?=$this->uri->uri_string();?>']").addClass('active').children("a").addClass('none');
	$(".none").click(function(event){event.preventDefault();});
	$(".ttObject").tooltip();
</script>