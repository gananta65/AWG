<html>
<head>
    <title>
        AWG - Login
    </title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel = "icon" href = "/AWG/admin/assets/images/logo.png" type = "image">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="login.php"><img src="assets/images/logo.png"></a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-outline card-primary">
                    <div class="card-body" style="width: 100% !important">
                        <form action="includes/prosesLogin.php" method="POST">
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control">
                            </div>

                            <label>Password</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>