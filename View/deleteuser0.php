<?php
session_start();
include '../Controller/userC.php';
$userC = new userC();
if(isset($_SESSION["user_id"]))
{
    $user_id=$_SESSION["user_id"];
    $userC->deleteuser($user_id);
    include '../logout.php';
}
else
    echo "Missing id";
    /*git remote add origin https://github.com/AnouarJebri/CinephoriaProject.git
git branch -M main
git push -u origin main*/
?>
