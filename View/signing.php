<?php

include_once '../Controller/Config.php';
include '../Model/user.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $role=0;
    try{
        $db = config::getConnexion();
        $stmt = $db->prepare("INSERT INTO user (prenom, nom, email, mdp, role) VALUES (:prenom, :nom, :email, :mdp, :role)");
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mdp', $mdp);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $user_id = $db->lastInsertId();
        $user=new user($user_id, $nom, $prenom, $email, $mdp,$role);
        header("Location: login.php");
        exit();
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../login.css">
  <title>Signin Cinephoria</title>
</head>
<body>
    
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Register</h2>
                    

                    <div class="inputbox">
                        <ion-icon name="person"></ion-icon>
                        <input type="text" name="prenom" id="prenom" required>
                        <label for="prenom">First name</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="person"></ion-icon>
                        <input type="text" name="nom" id="nom" required>
                        <label for="nom">Last name</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" id="email" required>
                        <label for="email">Email</label>
                    </div>

                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="mdp" id="mdp" required>
                        <label for="mdp">Password</label>
                    </div>
                    
                    <button type="submit" name="submit">Signin</button>
                    
                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
