<header class="row">
	<div class="span6">
		<?=anchor('','Tbinary trading platform',array('id'=>'logo'));?>
	</div>
	<nav class="span10">
		<ul id="main-nav">
			<li><?=anchor('','Home');?></li>
			<li><?=anchor('trade','Trade');?></li>
			<li><?=anchor('','FAQ');?></li>
			<li><?=anchor('','Deposit');?></li>
			<li><?=anchor('','Contact Us');?></li>
		</ul>
	</nav>
	<div class="span8">
	<?php if(!$this->loginstatus):?>
		<?php $this->load->view("forms/frmlogin");?>
	<?php else:?>
		<?php if($this->user['admin']):?>
		Welcome, <?=$this->user['name'];?><br/><?=anchor('admin-panel/actions/orders','Personal cabinet',array('id'=>'action-cabinet'));?>
		<?php else:?>
		Welcome, <?=$this->user['name'];?><br/><?=anchor('cabinet/orders','Personal cabinet',array('id'=>'action-cabinet'));?>
		<?php endif;?>
		<?=anchor('logoff','Log off',array('id'=>'action-cabinet'));?>
	<?php endif;?>
	</div>
</header>