<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>
<div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
    <?php $this->view('includes/breadcrumb', ['crumbs' => $crumbs]); ?>
    <h5>Classes</h5>
    <div class="card-group justify-content-center">
        <?php include $this->views_path('classes') ?>
    </div>
</div>

<?php $this->view('includes/footer'); ?>
