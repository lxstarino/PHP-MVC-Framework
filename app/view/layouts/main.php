<!DOCTYPE html>
<html data-color-mode="<?php echo isset($_COOKIE["color-scheme"]) ? $_COOKIE["color-scheme"] : "dark"; ?>" data-light-theme="light" data-dark-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="/assets/css/header&footer.css" type="text/css" rel="stylesheet">
        <link href="/assets/css/index.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <header class="d-flex justify-between items-center">
            <a href="/"><img class="logo" src="/assets/images/logo.png"></img></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="burger" style="cursor: pointer;">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </label>

            <nav class="navbar">
                <ul class="list-style-none"> 
                    <li>
                        <form method="GET" action="/search"> 
                            <input type="text" class="form-control" placeholder="Search profiles..." name="uid"></input>
                            <i class="fa-solid fa-magnifying-glass glass-color" style="position: absolute; top: 0; left: 0; height: 100%; width: 70px; display: flex; justify-content: center; align-items: center;"></i>
                        </form>
                    </li>
                    <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
                    <?php if(isset($authenticated) && $authenticated): ?>                
                        <?php 
                            !isset($_COOKIE["color-scheme"]) ? [setcookie("color-scheme", $color_scheme, time()+500000, "/"), header("Refresh: 0")]  : "";
                        ?>
                        <li>
                            <a style='display: flex; flex-direction: row; align-items: center;' href='#'><img style='width: 25px; height: 25px; border-radius: 50%;' class='mr-4' src='<?= $profile_picture; ?>'></img> <?= $username ?> <i class='fas fa-caret-down ml-4'></i></a>
                            <ul class='list-style-none'>
                                <li><a href='/id/<?= $profile_id ?>'><i class='fa-solid fa-user'></i> Your Profile</a></li>
                                <li><a href='/settings/1'><i class='fa-solid fa-gear'></i> Settings</a></li>
                                <li><a href='/logout'><i class='fa-solid fa-right-from-bracket'></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="#"><i class="fa-solid fa-user"></i> Account <i class="fas fa-caret-down"></i></a>
                            <ul class="list-style-none">
                                <li><a href="/sign-up"><i class="fa-solid fa-user-plus"></i>  Sign up</a></li>
                                <li><a href="/sign-in"><i class="fa-solid fa-right-to-bracket"></i>  Sign in</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        {{page_content}}

        <footer class="pdt-32">
            <nav style="border-top: 1px solid var(--border); width: 100%;">
                <div class="d-flex row-2x2123 col-4yxx2  center-container container-xl pd-16">
                    <ul class="list-style-none mr-16 mb-16">    
                        <li class="text-bold text-center">Footer Heading</li>
                    </ul>

                    <div class="footer-options d-flex flex-row justify-center gap-32">
                        <div class="d-flex flex-column gap-4">
                            <span class="text-bold">Community</span>
                            <a class="footer-link" href="#">Terms of Use</a>
                            <a class="footer-link" href="#">Discord Server</a>
                            <a class="footer-link" href="#">Invite Discord Bot</a>
                        </div>
                        <div class="d-flex flex-column gap-4">
                            <span class="text-bold">Company</span>
                            <a class="footer-link" href="#">Legal Notice</a>
                            <a class="footer-link" href="#">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </nav>
        </footer>
    </body>
</html>