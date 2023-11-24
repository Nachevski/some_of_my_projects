<?php
session_start();

$_SESSION['loggedAdmin'] = null;
header('LOCATION:../../index.php');
