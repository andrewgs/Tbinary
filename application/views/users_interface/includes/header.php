<header class="row">
	<div class="span6">
		<?=anchor('','Tbinary trading platform',array('id'=>'logo'));?>
	</div>
	<nav class="span10">
		<ul id="main-nav">
			<li><?=anchor('','Home');?></li>
			<li><?=anchor('','Trade');?></li>
			<li><?=anchor('','FAQ');?></li>
			<li><?=anchor('','Deposit');?></li>
			<li><?=anchor('','Contact Us');?></li>
		</ul>
	</nav>
	<div class="span8">
		<?php $this->load->view("forms/frmlogin");?>
	</div>
</header>