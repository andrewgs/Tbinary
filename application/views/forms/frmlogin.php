<div id="login-block">
	<?=form_open('login',array('id'=>'login-form')); ?>
		<input type="text" name="email" id="login-email" data-placement="left" role="tooltip" data-original-title="Field cannot be empty" class="valid-required FieldSend" placeholder="Email" autocomplete="off"/>
		<input type="password" name="pass" data-placement="left" role="tooltip" data-original-title="Field cannot be empty" class="valid-required FieldSend" placeholder="Password" autocomplete="off" />
		<button class="btn btn-action" name="enter" value="send" id="login-btn">Log in</button>
		<a id="ForgotPassword" data-popshow="0" data-html="true" data-content="Error! Sorry..." data-placement="bottom" rel="popover" style="cursor:pointer;" data-original-title="Enter your email address">Forgot password?</a>
	<?= form_close(); ?>
</div>
<div id="popover-content" style="display:none;">
	<div class="forgot-block">
		<input type="text" name="user_email" id="ForgotEmail" value="" data-placement="left" role="tooltip" data-original-title="Field cannot be empty" class="valid-required FieldSend" style="width:145px;" placeholder="Your email" autocomplete="off" />
		<button class="btn btn-danger ForgotBtn" name="forgot" value="send" style="margin-top:-5px;">OK</button>
	</div>
</div>