<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


    <div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
       <h4 class="text-center">Edit Profile</h4>
        <?php if($user) :?>
        <div class="row d-flex justify-content-center">
            <div class="col-xs-12 col-sm-4 text-center mb-3 mb-sm-0">
                <?php $image = get_image($user->image, $user->gender); ?>
                <img class="border" src="<?=$image?>" alt="logo" style="width: 150px">
                <?php if(Auth::access('reception') || Auth::i_own_content($user)): ?>
                    <div>
                        <button class="btn btn-success btn-sm mt-3">Browse image</button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-8 col-xs-12">
                <form class="mx-auto" method="post">
                    <div class="mb-3">
                        <input value="<?=$user->first_name?>" name="first_name" type="text" class="form-control" id="first-name" placeholder="First Name">
                        <?php if(isset($errors['first_name'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['first_name']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <input value="<?=$user->last_name?>" name="last_name" type="text" class="form-control" id="last-name" placeholder="Last Name">
                        <?php if(isset($errors['last_name'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['last_name']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <input value="<?=$user->email?>" name="email" type="email" class="form-control" id="email" placeholder="Email"">
                        <?php if(isset($errors['email'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['email']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <select value="<?=$user->gender?>"  name="gender" id="gender" class="form-select" >
                            <?php if($user->gender == 'male') { ?>
                            <option <?=get_select('gender', 'male')?> value="male">Male</option>
                            <option <?=get_select('gender', 'female')?> value="female">Female</option>
                            <?php } else { ?>
                            <option <?=get_select('gender', 'female')?> value="female">Female</option>
                            <option <?=get_select('gender', 'male')?> value="male">Male</option>
                             <?php }  ?>
                        </select>
                        <?php if(isset($errors['gender'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['gender']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                            <select value="<?=get_var('rank')?>" name="rank" id="rank" class="form-select" >
                                <option <?=get_select('rank', $user->rank)?> value="<?=$user->rank?>"><?=ucfirst($user->rank)?></option>
                                <option <?=get_select('rank', 'student')?> value="student">Student</option>
                                <option <?=get_select('rank', 'reception')?> value="reception">Reception</option>
                                <option <?=get_select('rank', 'lecturer')?> value="lecturer">Lecturer</option>
                                <option <?=get_select('rank', 'admin')?> value="admin">Admin</option>

                                <?php if(Auth::getRank() == 'super_admin') :?>
                                    <option <?=get_select('rank', 'super_admin')?> value="super_admin">Super Admin</option>
                                <?php endif; ?>
                            </select>
                        <?php if(isset($errors['rank'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['rank']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <input value="<?=get_var('password')?>"  type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <?php if(isset($errors['password'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['password']?></div>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <input value="<?=get_var('password2')?>"  type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                        <?php if(isset($errors['password2'])) {  ?>
                            <div class="alert alert-warning mt-2 p-1" role="alert"><?=$errors['password']?></div>
                        <?php } ?>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/profile/<?=$user->student_id?>">
                            <button class="btn btn-danger">Back to profile</button>
                        </a>
                        <button type="submit" class="btn btn-success float-end">Save changes</button>

                    </div>
                </form
            </div>
        </div>

        <?php else :?>
        <h3 class="text-center">That profile was not found !</h3>
        <?php endif;?>
    </div>



<?php $this->view('includes/footer'); ?>