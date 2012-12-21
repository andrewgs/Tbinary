<?=form_open('login',array('id'=>'login-form')); ?>
	<em></em>
	<input type="text" name="email" id="login-email" class="valid-required FieldSend" placeholder="Email" autocomplete="off"/>
	<input type="password" name="pass" class="valid-required FieldSend" placeholder="Password" autocomplete="off" />
	<button class="btn btn-action" name="enter" value="send" id="login-btn">Log in</button>
	<?=anchor('','Forgot password?');?>
<?= form_close(); ?>