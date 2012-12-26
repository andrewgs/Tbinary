<header class="row">
	<div class="span6">
		<?=anchor('','Tbinary trading platform',array('id'=>'logo'));?>
	</div>
	<nav class="span10">
		<ul id="main-nav">
		<?php for($i=0;$i<count($main_menu);$i++):?>
			<li><?=anchor($main_menu[$i]['url'],$main_menu[$i]['link']);?></li>
		<?php endfor;?>
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
		Hello, <strong><?=$this->user['name'];?></strong><br/><?=anchor('cabinet/balance','My Account',array('class'=>'action-cabinet'));?>
		<?php endif;?>
		<?=anchor('logoff','Logout',array('class'=>'action-cabinet'));?>
		</div>
	<?php endif;?>
<?php if($languages):?>
	<div id="ChangeLang">
		<div class="btn-group">
			<button class="btn btn-mini">&nbsp;<?=strtolower($languages[$this->language-1]['name']);?>&nbsp;</button>
			<button data-placement="right" role="tooltip" data-original-title="Change site language" class="btn btn-mini dropdown-toggle ttObject" data-toggle="dropdown"><span class="caret"></span></button>
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
<?php endif;?>
</header>