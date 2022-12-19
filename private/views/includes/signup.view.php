<?php $this->view('includes/header'); ?>








    <div class="container-fluid">
        <form class="w-50 mx-auto mt-5" method="post">
            <div class="mb-3 text-center">
                <h2>My school</h2>
                <img class="rounded-circle" src="images/logo.png" alt="logo" style="width: 80px">
            </div>
            <h3>Add user</h3>
            <div class="mb-3">
                <input value="<?=get_var('firstname')?>" name="firstname" type="text" class="form-control" id="first-name" placeholder="First Name">
                <?php if(isset($errors['firstname'])) {  ?>
                        <div class="form-text text-danger"><?=$errors['firstname']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <input value="<?=get_var('lastname')?>" name="lastname" type="text" class="form-control" id="last-name" placeholder="Last Name">
                <?php if(isset($errors['lastname'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['lastname']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <input value="<?=get_var('email')?>" name="email" type="email" class="form-control" id="email" placeholder="Email"">
                <?php if(isset($errors['email'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['email']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <select value="<?=get_var('gender')?>"  name="gender" id="gender" class="form-select" >
                    <option <?=get_select('rank', '')?> value="">----Select a gender----</option>
                    <option <?=get_select('gender', 'male')?> value="male">Male</option>
                    <option <?=get_select('gender', 'female')?> value="female">Female</option>
                </select>
                <?php if(isset($errors['gender'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['gender']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <select value="<?=get_var('rank')?>"  name="rank" id="rank" class="form-select" >
                    <option <?=get_select('rank', '')?> value="">----Select a rank----</option>
                    <option <?=get_select('rank', 'student')?> value="student">Student</option>
                    <option <?=get_select('rank', 'reception')?> value="reception">Reception</option>
                    <option <?=get_select('rank', 'lecturer')?> value="lecturer">Lecturer</option>
                    <option <?=get_select('rank', 'admin')?> value="admin">Admin</option>
                    <option <?=get_select('rank', 'super_admin')?> value="super_admin">Super Admin</option>
                </select>
                <?php if(isset($errors['rank'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['rank']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <input value="<?=get_var('password')?>"  type="password" class="form-control" id="password" name="password" placeholder="Password">
                <?php if(isset($errors['password'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['password']?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <input value="<?=get_var('password2')?>"  type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                <?php if(isset($errors['password'])) {  ?>
                    <div class="form-text text-danger"><?=$errors['password']?></div>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary float-end">Add user</button>
            <button type="button" class="btn btn-danger">Cancel</button>
        </form>
    </div>



<?php $this->view('includes/footer'); ?>