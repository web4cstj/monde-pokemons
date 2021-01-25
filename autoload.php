<?php
spl_autoload_register(function ($nomClasse) {
    include_once __DIR__."/app/".$nomClasse.".php";
});
?>