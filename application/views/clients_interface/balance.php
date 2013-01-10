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
				<div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Account</th>
								<th>Deposit, $</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($accounts as $acc) : ?>
								<tr>
									<td width="100px"><?= $acc['accountId']; ?></td>
									<td width="150px"><?= $acc['amount']; ?></td>
									<td>
										<form method="post" action="<?=$action_deposit;?>">
											
											<label>Amount</label>
											<input name="amount" type="text" class="span2 amount" value="50" />
											<input type="hidden" name="accountId" value="<?= $acc['accountId']; ?>" />
											<input type="hidden" name="success" value="http://<?= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" />
											<input type="hidden" name="cancel" value="http://<?= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" />
											<button type="submit" class="btn btn-mini btn-success service-order">Deposit Funds</button>
										</form>
									</td>
								</tr>
							<? endforeach; ?>
						</tbody>
					</table>	
				</div>
			
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
	</script>
</body>
</html>