<?php
include '../Controller/userC.php';
$userC = new userC();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $userC->deleteuser($_POST["id"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../login.css">
  <title>Delete user</title>
</head>
<body>
    
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Delete</h2>

                    <div class="inputbox">
                        <ion-icon name="id"></ion-icon>
                        <input type="number" name="id" id="id" required>
                        <label for="id">Delete user from ID</label>
                    </div>

                    <button type="submit" name="delete">Delete</button>
                    
                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>