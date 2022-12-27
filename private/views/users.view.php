<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div class="input-group flex-nowrap mt-3 w-25 mb-3">
            <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="addon-wrapping">
        </div>
        <a href="<?= ROOT ?>/signup">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>Add new</button>
        </a>
    </div>

    <div class="card-group justify-content-center">
        <?php
        if($users){
        foreach ($users as $user) { ?>
            <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
                <div class="card-header">Profile</div>
                <?php $image = get_image($user->image, $user->gender); ?>
                <img src="<?=$image?>" class="card-img-top" alt="Card user image">
                <div class="card-body">
                    <h5 class="card-title"><?=$user->first_name?> <?=$user->last_name?></h5>
                    <p class="card-text">Rank : <?=ucfirst(str_replace('_', ' ', $user->rank))?> </p>
                    <a href="profile/<?=$user->student_id?>" class="btn btn-primary">Profile</a>
                </div>
            </div>
        <?php }} else {?>
        <h4>No staff members were found at this time !</h4>
        <?php }?>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
