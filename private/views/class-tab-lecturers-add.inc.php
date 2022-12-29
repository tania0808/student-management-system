<?php if($error){ ?>
    <div class="alert alert-warning" role="alert">
        User is already added!!!
    </div>
<?php } ?>
<form action="" method="post" class="form mt-3 mx-auto w-50">
    <h4>Add Lecturer</h4>
    <input value="<?=get_var('name') ?>" autofocus class="form-control" type="text" name="name" placeholder="Lecturer Name">
    <button class="btn btn-primary mt-2 float-end" name="search">Search</button>
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers"">
    <button class="btn btn-danger mt-2" type="button">Cancel</button>
    </a>
    <div class="clearfix"></div>
</form>

<div class="card-group justify-content-center">
    <form action="" method="post">
    <?php
    if (isset($results) && $results) { ?>
            <?php foreach ($results as $user) {
            include($this->views_path('user')); ?>
            <?php } ?>
    <?php } else { ?>
        <?php if (count($_POST) > 0 & !$error) { ?>
            <h4 class="text-center">
                <hr>
                No results were found !
            </h4>
        <?php }
    } ?>
    </form>
</div>