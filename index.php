<?php
ini_set('session.save_path','session');
require("config/database.php");
require("config/path.php");

require("libs/Bootloader.php");
require("libs/Controller.php");
require("libs/Database.php");
require("libs/Model.php");
require("libs/Session.php");
require("libs/View.php");


$app = new Bootloader();