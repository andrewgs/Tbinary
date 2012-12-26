<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Users list</a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="height:3px;"> </div>
			<?php if($users):?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($users);$i++):?>
						<tr class="align-center">
							<td class="span6">
								<?=$users[$i]['first_name'].' '.$users[$i]['last_name'];?><br/>
								<strong><?=$users[$i]['email'];?></strong>
								<br/><span class="label label-info"><?=$users[$i]['signdate'];?></span>
								<?php if($users[$i]['coach']):?>
								&nbsp;<span class="label label-warning">Speak with a coach</span>
								<?php endif;?>
								<?php if(!$users[$i]['active']):?>
									<br/><br/><span class="label label-inverse"><em>User is not active</em></span>
								<?php endif;?>
							</td>
							<td class="span12">
								<strong>Address one:</strong> <?=$users[$i]['address1'];?><br/>
								<strong>Address two:</strong> <?=$users[$i]['address2'];?><br/>
								<strong>Email:</strong> <em><?=$users[$i]['email'];?></em><br/>
								<strong>Day phone:</strong> <?=$users[$i]['day_phone'];?><br/>
								<strong>Home phone:</strong> <?=$users[$i]['home_phone'];?><br/>
							</td>
							<td class="span1">
								<?=anchor('admin-panel/actions/users/edit/id/'.$users[$i]['id'],'<i class="icon-pencil icon-white"></i>',array('class'=>'btn btn-info'));?><br/>
								<div style="height:3px;"> </div>
								<a class="deleteUser btn btn-danger" data-uid="<?=$users[$i]['id'];?>" data-toggle="modal" href="#deleteUser" title="Delete user"><i class="icon-trash icon-white"></i></a>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/user-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var uID = 0;
			$(".deleteUser").click(function(){uID = $(this).attr('data-uid');});
			$("#DelUser").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/users/delete/id/'+uID;});
		});
	</script>
</body>
</html>