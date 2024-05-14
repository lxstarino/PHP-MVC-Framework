<!DOCTYPE html>
<html data-color-mode="<?php echo isset($_COOKIE["color-scheme"]) ? $_COOKIE["color-scheme"] : "dark"; ?>" data-light-theme="light" data-dark-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="/assets/css/index.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        {{page_content}}
    </body>
</html>