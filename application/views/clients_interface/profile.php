<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("clients_interface/includes/head");?>
<body>
	<?php $this->load->view("clients_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Profile</a>
						<!--<a class="btn btn-info pull-right" data-toggle="modal" href="#newPassword">Request new password</a>-->
					</div>
				</div>
				<div class="clear"></div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div class="clear"></div>
				<?php $this->load->view("forms/frmedituser");?>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		<?php $this->load->view("clients_interface/modal/new-password");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>
</body>
</html>