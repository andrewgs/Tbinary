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
		<div id="main">
			<p class="slogan">Join the most <em>advanced, trusted and reliable</em> trading platform</p>
			<div class="row">
				<div id="container" class="span18"> </div>
				<div class="span6">
					<ul class="switcher">
						<li><a class="switcher__active" href="#real-signup"><span>Real Trade</span></a></li>
						<li><a href="#demo-signup"><span>Demo Trade</span></a></li>
					</ul>
					<div class="signup-form" id="real-signup">
						<?php $this->load->view("forms/formrealregister");?>
					</div>
					<div class="signup-form" id="demo-signup">
						<?php $this->load->view("forms/formdemoregister");?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span18">
					<?php $this->load->view("users_interface/includes/ticker");?>
				</div>
				<div class="span6"> 
					<h3 class="main"><?=(isset($page[1]['link']))?$page[1]['link']:'';?></h3>
					<?=(isset($page[1]['content']))?$page[1]['content']:'';?>
				</div>
			</div>
		</div>
	</div>
	<div class="gray-bg">
		<div class="container">
			<div class="row">
				<div class="span24 heading">
					<h2 class="main"><?=(isset($page[2]['link']))?$page[2]['link']:'';?></h2>
				</div>
				<?=(isset($page[2]['content']))?$page[2]['content']:'';?>
			</div>
		</div>
	</div>
	<div id="try-now">
		<div class="container">
			<div class="row">
					<div class="span18">
						<p class="caption"><?=(isset($page[3]['link']))?$page[3]['link']:'';?></p>
					</div>
					<div class="span6">
						<?=anchor('trade',(isset($page[3]['content']))?$page[3]['content']:'Start trade now',array('class'=>'btn btn-action','id'=>"TradeLink"));?>
					</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span24">
				<?=(isset($page[4]['content']))?$page[4]['content']:'';?>
			</div>
		</div>
	</div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/copyright");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<script src="<?=$baseurl;?>js/main.js"></script>
	<script type="text/javascript">
		$(function(){
			$("ul.switcher li a").click(function(e){e.preventDefault();$("ul.switcher li a").removeClass('switcher__active');$(this).addClass('switcher__active');
				$("div.signup-form:visible").hide();var elem_id = $(this).attr('href');$(elem_id).show();});
		<?php if(!$this->loginstatus):?>
			$("#TradeLink").click(function(event){alert("First need login!");event.preventDefault();});
		<?php endif;?>
		});
	</script>
</body>
</html>
