<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>

    <div class="container container-fluid">
        <h1 class="text-success">This is home page</h1>
    </div>

<?php
    echo "<pre>";
    print_r($users);
    echo "</pre>";

?>


<?php $this->view('includes/footer'); ?>
