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
						<a class="brand none" href="">Balance</a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="height:3px;"> </div>
			
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: 'http://vl625.sysfx.com:9089/gateway/serviceGateway.jsp?schemaId=demo.20',
				type: 'GET',
				crossDomain: true,
				success: function(data){
					console.log(data[0].serverName);
				},
				error: function() {
					console.info('Request now allowed');
				}
			});
		});
	</script>
</body>
</html>