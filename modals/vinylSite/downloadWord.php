<?php
    if(isset($_GET['click2'])){
        
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=authorInfo.doc");
        $infoName="Marija Vucicevic 18/19";
        $infoCollege="Visoka ICT Skola - IT - Web Programiranje";
        echo "<html>";
        echo "<meta http-equiv=\"ContentType\"text/html; charset=Windows-1252\">";
        echo "<body>";
        echo "<h5> Student: $infoName </h5>";
        echo "<h5> Skola: $infoCollege </h5>";
        echo "</body>";
    }
    else{
        header("location: ../404Page.php?notFound");
        $code=404;
        $msg="Page not found.";
    }
?>