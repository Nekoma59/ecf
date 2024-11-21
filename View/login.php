<?php
session_start(); // start the session

require_once('../Controller/Config.php'); // include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if the form is submitted
    
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    
    $db = config::getConnexion(); // get the database connection
    
    $stmt = $db->prepare("SELECT * FROM user WHERE email = :email"); // prepare the SQL query
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // get the user record
    
    if ($user) { // if user exists
        
       // $hashed_password = hash('sha256', $password); // hash the password
        
        if ($password == $user['mdp']) { // if password matches
            
            $_SESSION['user_id'] = $user['id']; // set the user id in the session
            
            if ($user['role'] == 1) { // if user is an admin
                header('Location: backuser.php'); // redirect to backend page
                exit();
            } else {
                header('Location: ../_index.php'); // redirect to index page
                exit();
            }
        } else {
            echo "Invalid password";
        }
        
    } else {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../login.css">
  <title>login  Cinephoria</title>
</head>
<body>
    
    <section >
        <div class="form-box">
            <div class="form-value">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2>Login</h2>
                    
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="mdp" name="mdp"required>
                        <label for="mdp">Password</label>
                    </div>
                    
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me  <a href="#">Forget Password</a></label>
                      
                    </div>
                   
                    <button type="submit" name="login">Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="signing.php">Signin</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
