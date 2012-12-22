<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<?php $this->load->view("admin_interface/includes/navigation");?>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<?php if($redactor):?>
					<?php $this->load->view("forms/text-editor");?>
				<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/leng-insert");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<?php if($redactor):?>
	<script src="<?=$baseurl;?>ckeditor/ckeditor.js"></script>
	<?php endif;?>
</body>
</html>