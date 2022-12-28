<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="card-group justify-content-center">
        <?php if($row): ?>
        <form method="post" class="w-50">
            <h3>Are you sure you want to delete ?!</h3>
            <div class="mb-3">
                <input disabled value="<?=get_var('class', $row[0]->class_name)?>" name="class_name" type="text" class="form-control p-2" id="class" placeholder="Class name"">
            </div>
            <input class="d-none" type="text" value="<?=get_var('class', $row[0]->class_name)?>" name="class_name" >
            <a href="<?=ROOT?>/classes">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button type="submit" class="btn btn-primary float-end">Delete</button>
        </form>
    </div>
<?php else: ?>
    <div class="d-flex flex-column">
        <h3>That class was not found ! </h3>
        <a href="<?= ROOT ?>/classes" style="display: block">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
    </div>
<?php endif; ?>
</div>

<?php $this->view('includes/footer'); ?>
