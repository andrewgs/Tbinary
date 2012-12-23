<div id="login-block">
	<?=form_open('login',array('id'=>'login-form')); ?>
		<input type="text" name="email" id="login-email" data-placement="left" role="tooltip" data-original-title="Field cannot be empty" class="valid-required FieldSend" placeholder="Email" autocomplete="off"/>
		<input type="password" name="pass" data-placement="left" role="tooltip" data-original-title="Field cannot be empty" class="valid-required FieldSend" placeholder="Password" autocomplete="off" />
		<button class="btn btn-action" name="enter" value="send" id="login-btn">Log in</button>
		<?=anchor('','Forgot password?');?>
	<?= form_close(); ?>
</div>