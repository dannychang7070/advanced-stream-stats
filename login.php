<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In - Advanced Stream Stats</title>
    <!-- Required meta tags always come first -->    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />        
    <link rel="icon" href="img/favicon.ico" sizes="16x16">    
    
    <!-- CSS: External -->
    <!-- Water CSS--><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <!-- CSS: Internal -->
    <!-- general --><link rel="stylesheet" href="css/general.css">
    <!-- login --><link rel="stylesheet" href="css/login.css" type="text/css" media="screen" title="no title" charset="utf-8">    
</head>
<body>
    
    <form method="post">
        <img id="logoImg" class="img-responsive center-block" style="width: 150px" src="img/logo.png">
        <h1>Advanced Stream Stats</h1>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </p>
        <p>
            <button>Log in</button>
        </p>
        <h2>New To Advanced Stream Stats? <a href="signup.html">Sign Up</a></h2>
    </form>

</body>
</html>
