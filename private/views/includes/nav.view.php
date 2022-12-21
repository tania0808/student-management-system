<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="nav-link text-reset" href="<?=ROOT?>/">
            <img src="images/logo.png" alt="logo" style="width: 50px">
        MY SCHOOL
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=ROOT?>/">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/schools">SCHOOLS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/users">STAFF</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/students">STUDENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/tests">TESTS</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo Auth::getFirst_Name();?>
                    </a>
                    <ul class="dropdown-menu w-25 dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?=ROOT?>/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="<?=ROOT?>/">Dashboard</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?=ROOT?>/logout">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>