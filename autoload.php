<?php

// Autoload function
spl_autoload_register(function ($className) {
    // Convertir les anti-slashes en slashes
    $className = str_replace("\\", "/", $className);

    // Inclure le fichier de classe
    include "$className.php";
});
