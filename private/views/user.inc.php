<div class="card m-2" style="max-width: 14rem;min-width: 14rem;">
    <div class="card-header">Profile</div>
    <?php $image = get_image($user->image, $user->gender); ?>
    <img src="<?=$image?>" class="card-img-top" alt="Card user image">
    <div class="card-body">
        <h5 class="card-title"><?=$user->first_name?> <?=$user->last_name?></h5>
        <p class="card-text">Rank : <?=ucfirst(str_replace('_', ' ', $user->rank))?> </p>
        <a href="profile/<?=$user->student_id?>" class="btn btn-primary">Profile</a>
        <?php if(isset($_GET['select']) && $_GET['tab'] == 'lecturers_add'){ ?>
            <button name="select" value="<?=$user->student_id?>" class="btn btn-danger float-end">Select</button>
        <?php } ?>
        <?php if(isset($_GET['select']) && $_GET['tab'] == 'lecturers_remove'){ ?>
            <button name="remove" value="<?=$user->student_id?>" class="btn btn-danger float-end">Remove</button>
        <?php } ?>
    </div>
</div>