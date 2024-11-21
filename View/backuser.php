<?php 

session_start();

include '../Controller/userC.php';

require_once '../model/user.php';


if(isset($_SESSION["user_id"]))
    $user_id=$_SESSION["user_id"];
else
    header('location: login.php');

$userC = new userC();
$listuser = $userC->showalluser();
?>


<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/back2.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
		body {
			overflow: auto;
		}
	</style>

<body>
	
	<div id="mySidenav" class="sidenav">
	<p class="logo"><span>C</span>inephoria</p>
  <a href="backevent.html" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Gestion evenement</a>
  <!--<a href="backfilm.php"class="icon-a"><i class="fa fa-film icons"></i> &nbsp;&nbsp;Gestion film</a>
  
            <a href="addfilm.php">
              <i class="bi bi-circle"></i><span>Ajouter Film</span>
            </a>
            <a href="backfilm.php">
              <i class="bi bi-circle"></i><span>Afficher Film</span>
            </a>
            <a href="addcateg.php">
              <i class="bi bi-circle"></i><span>Ajouter Categorie</span>
            </a>
            <a href="listcateg.php">
              <i class="bi bi-circle"></i><span>Afficher Categorie</span>
            </a>-->
         
  <a href="backuser.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Gestion utilisateurs</a>
            <a href="updateuserdashboard.php">
              <i class="bi bi-circle"></i><span>Modifier utilisateurs</span>
            </a>
            <a href="deleteuser.php">
              <i class="bi bi-circle"></i><span>Supprimer utilisateurs</span>
            </a>
  <a href="backreview.html"class="icon-a"><i class="fa fa-comment icons"></i> &nbsp;&nbsp;Gestion review</a>
  <a href="backbasket.html"class="icon-a"><i class="fa fa-shopping-bag icons"></i> &nbsp;&nbsp;Gestion basket</a>
  <a href="backbasket.html"class="icon-a"><i class="fa fa-film icons"></i> &nbsp;&nbsp; movie room</a>
  <a href="../logout.php" class="icon-a"><i class="fa fa-sign-out"></i> &nbsp;&nbsp; Log out</a>
  

</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Gestion utilisateurs</span>
<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776;Gestion utilisateurs </span>
</div>
	
	<div class="col-div-6">
	<div class="profile">

	
	</div>
</div>

	<div class="clearfix"></div>
	<br/><br/>
	<div class="col-div-8">
  
			<h1  style="color:white">Liste Des utilisateurs </h1>
			
			<table>
  <tr>
    <th style="color:#8B0000 ">Nom</th> 
    <th style="color:#8B0000 ">Prenom</th> 
    <th style="color:#8B0000 "> Email</th> 
  </tr>
  <?php foreach($listuser as $key)
  {
    ?>
  <tr>
    <td><?php echo $key['nom']; ?></td>
    <td><?php echo $key['prenom']; ?></td>
    <td><?php echo $key['email']; ?></td>
 
  </tr>
  
 <?php } 
 ?>
  
  
</table>
	
			
	</div>
	</div>
</div>
	
		</div>
	</div>
	</div>
		
	<div class="clearfix"></div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(".nav").click(function(){
    $("#mySidenav").css('width','70px');
    $("#main").css('margin-left','70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
     $(".logo span").css('margin-left', '-10px');
     $(".icon-a").css('visibility', 'hidden');
     $(".icons").css('visibility', 'visible');
     $(".icons").css('margin-left', '-8px');
      $(".nav").css('display','none');
      $(".nav2").css('display','block');
  });

$(".nav2").click(function(){
    $("#mySidenav").css('width','300px');
    $("#main").css('margin-left','300px');
    $(".logo").css('visibility', 'visible');
     $(".icon-a").css('visibility', 'visible');
     $(".icons").css('visibility', 'visible');
     $(".nav").css('display','block');
      $(".nav2").css('display','none');
 });

</script>

</body>


</html>