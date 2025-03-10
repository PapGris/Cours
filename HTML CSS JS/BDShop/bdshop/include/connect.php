<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=bdshop;charset=utf8", "root", "");
} catch (Exception $e) {
    die ($e->getMessage());
}

?>