<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
<fieldset>
	<legend><?=$form_legend;?></legend>
	<div class="control-group">
		<label for="link1" class="control-label">link1: </label>
		<div class="controls">
			<input type="text" class="span14" name="link1" value="<?=$settings['link1'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="link2" class="control-label">link2: </label>
		<div class="controls">
			<input type="text" class="span14" name="link2" value="<?=$settings['link2'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="link3" class="control-label">link3: </label>
		<div class="controls">
			<input type="text" class="span14" name="link3" value="<?=$settings['link3'];?>">
		</div>
	</div>
	<div class="form-actions">
			<button class="btn btn-success" type="submit" name="submit" value="submit">Submit Form</button>
		</div>
</fieldset>
<?= form_close(); ?>