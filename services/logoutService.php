<?php
require_once "authService.php";
$authService = new AuthService();
$authService->destroySession();
?>
