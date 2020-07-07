<?php

$config = require "config/config.php";
require "Connection.php";
require "Querybuilder.php";


return new Querybuilder(
    Connection::make($config["database"])
);