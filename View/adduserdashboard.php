<?php 


include '../Controller/userC.php';
require_once '../model/user.php';

$FilmC = new FilmC();
$categC= new CategorieC();
$listcateg = $categC->AfficherCategorie();

if (isset($_REQUEST['retour'])) {
  header('Location:backfilm.php');
}

if (isset($_REQUEST['add'])) {
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
      // echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      // echo "File is not an image.";
     // $uploadOk = 0;
  }


  // Check if file already exists
  if (file_exists($target_file)) {
      //  echo "Sorry, file already exists.";
     // $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      //  echo "Sorry, your file is too large.";
     // $uploadOk = 0;
  }

  // Allow certain file formats
  if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
  ) {
      //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //  $uploadOk = 0;
  }
  if ($uploadOk == 0) {
      header('Location:blank.php?error=1');
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //echo 'aaaaaa';
         
          $FilmC = new FilmC();
          if (isset($_REQUEST['add'])) {
            $FilmC = new FilmC();
          $Now = new DateTime('now', new DateTimeZone('Europe/Paris'));
          $date = new DateTime($_POST['horraire']);
            $film = new Film(1, $_POST['titre'],$_POST['description'],$_POST['year'],$target_file,$_POST['bande_annonce'],$_POST['auteur'],$_POST['acteurs'],$Now,$date,$_POST['prix'],$_POST['categorie'] );
            $FilmC->AjouterFilm($film);
            
           
            header('Location:backfilm.php');
          } 
         
      } else {
          echo 'error';
          //header('Location:blank.php');
      }
    
    }}

?> 



<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="container">
    <div class="title">Ajouter Film</div>
  <form enctype="multipart/form-data" method="POST" class="form-horizontal form-material">
  <div class="user-details">
  <div class="input-box">
    <span class="details">Titre</span>
    
      <input name="titre" type="text" placeholder="Titre du film" >
    </div>
    <div class="input-box">
    <span class="details">Description</span>
      <textarea rows="5" type="text" placeholder="Description du film" name="description"></textarea>
    </div>
    <div class="input-box">
    <span class="details">Auteur</span>
      <input id="auteur"name="auteur" type="text" placeholder="Auteur du film" >
    </div>
    <div class="input-box">
    <span class="details">Acteurs</span>
      <input id="acteurs"name="acteurs" type="text" placeholder="Acteurs du film" >
    </div>
    <div class="input-box">
    <span class="details">Annee</span>
      <select name="year" class="form-select shadow-none form-control-line">
        <?php
         $currentYear = date("Y");
         for ($i = 1900; $i <= $currentYear; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
         }
        ?>
      </select>
    </div>
    <div class="input-box">
    <span class="details">Prix</span>
      <input id="prix" name="prix" type="text" placeholder="Prix du film">
    </div>
    <div class="input-box">
    <span class="details">Categorie</span>
      <select name="categorie" class="form-select shadow-none form-control-line">
        <?php foreach($listcateg as $key)
        {?>
        <option><?php echo $key['nom'];?></option>
      
      
      <?php }
      ?>
      </select>
    </div>
    <div class="input-box">
    <span class="details">Horraire de diffusion</span>
      <input type="datetime-local" name="horraire">
    </div>
    <div class="input-box">                                   
    <span class="details">Image du film</span>
      <input required type="file"  id="fileToUpload" name="fileToUpload">
          </div>
          <div class="input-box">  
          <span class="details">Bande Annonce</span>
              <input name="bande_annonce" type="text" placeholder="Lien youtube du bande annonce ....">
          </div>
      
          <div class="button">

              <input id="submit-btn" type="submit" value="ajouter" name="add" >
          </div>
      
        </div>
  </form>
  <form>
  <div class="button">
  
  <input  type="submit" name="retour" class="boutonC"  value="Retour" >
        </div>
        </form>
                                </div>
                               
                                </body>
</html>
<script>
                     var submitBtn = document.getElementById('submit-btn');


// add event listener to the submit button
submitBtn.addEventListener('click', function(event) {
  // get the input field
  var input = document.getElementById('auteur');
  // get the input value
  var value = input.value;


  // check if the input contains only letters
  if (/^[a-zA-Z]+$/.test(value)) {
    // input is valid, allow the form to submit
  } else {
    // input contains non-letter characters, prevent the form from submitting
    event.preventDefault();
    // display error message next to the input field
    var errorMsg = document.createElement('span');
    errorMsg.innerText = 'Le champ auteur ne doit contenir que des lettres.';
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  }
});
</script>
<script>
                     var submitBtn = document.getElementById('submit-btn');


// add event listener to the submit button
submitBtn.addEventListener('click', function(event) {
  // get the input field
  var input = document.getElementById('acteurs');
  // get the input value
  var value = input.value;


  // check if the input contains only letters
  if (/^[a-zA-Z]+$/.test(value)) {
    // input is valid, allow the form to submit
  } else {
    // input contains non-letter characters, prevent the form from submitting
    event.preventDefault();
    // display error message next to the input field
    var errorMsg = document.createElement('span');
    errorMsg.innerText = 'Le champ acteurs ne doit contenir que des lettres.';
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  }
});
</script>





<script>
var submitBtn = document.getElementById('submit-btn');

// add event listener to the submit button
submitBtn.addEventListener('click', function(event) {
  // get the input field
  var input = document.getElementById('prix');
  // get the input value
  var value = input.value;

  // check if the input contains only numbers
  if (/^\d+$/.test(value)) {
    // input is valid, allow the form to submit
  } else {
    // input contains non-number characters, prevent the form from submitting
event.preventDefault();
    // display error message next to the input field
    var errorMsg = document.createElement('span');
    errorMsg.innerText = 'Le prix du film ne doit contenir que des chiffres.';
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  }
});
</script>

	<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  height: 190vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: linear-gradient(135deg, #290404, #2e0606);
}
.container{
  max-width: 700px;
  width: 500%;
  background-color: #fff;
  padding: 25px 80px;
  border-radius: 10px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
  overflow: auto;
}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, #460808, #3b0505);
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #9b59b6;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: #330303;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 30%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(135deg, #2b0505, #310606);
 }
 form .button input:hover{
  /* transform: scale(0.99); */
  background: linear-gradient(-135deg, #440505, #410606);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}

</style>