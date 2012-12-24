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
	<?php if(!$this->loginstatus):?>
		<div class="span7 offset1">
		<?php $this->load->view("forms/frmlogin");?>
		</div>
	<?php else:?>
		<div class="span6 offset2 auth-data">
		<?php if($this->user['admin']):?>
		Hello, <strong><?=$this->user['name'];?></strong><br/><?=anchor('admin-panel/actions/users-list','Administration Panel',array('class'=>'action-cabinet'));?>
		<?php else:?>
		Hello, <strong><?=$this->user['name'];?></strong><br/><?=anchor('#','My Account',array('class'=>'action-cabinet'));?>
		<?php endif;?>
		<?=anchor('logoff','Logout',array('class'=>'action-cabinet'));?>
		</div>
	<?php endif;?>
	
	<div id="ChangeLang">
		<div class="btn-group">
			<button class="btn btn-mini ttObject">&nbsp;<?=strtolower($languages[$this->language-1]['name']);?>&nbsp;</button>
			<button class="btn btn-mini dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
			<ul class="dropdown-menu" style="min-width:0px;">
		<?php for($i=0;$i<count($languages);$i++):?>
			<?php if($i != ($this->language-1)):?>
				<li><?=anchor('change-site-language/'.strtolower($languages[$i]['name']),strtolower($languages[$i]['name']));?></li>
			<?php else:?>
				<li><?=anchor('#',strtolower($languages[$i]['name']),array('class'=>'none'));?></li>
			<?php endif;?>
		<?php endfor;?>
			</ul>
		</div>
	</div>
</header>