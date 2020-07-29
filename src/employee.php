<?php include_once('library/sessionHelper.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Employee</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('../assets/header.html') ?>

    <form action="">
        <div class="container-sm border p-4 employee-container">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" placeholder="First name">
                    </div>
                </div>
                <div class="col-md">
                    <label for="lastname">Last name</label>
                    <input type="text" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" placeholder="Email address">
                    </div>
                </div>
                <div class="col-md">
                    <label for="gender">Gender</label>
                    <select id="inputGender" class="form-control">
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" placeholder="City">
                    </div>
                </div>
                <div class="col-md">
                    <label for="address">Street Address</label>
                    <input type="text" class="form-control" placeholder="Street Address">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" placeholder="State">
                    </div>
                </div>
                <div class="col-md">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" placeholder="Age">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" class="form-control" placeholder="Postal Code">
                    </div>
                </div>
                <div class="col-md">
                    <label for="phonenumber">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Phone Number">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
            <button type="submit" class="btn btn-secondary mt-2">Return</button>
        </div>
    </form>

    <?php include('../assets/footer.html') ?>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>