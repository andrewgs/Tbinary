<?=form_open('admin-panel/actions/pages',array('class'=>'form-horizontal')); ?>
<div id="InsertLang" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="Insert Language" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="InsertLangLabel">Adding language website</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="name" class="control-label">Name of the language:</label>
				<div class="controls">
					<input type="text" data-placement="top" role="tooltip" data-original-title="Field cannot be empty" class="span8 input-valid" name="name" autocomplete="off" value="">
					<span class="label label-info">For example: English, Russian</span>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-success sendForm" type="submit" name="insleng" value="send">Add language</button>
	</div>
</div>
<?= form_close(); ?>