<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = $_POST['token'];
  if ($token != $_SESSION['token'] || empty($_POST['captcha'])) {
    // CAPTCHA failed, show an error message
    echo '<script type="text/javascript">';
    echo 'alert("You must check to prove you are human");';
    echo '</script>';
  } else {
    // CAPTCHA passed, process the login
    header('Location: login.php');
    exit();
    session_destroy(); // Destroy the session to prevent going back to captcha.php
  }
} else {

  $token = md5(uniqid(rand(), true));
  $_SESSION['token'] = $token;
}
?>
<style>
    .submit {
       background-color: white; 
       color: rgb(0, 173, 173);
       border-radius: 10px;
       border-width: 1px;
       height: 32px;
       border-color: aquamarine;
       border-style: solid;
       cursor: pointer;
       margin-right: 8px;
    }
    .submit:hover{
        background-color: blue;
        color: white;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
</style>

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
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="inputbox">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    </div>
    <style>
        label {
        color: white;
    }
    </style>
    <label>
      <input type="checkbox" name="captcha" value="1">
      Check this box to prove you're human.
      <span class="checkmark"></span>
    </label>
    <button type="submit" class="submit">Submit</button>
  </form>
  </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
  <style>
    label {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 18px;
      user-select: none;
    }

    label input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }

    label:hover input ~ .checkmark {
      background-color: #ccc;
    }

    label input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    label input:checked ~ .checkmark:after {
      display: block;
    }

    label .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      transform: rotate(45deg);
    }
  </style>
</div>
