<?php
require("../backend/server.php"); // Connect to database
$pageTitle = "POS";
$activePage = "pos";

include '../components/header.php';

include 'aside.php';

include '../components/POS.php';

include '../components/footer.php';
?>