<div id="main" role="main">	
	<div id="ribbon">	
		<ol class="breadcrumb">
			<?php
				foreach ($breadcrumbs as $display => $url) {
					$breadcrumb = $url != "" ? '<a href="/">'.$display.'</a>' : $display;
					echo '<li>'.$breadcrumb.'</li>';
				}
				echo '<li>'.$page_title.'</li>';
			?>
		</ol>
		<div class="pull-right">
			<div id="hide-menu" class="btn-header pull-right">
				<span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
			</div>
		</div>							

	</div>	