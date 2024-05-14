<!DOCTYPE html>
<html data-color-mode="<?php echo isset($_COOKIE["color-scheme"]) ? $_COOKIE["color-scheme"] : "dark"; ?>" data-light-theme="light" data-dark-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404</title>
        <link href="/assets/css/index.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.0/css/all.css">
        <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
        <style type="text/css">
            .container{
                text-align: center;
                width: 100%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            h1{
                font-size: 32px;
            }

            p{
                font-size: 18px;
            }

            .p-responsive{
                padding-right: 16px;
                padding-left: 16px;
            }

            .fa-solid, h1 {
                color: #ff8800;
            }

            
            @media screen and (max-width: 1028px) {
                h1{
                    font-size: 28px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container p-responsive">
            <h1><i class="fa-solid fa-triangle-exclamation"></i> Uh-oh, page not found...</h1>      
            <p>The resource "<?php echo $_SERVER['REQUEST_URI']?>" you were trying to access doesn't exist.</p>
        </div>
    </body>
</html>