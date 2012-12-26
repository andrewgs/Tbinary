<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
<script src="<?=$baseurl;?>js/vendor/bootstrap.min.js"></script>
<script src="<?=$baseurl;?>js/scripts.js"></script>
<script type="text/javascript">
	$("li[num='<?=$this->uri->segment(2);?>']").addClass('active');
	$(".backpath").click(function(){backpath("<?=$this->session->userdata('backpath');?>")});
	$(".ttObject").tooltip();
</script>