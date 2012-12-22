<div class="navbar">
	<div class="navbar-inner">
		<a data-placement="bottom" href="#InsertLang" role="button tooltip" class="brand ttObject" data-toggle="modal" data-original-title="Click the button to add a language">Add language</a>
		<ul class="nav" role="navigation">
		<?php for($i=0;$i<count($langs);$i++):?>
			<li class="dropdown">
				<a id="drop<?=$i?>" class="dropdown-toggle" data-toggle="dropdown" role="button" href="#"><?=strtoupper($langs[$i]['name']);?> <b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop<?=$i?>" role="menu">
				<?php for($j=0;$j<count($langs_pages);$j++):?>
					<?php if($langs[$i]['id'] == $langs_pages[$j]['language']):?>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/'.$langs_pages[$j]['id'],'<i class="icon-edit"></i> '.$langs_pages[$j]['link'],array('tabindex'=>'-1'));?></li>
					<?php endif;?>
				<?php endfor;?>
					<li><hr/><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/new-page','<i class="icon-plus-sign"></i> New page');?></li>
				</ul>
			</li>
		<?php endfor;?>
		</ul>
	</div>
</div>