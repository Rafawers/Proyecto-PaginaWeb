<?php

    session_start();
    session_destroy();
    header("location: /Beach/Login.php");

?>