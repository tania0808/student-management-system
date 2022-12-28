<form action="" method="post" class="form mt-3 mx-auto w-50">
    <h4>Add Lecturer</h4>
    <input autofocus class="form-control" type="text" name="name" placeholder="Lecturer Name">
    <button class="btn btn-primary mt-2 float-end">Search</button>
    <div class="clearfix"></div>
</form>

<div class="container-fluid">
    <?php
    if (isset($results) && $results) {
        foreach ($results as $user) { ?>
            <?php include($this->views_path('user')); ?>
        <?php }
    } else { ?>
            <?php if(count($_POST) > 0){ ?>
        <h4 class="text-center">
            <hr>No results were found !</h4>
    <?php }} ?>
</div>