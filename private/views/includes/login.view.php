<?php $this->view('includes/header');?>

    <div class="container-fluid">
        <form class="w-50 mx-auto mt-5" method="post">
            <div class="mb-3 text-center">
                <h2>My school</h2>
                <img class="rounded-circle" src="images/logo.png" alt="logo" style="width: 80px">
            </div>
            <h3>Login</h3>
            <div class="mb-3">
                <input value="<?=get_var('email')?>" name="email" type="email" class="form-control p-2" id="email" placeholder="Email"">
            </div>
            <div class="mb-3">
                <input value="<?=get_var('password')?>"  type="password" class="form-control p-2" id="password" name="password" placeholder="Password">
                <?php if(isset($errors['email'])) {  ?>
                    <div class="alert alert-danger p-2 mt-2" role="alert"><?=$errors['email']?></div>
                <?php } ?>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>


<?php $this->view('includes/footer'); ?>