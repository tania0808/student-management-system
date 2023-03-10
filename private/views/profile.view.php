<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


    <div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
        <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
        <?php if($user) :?>
        <div class="row d-flex justify-content-center">
            <div class="col-xs-12 col-sm-4 text-center mb-3 mb-sm-0">
                <?php $image = get_image($user->image, $user->gender); ?>
                <img class="rounded-circle border border-primary" src="<?=$image?>" alt="logo" style="width: 150px">
                <h5 class="mt-3"><?=escape($user->first_name)?> <?=escape($user->last_name)?></h5>
                <?php if(Auth::access('admin') || (Auth::access('reception') && $user->rank == 'student')): ?>
                    <div>
                        <a href="<?=ROOT?>/profile/edit/<?=$user->student_id?>">
                            <button class="btn btn-success btn-sm">Edit profile</button>
                        </a>
                        <a href="<?=ROOT?>/profile/delete/<?=$user->student_id?>">
                            <button class="btn btn-danger btn-sm">Delete profile</button>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-8 col-xs-12">
                <table class="table table-hover table-striped table-primary table-bordered">
                    <tr>
                        <th>First name:</th>
                        <td><?=escape($user->first_name)?></td>
                    </tr>
                    <tr>
                        <th>Last name:</th>
                        <td><?=escape($user->last_name)?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?=escape($user->email)?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?=escape(ucfirst($user->gender))?></td>
                    </tr>
                    <tr>
                        <th>Rank:</th>
                        <td><?=escape(ucfirst($user->rank))?></td>
                    </tr>
                    <tr>
                        <th>Date Created:</th>
                        <td><?=escape(get_date($user->date))?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab == 'infos' ? 'active' : ''?>" href="<?=ROOT?>/profile/<?=$user->student_id?>?tab=infos">Basic Info</a>
                </li>
                <?php  if (Auth::access('lecturer') || Auth::i_own_content($user)) : ?>
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab  == 'classes' ? 'active' : ''?>" href="<?=ROOT?>/profile/<?=$user->student_id?>?tab=classes">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$page_tab  == 'tests' ? 'active' : ''?>" href="<?=ROOT?>/profile/<?=$user->student_id?>?tab=tests">Tests</a>
                </li>
                <?php endif; ?>
            </ul>
            <?php
            switch ($page_tab){
                case 'infos':
                    include ($this->views_path('profile-tab-infos'));
                    break;
                case 'classes':
                    if (Auth::access('lecturer') || Auth::i_own_content($user)){
                    include ($this->views_path('profile-tab-classes'));
                    } else {
                        $this->view('access-denied-message');
                    }
                    break;
                case 'tests':
                    if (Auth::access('lecturer') || Auth::i_own_content($user)){
                        include ($this->views_path('profile-tab-tests'));
                    } else {
                        $this->view('access-denied-message');
                    }
                    break;
            }
            ?>
        </div>
        <?php else :?>
        <h3 class="text-center">That profile was not found !</h3>
        <?php endif;?>
    </div>


<?php $this->view('includes/footer'); ?>