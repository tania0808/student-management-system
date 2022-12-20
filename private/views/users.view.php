<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb'); ?>
    <div class="card-group justify-content-center">
        <?php
        foreach ($users as $user) { ?>
            <div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
                <div class="card-header">Profile</div>
                <img src="images/<?php echo $user->gender == 'female' ? 'user_female.jpg' :  'user_male.jpg'; ?>" class="card-img-top" alt="Card user image">
                <div class="card-body">
                    <h5 class="card-title"><?=$user->first_name?> <?=$user->last_name?></h5>
                    <p class="card-text">Rank : <?=ucfirst(str_replace('_', ' ', $user->rank))?> </p>
                    <a href="#" class="btn btn-primary">Details</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
