<link href="/assets/css/auth.css" type="text/css" rel="stylesheet">
<div style="position: absolute; height: 100%; width: 100%;">
    <div class="d-flex justify-center items-center wrapper-snin">
        <form class="auth-box pd-32" method="POST">
            <?php 
                if(isset($errors)){
                    foreach($errors as $error){
                        echo "<div class='alert alert-danger mb-4'>$error</div>";
                    }
                }
            ?>
            <div class="d-flex items-center flex-column">
                <a href="/"><img style="width: 75px; padding: 8px; filter: var(--filter);" src="/assets/images/logo.png"></img></a>
                <h1>Welcome back</h1>
            </div>
            <div class="d-flex flex-column mb-16 mt-32">
                <label class="lbl">Username</label>
                <input type="text" name="uid" class="form-control" <?php echo isset($uid) ? "value='". $uid . "'" : "" ?>></input>
            </div>
            <div class="d-flex flex-column mb-16">
                <label class="lbl">Password</label>
                <input type="password" name="pwd" class="form-control"></input>
            </div>
            <div class="d-flex flex-column">
                <input type="submit" name="submit" id="submit" value="Sign in" class="btn btn-confirm"></input>
                <span class="mt-4">No Account? <a class="link" href="/sign-up">Sign up</a></span>
            </div>
        </form>
    </div>
</div> 

