<?php
    if(!isset($_SESSION['user'])){
      header("location: ../modals/404Page.php?notFound");
    }
    else if($_SESSION['idRole']!=1){
      header("location: ../modals/404Page.php?notFound");
    }
    else{
      $log=getFromFile("log.txt");
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
            <p class="navbar-brand">Log-page marking</p>
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
      <!-- log -->
      <div class="col-md-12">   
        <h3>Log</h3>
        <div id="log">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Url Address</th>
                  <th scope="col">Ip Address</th>
                  <th scope="col">Date&Time</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($log as $index=>$value):
                  @list($url, $ip, $date)=explode("__", $value); 
              ?>
                <tr>
                  <th scope="row"><?=$index?></th>
                  <td><?=$url?></td>
                  <td><?=$ip?></td>
                  <td><?=$date?></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- log -->
		</div>
    </div>
<?php
  }
?>
