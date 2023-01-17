<?php
# Developed by laéx - github.com/thislaex

# Start Session
ob_start();
session_start();
# if language is selected
if(@$_GET['languages']) {
   # assign language selection to session.
   $_SESSION['languages'] = $_GET['languages'];
   # redirect to home page
   // header("Location:register.php"); #Don't activate the redirect!
}
# Checking the selected language
if (@$_SESSION['languages'] == "en") {
   $languages = "en";
}
elseif (@$_SESSION['languages'] == "tr") {
   $languages = "tr";
}
else {
   # If languages ​​are not selected, we choose browser languages ​​as the default language.
   $languages = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
}
# include our languages ​​file
include '../languages/'.$languages.'.php';
?>