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