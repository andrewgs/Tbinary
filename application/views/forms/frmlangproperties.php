<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend><?=$form_legend;?></legend>
		<div class="control-group">
			<label for="name" class="control-label">Language name: </label>
			<div class="controls">
				<input type="text" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" class="span8 input-valid" name="name" autocomplete="off" value="<?=$lang['name'];?>"><br/>
				<span class="label label-info">For example: English, Russian</span>
			</div>
		</div>
		<div class="control-group">
			<label for="active" class="control-label">Language status: </label>
			<div class="controls">
			<?php if(!$lang['base']):?>
				<label class="checkbox" style="width:0;">
					<input type="checkbox" value="1" id="active" name="active" autocomplete="off" <?=($lang['active'])?'checked="checked"':'';?>>
					<?=($lang['active'])?'<span class="label label-success">ACTIVE</span>':'<span class="label label-important">NOT ACTIVE</span>';?>
				</label>
			<?php else:?>
				<label class="checkbox" style="padding-left: 0;">
					<span class="label label-success">ACTIVE</span>
				</label>
			<?php endif;?>
			</div>
		</div>
		<div class="control-group">
			<label for="base" class="control-label">Base language: </label>
			<div class="controls">
				<label class="checkbox" style="padding-left: 0;">
					<?=($lang['base'])?'<span class="label label-success">YES</span>':'<span class="label label-important">NO</span>';?>
				</label>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-primary sendForm" type="submit" name="submit" value="submit">Submit Form</button>
		</div>
	</fieldset>
<?= form_close(); ?>