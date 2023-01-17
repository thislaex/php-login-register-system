<?php
# Developed by laéx - github.com/thislaex
require '../languages/function.php'; // Languages function
require '../database/config.php'; // Database Config

if(isset($_SESSION['session'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laéx - <?php echo $lang['login']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<?php
if ($_POST) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query  = $db->query("SELECT * FROM users WHERE email='$email' && password='$password'", PDO::FETCH_ASSOC);
    $veriCek = $query->fetch(PDO::FETCH_ASSOC);
    $say = $query->rowCount();
    if ($say > 0) {
        session_start();
        $_SESSION['session'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION["dbid"] = $veriCek["dbid"];
        header('Location: ../index.php');
    } else {?>
       <center><h2><?php echo $lang['wrong']; ?><h2></center>
    <?php
    }
}
?>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center ">
        <div class="col-md-5 p-5 shadow-sm border rounded-5 border-primary bg-white">
            <a class="languagesSec" href="?languages=tr">TR</a>
            <a class="languagesSec" href="?languages=en">EN</a>
            <h2 class="text-center mb-4 text-primary">Laex <?php echo $lang['login']; ?></h2>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['email']; ?></label>
                    <input type="email" name="email" class="form-control border border-primary" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><?php echo $lang['password']; ?></label>
                    <input type="password" name="password" class="form-control border border-primary">
                </div>
                <p class="small"><a class="text-primary" href="#"><?php echo $lang['fargot']; ?></a></p>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit"><?php echo $lang['login']; ?></button>
                </div>
            </form>
            <div class="mt-3">
                <p class="mb-0  text-center"><?php echo $lang['no-account']; ?> <a href="register.php" class="text-primary fw-bold"><?php echo $lang['register']; ?></a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>