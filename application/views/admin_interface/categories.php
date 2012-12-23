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
				<p><a class="btn btn-info addCategory" style="float:right;" data-toggle="modal" href="#addCategory"><i class="icon-plus icon-white"></i> New category</a></p>
			<?php if($category):?>
				<table class="table table-bordered table-hover">
					<caption><?=$form_legend.' '.strtoupper($langs[$this->uri->segment(5)-1]['name']);?></caption>
					<tbody>
					<?php for($i=0;$i<count($category);$i++):?>
						<tr class="align-center">
							<td class=""><?=$category[$i]['title'];?></td>
							<td class="span1"><a class="close" data-toggle="modal" href="#deleteCategory" data-category="<?=$category[$i]['id'];?>">&times;</a></td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/leng-insert");?>
		<?php $this->load->view("admin_interface/modal/category-insert");?>
		<?php $this->load->view("admin_interface/modal/category-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>