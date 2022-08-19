<?php
    if(isset($_GET['click'])){
            require_once $_SERVER['DOCUMENT_ROOT']."/praktikumSajt/modals/functions.php";
            $artist=getAllFromTabel("artist");
            $excel="";
                
            if(count($artist)>0){
                $excel.='<table class="table"> 
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name artist</th>
                  </tr>
                </thead>
                <tbody>';
                    foreach($artist as $a){
                        $excel.='<tr>
                            <td>'.$a->id_artist.'</td>
                            <td>'.$a->name_artist.'</td>
                        </tr>';
                    }
              $excel.='</tbody>
              </table>';
            }
    
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=artistExcel.xls");
            echo $excel;
        }
        
    else{
        header("location: ../404Page.php?notFound");
        $code=404;
        $msg="Page not found.";
    }
?>