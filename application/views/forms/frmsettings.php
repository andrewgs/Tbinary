<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
<fieldset>
	<legend><?=$form_legend;?></legend>
	<div class="control-group">
		<label for="registration" class="control-label">Registration: </label>
		<div class="controls">
			<input type="text" class="span14" name="registration" value="<?=$settings['registration'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="charts" class="control-label">Charts: </label>
		<div class="controls">
			<input type="text" class="span14" name="charts" value="<?=$settings['charts'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="deposit" class="control-label">Deposit: </label>
		<div class="controls">
			<input type="text" class="span14" name="deposit" value="<?=$settings['deposit'];?>">
		</div>
	</div>
	<div class="form-actions">
			<button class="btn btn-success" type="submit" name="submit" value="submit">Submit Form</button>
		</div>
</fieldset>
<?= form_close(); ?>