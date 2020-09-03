<?php
    if($_COOKIE['userName']) {
        header('Location: Contact-entry.php');
    } else {
        header('Location: Contact-pre.html');
    }
?>