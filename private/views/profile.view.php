<?php $this->view('includes/header'); ?>
<?php $this->view('includes/nav'); ?>



    <div class="container container-fluid p-4 shadow mx-auto" style="max-width: 1000px">
        <?php $this->view('includes/breadcrumb'); ?>
        <div class="row d-flex justify-content-center">
            <div class="col-xs-12 col-sm-4 text-center mb-3 mb-sm-0">
                <img class="rounded-circle border border-primary" src="images/user_female.jpg" alt="logo" style="width: 150px">
            </div>
            <div class="col-8 col-xs-12">
                <table class="table table-hover table-striped table-primary table-bordered">
                    <tr>
                        <th>First name:</th>
                        <td>Tania</td>
                    </tr>
                    <tr>
                        <th>Last name:</th>
                        <td>His</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>Female</td>
                    </tr>
                    <tr>
                        <th>Date Created:</th>
                        <td>08-08-2000</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Basic Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tests</a>
                </li>
            </ul>
            <div class="input-group flex-nowrap mt-3">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="addon-wrapping">
            </div>
        </div>
    </div>


<?php $this->view('includes/footer'); ?>