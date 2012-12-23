<header class="row">
	<div class="span6">
		<?=anchor('','Tbinary trading platform',array('id'=>'logo'));?>
	</div>
	<nav class="span10">
		<ul id="main-nav">
			<li><?=anchor('','Home');?></li>
			<li><?=anchor('trade','Trade');?></li>
			<li><?=anchor('faq','FAQ');?></li>
			<li><?=anchor('deposit','Deposit');?></li>
			<li><?=anchor('contact-us','Contact Us');?></li>
		</ul>
	</nav>
	<div class="span8">
	<?php if(!$this->loginstatus):?>
		<?php $this->load->view("forms/frmlogin");?>
	<?php else:?>
		<?php if($this->user['admin']):?>
		Welcome, <?=$this->user['name'];?><br/><?=anchor('admin-panel/actions/users-list','Personal cabinet',array('id'=>'action-cabinet'));?>
		<?php else:?>
		Welcome, <?=$this->user['name'];?><br/><?=anchor('#','Personal cabinet',array('id'=>'action-cabinet','class'=>'none'));?>
		<?php endif;?>
		<?=anchor('logoff','Log off',array('id'=>'action-cabinet'));?>
	<?php endif;?>
	</div>
	<div id="ChangeLang">
		<div class="btn-group">
			<button class="btn btn-mini btn-inverse ttObject" data-placement="left" role="tooltip" data-original-title="Change website language" >&nbsp;&nbsp;<?=strtoupper($languages[$this->language-1]['name']);?>&nbsp;&nbsp;</button>
			<button class="btn btn-mini btn-inverse dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
			<ul class="dropdown-menu" style="min-width:0px;">
		<?php for($i=0;$i<count($languages);$i++):?>
			<?php if($i != ($this->language-1)):?>
				<li><?=anchor('change-site-language/'.strtolower($languages[$i]['name']),strtoupper($languages[$i]['name']));?></li>
			<?php else:?>
				<li><?=anchor('#','<span class="label label-success">'.strtoupper($languages[$i]['name']).'</span>',array('class'=>'none'));?></li>
			<?php endif;?>
		<?php endfor;?>
			</ul>
		</div>
	</div>
</header>