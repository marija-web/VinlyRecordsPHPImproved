<?php
	include_once "modals/vinylSite/menu.php";
?>

<div class="container">
	<!-- Top box -->
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="assets/img/bgImage.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							<div class="tm-site-text-box">
								<a href="index.php?page=mainPage"><h1 class="tm-site-title">Vinyl Records</h1></a>
								<h6 class="tm-site-description">shop new/old vinyls now</h6>
							</div>
						</div>
						<nav class="col-md-6 col-12 tm-nav">
							<ul class="tm-nav-ul">
								<?php
									foreach($menuResult as $m):
								?>
									<li class="tm-nav-li"><a href="index.php?page=<?=$m->href_menu?>" class="tm-nav-link"><?=$m->name_menu?></a></li>
								<?php
									endforeach;
								?>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>