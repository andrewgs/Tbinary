<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend><?=$form_legend.' '.strtoupper($langs[$this->uri->segment(5)-1]['name']);?></legend>
		<ul id="ProductTab" class="nav nav-tabs">
			<li class="active"><a href="#main" data-toggle="tab">Main</a></li>
			<li><a href="#category" data-toggle="tab">Catogory</a></li>
		</ul>
		<div id="ProductTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="main">
				<div class="control-group">
					<label for="title" class="control-label">Page title: </label>
					<div class="controls">
						<input type="text" class="span14" name="title" value="<?=$page['title'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="description" class="control-label">Page description: </label>
					<div class="controls">
						<textarea rows="1" class="span14" name="description"><?=$page['description'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="link" class="control-label">Page link: </label>
					<div class="controls">
						<input type="text" data-placement="top" role="tooltip" data-original-title="Field cannot be empty" class="span14 input-valid" name="link" value="<?=$page['link'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="url" class="control-label">Page URL: </label>
					<div class="controls">
						<input type="text" class="span14" name="url" value="<?=$page['url'];?>">
					</div>
				</div>
				<div class="control-group">
					<textarea rows="14" class="span14 ckeditor" name="content"><?=$page['content'];?></textarea>
				</div>
			</div>
			<div class="tab-pane fade" id="category">
				<div class="control-group">
					<label for="image" class="control-label">Category: </label>
					<div class="controls">
						<select id="CategoryPage" name="category" class="span9">
							<option value="0">No category</option>
						<?php for($i=0;$i<count($category);$i++):?>
							<option value="<?=$category[$i]['id'];?>"><?=$category[$i]['title'];?></option>
						<?php endfor;?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-primary sendForm" type="submit" name="submit" value="submit">Submit Form</button>
		</div>
	</fieldset>
<?= form_close(); ?>