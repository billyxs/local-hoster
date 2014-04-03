<?php
// Or, using an anonymous function as of PHP 5.3.0
spl_autoload_register(function ($class) {
    include 'Classes/' . $class . '.class.php';
});

define(NL, "<br />");
