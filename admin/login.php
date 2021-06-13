<html>
<head>
    <title>
        AWG|LOGIN
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel = "icon" href = "/AWG/admin/assets/images/logo.png" type = "image">
</head>
<body>
    <div class="container">
    <form action="includes/prosesLogin.php" method="POST">
        <img src="assets/images/logo.png">
        <label>Email</label>
        <input type="text" name="username">

        <label>Password</label>
        <input type="password" name="password">
        <button type="submit" name="login">Login</button>
    </form>    
    </div>
</body>
</html>