<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
?>