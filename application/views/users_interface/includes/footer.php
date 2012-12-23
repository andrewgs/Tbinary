<footer>
	<div class="container">
		<div class="row">
		<?php for($i=0;$i<count($footer['category']);$i++):?>
			<div class="span3 offset1">
				<h4><?=$footer['category'][$i]['title'];?></h4>
				<ul>
			<?php for($j=0;$j<count($footer['pages']);$j++):?>
				<?php if($footer['pages'][$j]['category'] == $footer['category'][$i]['id']):?>
					<li><?=anchor($footer['pages'][$j]['url'],$footer['pages'][$j]['link']);?></li>
				<?php endif;?>
			<?php endfor;?>
				</ul>
			</div>
		<?php endfor;?>
		</div>
	</div>
</footer>