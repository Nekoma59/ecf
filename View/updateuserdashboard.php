<?php

include '../Controller/userC.php';

$error = "";

// create user
$user = null;

// create an instance of the controller
$userC = new userC();
if (
    isset($_POST["id"]) &&
    isset($_POST["role"])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST["role"])
    ) {
        $user = new user(
            $_POST['id'],
            $_POST['role']
        );
        $userC->updateuser1($user);
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
                        <ion-icon name="id"></ion-icon>
                        <input type="number" name="id" id="id" required>
                        <label for="id">Search user from ID</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="number" name="role" id="role" required>
                        <label for="role">Role</label>
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
