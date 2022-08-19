<?php
	$questionS=surveyQ();
	$answersS=surveyA();
?>
    <main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Welcome to our online shop</h2>
				<p class="col-12 text-center">This is a place for all vintage music lovers that are in a need for a new, fresh, but 
					mostly used vinyls. Vintage is a new era - as we like to say.
				</p>
			</header>
			<div class="tm-container-inner tm-history">
				<div class="row">
					<div class="col-12">
						<div class="tm-history-inner">
							<img src="assets/img/about-06.jpg" alt="Image" class="img-fluid tm-history-img" />
							<div class="tm-history-text"> 
								<h3 class="tm-history-title text-dark">History of our shop? Here since 1987. </h3>
								<p class="tm-mb-p">Our shop goes back in time, since the year when we were established.
									Since that year, so much has changed, but most importantly our quality hasn't. We still have the most valuable 
									and most beautiful vinyls. Did we picked your interest yet?
								</p>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="tm-container-inner tm-features">
				<div class="row">
					<div class="col-lg-4">
						<div class="tm-feature">
							<img src="assets/img/iconBlack.jpg" alt="iconBlack">
							<p>We are well known as a shop who loves old vintage music that brings us in the good old days right away. If you</p>
							<p id="textFade" class="mb-2"> find it interesting as we do, you can check it out in our shop section. </p>
							<p id="showText" class="tm-btn tm-btn-success">Read More</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="tm-feature">
							<img src="assets/img/iconWhite.jpg" alt="iconWhite">
							<p class="tm-feature-description">We have a variety of options to choose from, if you're into old music-we got you. If you're into new music-we got you too. For more - click below for a quick online shop view.</p>
							<a href="index.php?page=shop" class="tm-btn tm-btn-success">Shop now</a>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="tm-feature">
							<img src="assets/img/iconBlack.jpg" alt="iconBlack">
							<p>Our most important thing is our customers, their feedback keeps our shop going - online, as well as</p>
							<p id="textFade2" class="mb-2"> at our address. More about our location click <a href="#address" class="font-weight-bold">here</a>.</p>
							<p id="showText2"class="tm-btn tm-btn-success">Read More</p>
						</div>
					</div>
				</div>
			</div>
			<div class="tm-container-inner tm-featured-image">
				<div class="row">
					<div class="col-12">
						<div class="placeholder-2">
							<div class="parallax-window-2" data-parallax="scroll" data-image-src="assets/img/bgImageTwo.jpg"></div>		
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- anketa -->
		<input type="hidden" id="logedIn" value="<?=$_SESSION['user']->id_user?>">
		<?php
			if(isset($_SESSION['user'])):
		?>
			<div class="row tm-welcome-section">
				<div class="col-md-12 text-center">
				<h4>In a mood for a little survey? Feel free to answer.</h4>
			</div>
		</div>
		<?php
			foreach($questionS as $q):
		?>
		<div>
			<div class="row tm-welcome-section">
				<div class="col-md-12 p-1 text-center">
					<h5><?=$q->question?></h5>
				</div>
				   <?php
					foreach($answersS as $a):
						if($a->idSurvey==$q->idSurvey):
					?>
				<div class="form-check col-md-7 p-2">
					<input class="form-check-input position-static inline survey" type="radio" name="survey?<?=$a->idSurvey?>" id="blankRadio1" value="<?=$a->idAnswer?>" data-id="<?=$a->idSurvey?>"/><?=$a->answer?>
				</div>
				<?php
					endif;
					endforeach;
				?>
				<button type="button" class="btn btn-dark send col-5 pl-5" id="send" data-id="<?=$q->idSurvey?>">Answer</button>
				<?php
					endforeach;
					endif;
				?>
			</div>
		</div>
<!-- kraj ankete -->