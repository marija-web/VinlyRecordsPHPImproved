<?php
    if(!isset($_SESSION['user'])){
      header("location: modals/404Page.php?notFound");
    }
    else if($_SESSION['idRole']!=1){
      header("location: modals/404Page.php?notFound");
    }
   else{
   $messages=messagesReturn();
   $questions=getAllFromTabel("survey");
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
            <p class="navbar-brand">Messages and Survey</p>
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
        <div class="row">
          <div class="col-md-12">
            <h3>Messages from users to you</h3>
          <div id="messages">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Message</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $rb=1;
                foreach($messages as $message):
              ?>
                <tr>
                  <th scope="row"><?=$rb?></th>
                  <td><?=$message->name_user?></td>
                  <td><?=$message->lastname_user?></td>
                  <td><?=$message->email_user?></td>
                  <td><?=$message->message_user?></td>
                  <td><a href="#" data-id="<?=$message->id_msg?>" class="idDelete">Delete</a></td>
                </tr>
              <?php
                $rb++;
                endforeach;
              ?>
                </tbody>
            </table>
           </div>
          </div>
        </div>
      
      <!-- anketa -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <table class="table">
            <h3>Survey statistics</h3>
              <tbody>
                <?php
                $rb=1;
                  foreach($questions as $q):
                  $catchAnswer=catchAnswer($q->idSurvey);
                ?>
                  <tr>
                  <td><input type="checkbox" class="activ" id="chb<?=$q->idSurvey?>" value="<?=$q->idSurvey?>"></td><td><?=$rb?></td>
                  <td><?=$q->question?></td>
                  <?php
                      foreach($catchAnswer as $c):
                      $countAll=countAll($c->idAnswer);
                      // var_dump($countAll);
                  ?>
                    <td><?=$c->answer?></td>
                    <?php
                      if($countAll==false){
                        echo "<td>0%</td>";
                      }
                      else{
                        echo "<td>".$countAll->numb."%</td>";
                      }
                      ?>
                  <?php
                    endforeach;
                  ?>
                </tr>
                <?php
                $rb++;
                  endforeach;
                ?>
              </tbody>
      </table>  
		  </div>
      </div>
      <!-- kraj anket -->
      </div>
    </div>
  </div>
<?php
  }
?>
