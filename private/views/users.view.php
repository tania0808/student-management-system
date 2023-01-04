<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>


<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <div class="d-flex justify-content-between align-items-center">
        <form action="" method="get">
            <div class="input-group flex-nowrap mt-3 mb-3">
                <button type="submit" class="input-group-text" id="addon-wrapping"><i
                            class="fa-solid fa-magnifying-glass"></i>&nbsp
                </button>
                <input value="<?=isset($_GET['search']) ? $_GET['search']: '';?>" name="search" type="text" class="form-control w-50" placeholder="Search" aria-label="Search"
                       aria-describedby="addon-wrapping">
            </div>
        </form>
        <a href="<?= ROOT ?>/signup">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>Add new</button>
        </a>
    </div>

    <div class="card-group justify-content-center">
        <?php
        if($users){
        foreach ($users as $user) { ?>
            <?php include ($this->views_path('user'));?>
        <?php }} else {?>
        <h4>No staff members were found at this time !</h4>
        <?php }?>
    </div>
    <?php $pager->display();?>
</div>

<?php $this->view('includes/footer'); ?>
