<?php
session_start();
echo "Logging out you please wait";
session_destroy();
header("Location: /forum");


?>