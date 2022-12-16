<?php $this->view('includes/header'); ?>









    <div class="container-fluid">
        <form class="w-50 mx-auto mt-5">
            <div class="mb-3 text-center">
                <h2>My school</h2>
                <img class="rounded-circle" src="images/logo.png" alt="logo" style="width: 80px">
            </div>
            <h3>Add user</h3>
            <div class="mb-3">
                <input name="first-name" type="email" class="form-control" id="first-name" placeholder="First Name">
            </div>
            <div class="mb-3">
                <input name="last-name" type="email" class="form-control" id="last-name" placeholder="Last Name">
            </div>
            <div class="mb-3">
                <input name="email" type="email" class="form-control" id="email" placeholder="Email"">
            </div>
            <div class="mb-3">
                <select name="gender" id="gender" class="form-select" >
                    <option value="Select gender">Select a gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <select name="gender" id="gender" class="form-select" >
                    <option value="Select gender">Select a rank</option>
                    <option value="student">Student</option>
                    <option value="reception">Reception</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="password2" name="password" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary float-end">Add user</button>
            <button type="submit" class="btn btn-danger">Cancel</button>
        </form>
    </div>



<?php $this->view('includes/footer'); ?>