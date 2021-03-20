<?php
$url = parse_url($_SERVER['HTTP_REFERER']);
$host = $url['host'];
echo($host);
?>