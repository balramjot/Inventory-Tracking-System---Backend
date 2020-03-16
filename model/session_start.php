<?php
// defining folder path

if (!defined("APP_FOLDER")) define("APP_FOLDER", "/TermProject_CS602_Saini/administrator");
if (!defined("APP_ROOT")) define("APP_ROOT", $_SERVER["DOCUMENT_ROOT"]."".APP_FOLDER);
if (!defined("APP_URL")) define("APP_URL", "http://".$_SERVER["HTTP_HOST"].APP_FOLDER);
if (!defined("APP_FULL_URL")) define("APP_FULL_URL", "http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
?>