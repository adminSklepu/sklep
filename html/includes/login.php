<?php
$login = $_SESSION['user'];
$isAdmin = false;
if (!empty($login)) {
    $db = $registry->db;
    echo 'Witaj <b>' . $login . '</b>';
    $isAdmin = $db::isUserInRole($login, 'admin');
    if ($isAdmin) {
        echo '(admin) |';
    }
    ?> 
    <a href="/<?= APP_ROOT ?>/account/logout">Logout</a>
    <?php
} else {
    ?>
    <a href="/<?= APP_ROOT ?>/account/login">Sign in</a> &nbsp; |  	
    <a href="/<?= APP_ROOT ?>/account/register">Sign up</a>
    <?php
}
?>