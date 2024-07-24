<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../images/unsrat.png">
	<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("../images/bglogin2.png");
            background-size: cover;
            background-position: center;
        }


        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .gambar img {
            width: 300px;
            height: 150px;
            margin-bottom: 0px;
        }

        .gambar h2 {
            font-size: 16px;
            margin: 0;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            padding-right: 40px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group i {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
        }

        .log-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .log-btn:hover {
            background-color: #0056b3;
        }

        .alert {
            color: red;
            display: none;
            margin-bottom: 15px;
        }

        .link {
            display: block;
            margin-top: 10px;
            font-size: 12px;
            color: #007bff;
            text-decoration: none;
            text-align: right;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="background">
    <div class="card">
        <div class="gambar">
        <img src="/AMI-1/images/logologin1.png" alt="Logo Unsrat">
            <!-- <h2>Audit Mutu Internal</h2> -->
        </div>
        <form method="post" name="login" action="../koneksi/cek_login.php">
            <div class="login-form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <i class="fa fa-user"></i>
                </div>

                <div class="form-group log-status">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <i class="fa fa-lock"></i>
                    <a class="link" href="register.php">Registrasi</a>
                </div>

                <span class="alert">Invalid Credentials</span>

                <input type="submit" class="log-btn" name="submit" value="Login">
            </div>
        </form>
    </div>
</div>

<script src="js/index.js"></script>

</body>
</html>



<script src="js/index.js"></script>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
$(window).load(function() {
 $(".loading").fadeOut("slow");
});
</script>
</body>
</html>