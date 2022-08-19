<?php
    if(!isset($_SESSION['user'])){
      header("location: ../modals/404Page.php?notFound");
    }
    else if($_SESSION['idRole']!=1){
      header("location: ../modals/404Page.php?notFound");
    }
    else{
      $price=priceProduct();
?>
  <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <p class="navbar-brand">Artist Table</p>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
        </div>
      </nav>
       <!-- End Navbar -->
    <div class="content">
        <div class="container">
            <div class="row">
      <!-- update-->
      <div class="col-md-12">   
        <h3>Price</h3>
        <div id="price">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_price</th>
                  <th scope="col">name_product</th>
                  <th scope="col">price_old</th>
                  <th scope="col">price_now</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($price as $p):
              ?>
                <tr>
                  <th scope="row"><?=$p->id_price?></th>
                  <td><input type="text" id="nameProducts<?=$p->id_price?>" class="form-control" value="<?=$p->name_products?>" disabled></td>
                  <td><input type="number" id="priceOld<?=$p->id_price?>" class="form-control" value="<?=$p->price_old?>"></td>
                  <td><input type="number" id="priceNow<?=$p->id_price?>" class="form-control" value="<?=$p->price_now?>"></td>
                  <td><a href="#" data-id="<?=$p->id_price?>" class="updatePrice">Update</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- kraj update-->
		</div>
    </div>
<?php
  }
?>
