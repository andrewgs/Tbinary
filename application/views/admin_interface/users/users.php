<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Users list</a>
					</div>
				</div>
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
							<td>
								<?=$users[$i]['first_name'].' '.$users[$i]['last_name'];?>
							</td>
							<td>
								Адрес: <?=$users[$i]['address1'];?><br/>
								Email: <?=$users[$i]['email'];?><br/>
								Телефоны: <?=$users[$i]['day_phone'];?> <?=$users[$i]['home_phone'];?><br/>
								<?php if($users[$i]['id'] != $userinfo['uid']):?>
								Логин: <strong><?=$users[$i]['email'];?></strong> Пароль: <strong><?=$users[$i]['password'];?></strong>
								<?php endif;?>
							</td>
							<td>
								<!-- <?=anchor('admin-panel/actions/users/edit/id/'.$users[$i]['id'],'<i class="icon-pencil"></i>',array('class'=>'btn'));?> -->
							<?php if($users[$i]['id'] != $userinfo['uid']):?>
								<div id="params<?=$i;?>" style="display:none" data-uid="<?=$users[$i]['id'];?>"></div>
								<div style="height:3px;">&nbsp;</div>
								<a class="deleteUser btn" data-param="<?=$i;?>" data-toggle="modal" href="#deleteUser" title="Удалить"><i class="icon-trash"></i></a>
							<?php endif;?>
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
			$(".deleteUser").click(function(){var Param = $(this).attr('data-param'); uID = $("div[id = params"+Param+"]").attr("data-uid");});
			$("#DelUser").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/users/delete/id/'+uID;});
		});
	</script>
</body>
</html>