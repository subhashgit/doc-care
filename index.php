<?php
if (isset($_SESSION['auth'])) {
    header("Location: home");
    exit();
}
else {
require_once 'welcome/index.php';
}
