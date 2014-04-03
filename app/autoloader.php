<?php
// Autoload Classes
spl_autoload_register(function ($class) {
    require_once 'Classes/' . $class . '.class.php';
});

define(BR, "<br />");
