<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="card-group justify-content-center">
        <form method="post" class="w-50">
            <h3>Add New Class</h3>
            <div class="mb-3">
                <input autofocus value="<?=get_var('class_name')?>" name="class_name" type="text" class="form-control p-2" id="class" placeholder="Class name"">
            </div>
            <?php

            if(isset($errors['class_name'])) {  ?>
                <div class="alert alert-danger p-2 mt-2" role="alert"><?=$errors['class_name']?></div>
            <?php } ?>
            <a href="<?=ROOT?>/classes">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button name="submit" type="submit" class="btn btn-primary float-end">Add</button>
        </form>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
