<?php
session_start();
session_destroy();
header('Location: landingPageView.php');
exit;
