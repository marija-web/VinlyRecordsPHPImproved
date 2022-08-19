<?php
    if(!isset($_SESSION['user'])){
    header('location: modals/404Page.php?notLogedIn');
    }
    else{	
?>
	<input type="hidden" id="cartUser" value="<?=$_SESSION['user']->id_user?>">
	<div class="container table-responsive-sm">
		<div class="col-12">
            <h2 class="my-5 tm-section-title text-center">-Here are the albums you choose-</h2>
			<h4 id="cartEmpty" class="alert text-center mt-5"></h4>
        </div>
		<!-- ispis tabele -->
		<div id="cartWrite">
		<!-- ispis tabele kraj -->
		</div>
	</div>
<?php
}
?>