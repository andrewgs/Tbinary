<div class="span5">
	<div class="well sidebar-nav">
		<ul class="nav nav-pills nav-stacked">
			<li class="nav-header">Navigation</li>
			<li num="home"><?=anchor('','Home');?></li>
			<li num="trading"><?=anchor('trade','Trade');?></li>
			<li num="balance"><?=anchor('cabinet/balance','Deposit');?></li>
			<!--
			<li num="portfolio"><?=anchor('cabinet/portfolio','Portfolio');?></li>
			-->
			<li num="profile"><?=anchor('cabinet/profile','Profile');?></li>
			<li class="nav-header">Actions</li>
			<li><?=anchor('logoff','Logout');?></li>
		</ul>
	</div>
</div>