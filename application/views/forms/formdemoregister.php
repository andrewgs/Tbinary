<form class="signup-form demo" action="http://vl608.sysfx.com:8022/registration.aws?SCHEMA$=tfx22" method="post" target="signup_iframe">
	<input type="hidden" class="FieldSend" name="answerType" value="xml" />	
	<input type="hidden" class="FieldSend" name="act" value="send" />
	<input type="hidden" class="FieldSend" name="office" value="main" />
	<input type="text" class="valid-required FieldSend" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" name="fname" placeholder="Demo First name" />
	<input type="text" class="valid-required FieldSend" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" name="lname" placeholder="Demo Last name" />
	<input type="text" class="valid-required FieldSend" id="signup-email-demo" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" name="email" placeholder="Demo Email" />
	<select name="country" id="country-demo" class="FieldSend">
		<option value="United States">United States</option>
		<option value="United Kingdom">United Kingdom</option>
		<option value="Russian Federation">Russian Federation</option>
	</select>
	<input type="text" class="valid-required FieldSend" name="phone" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" placeholder="Phone" />
	<input type="checkbox" id="coach-demo" value="1" checked="checked" name="coach"/> <label for="coach">I'd like to speak with a trading coach</label>
<?php if(!$this->loginstatus):?>
	<button data-account="demo" type="submit" class="btn btn-action signup-btn" name="Submit">Open Demo Account</button>
<?php else:?>
	<button class="btn btn-action none" disabled="disabled">Not active</button>
<?php endif;?>
</form>