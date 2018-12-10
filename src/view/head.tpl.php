<!DOCTYPE html>
<html lang="<?= $siteConfig->getParam("lang")?>">
<head>
    <title><?= $siteConfig->getParam("title")?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=f::sanitezeUrl(PUBLICURL."/vendor/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?=f::sanitezeUrl(PUBLICURL."/vendor/weather-icons/css/weather-icons.min.css") ?>">
    <link rel="stylesheet" href="<?=f::sanitezeUrl(PUBLICURL."/vendor/weather-icons/css/weather-icons-wind.min.css") ?>">
    <link rel="stylesheet" href="<?=f::sanitezeUrl(PUBLICURL."/css/style.css") ?>">

    <script src="<?=f::sanitezeUrl(PUBLICURL."/vendor/jquery/jquery-2.2.3.min.js") ?>"></script>
    <script src="<?=f::sanitezeUrl(PUBLICURL."/vendor/bootstrap/js/bootstrap.min.js") ?>"></script>

</head>
<body>

