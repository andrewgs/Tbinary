<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<?php $this->load->view("users_interface/includes/head");?>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="container">
		<?php $this->load->view("users_interface/includes/header");?>
	</div>
	<div id="content">
		
	<?php if(!$this->loginstatus):?>
		<iframe id="trade-wrapper" src="http://demo.sysfx.com:8100/trade/trade5-4.jsp?entry=test.21"></iframe>
	<?php else:?>
		<?php if($this->user['admin']):?>
		<iframe id="trade-wrapper" src="http://demo.sysfx.com:8100/trade/trade5-4.jsp?entry=test.21"></iframe>
		<?php else:?>
		<iframe id="trade-wrapper" src="http://demo.sysfx.com:8100/trade/trade5-4.jsp?entry=test.21&login=<?=$client['email'];?>t&password=<?=$client['trade_password'];?>"></iframe>
		<?php endif;?>
	<?php endif;?>
		
		
	</div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/copyright");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<script type="text/javascript">
	$(function(){
		
	});
	</script>
</body>
</html>
