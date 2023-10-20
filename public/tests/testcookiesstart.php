<?php
    setcookie("test_start", "1", [
        'expires' => time() + 86400,
        'path' => '/',
        'samesite' => 'none'
    ]);

    setcookie("test_current", "0", [
        'expires' => time() + 86400,
        'path' => '/',
        'samesite' => 'none'
    ]);
?>