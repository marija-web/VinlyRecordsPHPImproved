<?php
    if(!isset($_SESSION['user'])){
      header("location: ../modals/404Page.php?notFound");
    }
    else if($_SESSION['idRole']!=1){
      header("location: ../modals/404Page.php?notFound");
    }
    else{
      $artist=getAllFromTabel("artist");
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
      <!-- update i delete -->
      <div class="col-md-12">   
        <h3>Artist</h3>
        <div id="artist">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_artist</th>
                  <th scope="col">name_artist</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($artist as $a):
              ?>
                <tr>
                  <th scope="row"><?=$a->id_artist?></th>
                  <td><input type="text" id="nameArtist<?=$a->id_artist?>" class="form-control" value="<?=$a->name_artist?>"></td>
                  <td><a href="#" data-id="<?=$a->id_artist?>" class="updateArtist">Update</a></td>
                  <td><a href="#" data-id="<?=$a->id_artist?>" class="deleteArtist">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
            <a href="modals/adminPanel/downloadExcel.php?click">Download Artists in Excel format</a>
          </div>
          </div>
		    </div>
      <!-- kraj update i delete -->
      <!-- insert -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <table class="table">
            <h3>Insert artist</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameArtist" class="form-control" placeholder="Enter name"></td>
                  <td><a href="#" id="insertArtist">Insert</a></td>
                </tr>
              </tbody>
      </table>  
		  </div>
      </div>
      <!-- kraj inserta -->
		</div>
    </div>
<?php
  }
?>
