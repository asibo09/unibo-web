<?php
require_once 'bootstrap.php';

$result["logineseguito"] = false;

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $result["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $result["logineseguito"] = true;
    $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
    for ($i=0; $i < count($result["articoli"]); $i++) { 
    $articoli["articoli"][$i]["imgarticolo"] = UPLOAD_DIR.$result["articoli"][$i]["imgarticolo"];
}
}

header('Content-Type: application/json');
echo json_encode($result);
?>