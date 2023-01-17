<?php
# This software is developed by laéx. github.com/thislaex
# On this page, you can specify what is displayed about the user after the user logs in.
# It is a software that you can customize according to you.
# Registration and login systems work smoothly.
# Good use :)

# Bu yazılım laéx tarafından geliştirilmiştir. github.com/thislaex
# Bu sayfada, kullanıcı oturum açtıktan sonra kullanıcı hakkında neyin görüntüleneceğini belirleyebilirsiniz.
# Kendinize göre özelleştirebileceğiniz bir yazılımdır.
# Kayıt ve giriş sistemleri sorunsuz çalışmaktadır.
# İyi kullanımlar :)

ob_start();
session_start();
require 'database/config.php'; // Database Config
if (!isset($_SESSION['session'])) {
    
    header('Location:pages/login.php'); #If the user is not logged in, it redirects to the login.php page.
}
$dataL = $db->query("SELECT * FROM users WHERE dbid=".$_SESSION['dbid']."", PDO::FETCH_ASSOC);

foreach ($dataL as $wData) {

}

echo $wData['dbid'];
echo'<br>';
echo $wData['user'];
echo'<br>';
echo $wData['email'];
?>