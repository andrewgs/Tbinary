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
		<div id="content">
			<div class="row">
			<?php if($active_category):?>
				<div id="sidebar" class="span5">
					<ul>
				<?php for($i=0;$i<count($footer['pages']);$i++):?>
					<?php if($footer['pages'][$i]['category'] == $active_category):?>
						<li data-url="<?=$footer['pages'][$i]['url'];?>">
							<?=anchor($footer['pages'][$i]['url'],$footer['pages'][$i]['link']);?>
						</li>
					<?php endif;?>
				<?php endfor;?>
					</ul>
				</div>
				<div class="span1"> </div>
			<?php endif;?>
				<div class="span18">
					<?=$content;?>
				</div>
​			</div>
		</div>
	</div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/copyright");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>
