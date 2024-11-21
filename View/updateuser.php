<?php

include '../Controller/userC.php';

$error = "";

// create user
$user = null;

// create an instance of the controller
$userC = new userC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])
    ) {
        $db = config::getConnexion();
        $query = "SELECT id FROM user WHERE email= :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->execute();

        // Fetch the value from the result set
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $iduser = $row['id'];
        $user = new user(
            $iduser,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp']
        );
        $userC->updateuser($user);
    } else
        $error = "Missing information";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../login.css">
  <title>Update user</title>
</head>
<body>
    
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Update</h2>

                    <div class="inputbox">
                        <ion-icon name="nom"></ion-icon>
                        <input type="text" name="nom" id="nom" required>
                        <label for="nom">Nom</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="text" name="prenom" id="prenom" required>
                        <label for="prenom">Prenom</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="text" name="email" id="email" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="mdp" id="mdp" required>
                        <label for="mdp">Password</label>
                    </div>

                    <button type="submit" name="update">Update</button>
                    
                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
