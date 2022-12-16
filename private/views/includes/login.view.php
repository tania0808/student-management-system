<?php $this->view('includes/header'); ?>

    <div class="container-fluid">
        <form class="w-50 mx-auto mt-5">
            <div class="mb-3 text-center">
                <h2>My school</h2>
                <img class="rounded-circle" src="images/logo.png" alt="logo" style="width: 80px">
            </div>
            <h3>Login</h3>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>


<?php $this->view('includes/footer'); ?>