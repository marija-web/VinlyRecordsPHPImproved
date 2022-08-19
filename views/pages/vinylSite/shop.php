<?php
	$categories=getAllFromTabel("category");
	$products=returnProductsPag();
?>
<main id="shop">
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title" id="shop">- Welcome to the shopping section -</h2>
				<p class="col-12 text-center">We know we got your attention, now feel free to look around.</p>
			</header>
			<div class="col-12 input-group rounded tm-welcome-section">
				<input type="search" id="search" class="form-control rounded border-bottom" placeholder="Search by artist or an album" aria-label="Search"
				  aria-describedby="search-addon" />
				<span class="input-group-text border-0" id="search-addon">
					<a href="index.php?page=cart" class="text-dark"><i class="fa fa-shopping-cart tm-social-icon" aria-hidden="true"><span id="countCart">0</span></i></a>							
				</span>
			  </div>
			<div class="row tm-welcome-section">
				<!-- kategorije -->
				<div class="col-lg-12 text-center mb-5">
					<!-- padajuca lista -->
					<select class="form-select" aria-label="Default select example" id="ddlListSort">
						<option value="0">Sort by</option>
						<option value="Album name A-Z">Album name A-Z</option>
						<option value="Album name Z-A">Album name Z-A</option>
						<option value="Low to High price">Low to High price</option>
						<option value="High to Low price">High to Low price</option>
					</select>
					<!-- padajuca lista kraj-->
				</div>
				<div class="col-lg-12 text-center" id="radioB">
				<?php
					foreach($categories as $categorie):
				?>
					<div class="form-check form-check-inline">
						<input class="cat" name="cat" type="radio" id="inlineCheckbox1" value="<?=$categorie->id_cat?>">
						<label class="form-check-label" for="inlineCheckbox1"><?=$categorie->name_cat?></label>
				</div>
				<?php
					endforeach;
				?>
				</div>
			</div>
			<!-- galerija -->
				<?php
					if(isset($_SESSION['user'])):
				?>
				<input type="hidden" id="session" value="<?=$_SESSION['user']->id_user?>">
				<?php
					endif;
					if(empty($_SESSION['user'])):
				?>
					<input type="hidden" id="session" value="0"/>
				<?php
					endif;
				?>
			<div class="row tm-gallery">
				<div id="products" class="tm-gallery-page">
					<?php
						if(count($products)==0):
					?>
						<div class="col-12">
                			<div class="alert text-center mt-5">Sorry, we will be back in stock soon with new arrivals.</div>
           				 </div>
					<?php
						endif;
					?>
				<?php
					foreach($products as $product):
				?>
					<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
						<figure>
							<a href="index.php?page=showProduct&id=<?=$product->id_products?>"><img src="assets/img/gallery/smallGallery/Small<?=$product->picture_src?>" alt="<?=$product->name_products?>" class="img-fluid tm-gallery-img"/></a>
							<figcaption>
								<h4 class="tm-gallery-title"><?=$product->name_products?></h4>
								<p>Artist - <?=$product->name_artist?>	</p>
								<p><?=$product->name_cat?></p>
								<hr>
								<?php
									if($product->delivery):
								?>
									<p class="text-secondary">Free delivery</p>
								<?php
								endif;
								?>
								<input type="button" value="Add to cart" class="tm-btn tm-btn-success addToCart"  data-idcart="<?=$product->id_products?>"/>
								<p class="tm-gallery-price">$<?=$product->price_now?> 
								 <?php
									if($product->price_old!=null):
								?>
									$<del><?=$product->price_old?></del>
								<?php
									endif;
								?>
								</p>
							</figcaption>
						</figure>
					</article>
				<?php
				endforeach;
				?>
				</div> 
			<!-- kraj galerije -->
			<div class="row">
           			<div class="col-12 d-flex justify-content-center">
					   <nav aria-label="Page navigation example">
					   <?php
						$numP = returnNumberPages();
						?>
						<ul class="pagination" id="pag">
						<?php
							for($i = 0; $i < $numP; $i++):
						?>
							<li class="page-item"><a class="page-link clickPag" href="#" data-limit="<?=$i?>"><?=($i+1)?></a></li>
						<?php
							endfor;
						?>
						</ul>
						</nav>
					</div>
       			 </div>
			</div>
</main>