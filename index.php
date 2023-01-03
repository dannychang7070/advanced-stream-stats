<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Advanced Stream Stats</title>
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

    <!-- JS: External -->
    <!-- Drop-in JS--><script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>

</head>
<body>
    
    <h1>Home</h1>
    
    <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        
        <p><a href="logout.php">Log out</a></p>
        <!-- Step one: add an empty container to your page -->
        <div id="dropin-container"></div>

        <?php
            $gateway = new Braintree\Gateway([
                'environment' => 'sandbox',
                'merchantId' => '2yz45ftmxxrm4w9s',
                'publicKey' => 'k4fwkrzqhgwr6546',
                'privateKey' => '04b49aa8ad1330f83c3a40559a1dcb84'
            ]);
        ?>
        <script type="text/javascript">
        // call `braintree.dropin.create` code here
        // Step two: create a dropin instance using that container (or a string
        //   that functions as a query selector such as `#dropin-container`)
        braintree.dropin.create({
          container: document.getElementById('dropin-container'),
          // ...plus remaining configuration
        }, (error, dropinInstance) => {
          // Use `dropinInstance` here
          // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
        });
        braintree.dropin.create({
          // Step three: get client token from your server, such as via
         //    templates or async http request
          authorization: CLIENT_TOKEN_FROM_SERVER,
          container: '#dropin-container'
        }, (error, dropinInstance) => {
          // Use `dropinInstance` here
          // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
        });        
        </script>

    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        
    <?php endif; ?>
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    