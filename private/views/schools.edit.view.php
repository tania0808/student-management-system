<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="card-group justify-content-center">
        <?php
        if($row): ?>
        <form method="post" class="w-50">
            <h3>Edit school</h3>
            <div class="mb-3">
                <input autofocus value="<?=get_var('school', $row[0]->school_name)?>" name="school_name" type="text" class="form-control p-2" id="school" placeholder="School name"">
            </div>
            <?php

            if(isset($errors['school_name'])) {  ?>
                <div class="alert alert-danger p-2 mt-2" role="alert"><?=$errors['school_name']?></div>
            <?php } ?>
            <a href="<?=ROOT?>/schools">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button type="submit" class="btn btn-primary float-end">Edit</button>
        </form>
    </div>
<?php else: ?>
    <div class="d-flex flex-column">
        <h3>That school was not found ! </h3>
        <a href="<?= ROOT ?>/schools" style="display: block">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
    </div>
<?php endif; ?>
</div>

<?php $this->view('includes/footer'); ?>
