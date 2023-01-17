<?php
# Developed by laéx - github.com/thislaex
require '../languages/function.php'; // Languages function
require '../database/config.php'; // Database Config


if (isset($_SESSION['session'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laéx - <?php echo $lang['register']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<?php
if ($_POST) {
    # Is username used? We question this.
    $userCheck = $db->prepare('SELECT * FROM users WHERE user = :user');
    $userCheck->execute([
        'user' => $_POST['user']
    ]);
    # Email check.
    $emailCheck = $db->prepare('SELECT * FROM users WHERE email = :email');
    $emailCheck->execute([
        'email' => $_POST['email']
    ]);
    if ($emailCheck) {
        if ($emailCheck->rowCount() > 0) { ?>
            <div class="alert alert-danger"><?php echo $lang['email-wrong']; ?></div>
            <?php } else {

            if ($userCheck) {
                if ($userCheck->rowCount() > 0) { ?>
                    <div class="alert alert-danger"><?php echo $lang['user-wrong']; ?></div>
                <?php } else {
                    $user = $_POST['user']; // Username
                    $email = $_POST['email']; // Email
                    $password = md5($_POST['password']); // Password

                    $sql  = "INSERT INTO users (user, email, password)VALUES(?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    // $sayfabakankarakter = $stmt->fetch();
                    $stmt->execute(array(
                        $user,
                        $email,
                        $password
                    )); ?>
                    <center>
                        <h2><?php echo $lang['account-created']; ?><h2>
                    </center>
<?php
                }
            }
        }
    }
}
?>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center ">
        <div class="col-md-5 p-5 shadow-sm border rounded-5 border-primary bg-white">
            <a class="languagesSec" href="?languages=tr">TR</a>
            <a class="languagesSec" href="?languages=en">EN</a>
            <h2 class="text-center mb-4 text-primary">Laex <?php echo $lang['register']; ?></h2>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['user']; ?></label>
                    <input class="form-control border border-primary" name="user" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['email']; ?></label>
                    <input type="email" name="email" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><?php echo $lang['password']; ?></label>
                    <input type="password" name="password" class="form-control border border-primary" id="exampleInputPassword1">
                </div>
                <p class="small"><a class="text-primary" href="#"><?php echo $lang['fargot']; ?></a></p>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit"><?php echo $lang['register']; ?></button>
                </div>
            </form>
            <div class="mt-3">
                <p class="mb-0  text-center"><?php echo $lang['account']; ?> <a href="login.php" class="text-primary fw-bold"><?php echo $lang['login']; ?></a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>