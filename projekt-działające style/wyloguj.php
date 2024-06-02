<?php
session_start();
if(isset($_SESSION['logged_in']) & $_SESSION['logged_in']==true){
    $_SESSION['logged_in']=false;
    session_abort();
    header("Location: logowanie.php");
    exit();
}else{
    session_abort();
    header("Location: logowanie.php");
    exit();
}
#Mam nadzieje ze podoba sie Pani moj projekt!
?>