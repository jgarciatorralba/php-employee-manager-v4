<?php include "assets/head.php"; ?>
<body class="d-flex flex-column min-vh-100">
<?php include "assets/header.php"; ?>
    <form action="<?php echo constant('URL'); ?>employee/submitEmployee" method="post">
        <input type="text" name="id" class="d-none">
        <input type="text" name="redirect" class="d-none" value="true">
        <input type="text" name="avatar" id="avatarInput" class="d-none">
        <div class="container-sm border p-4 mt-5 employee-container">

            <?php include(VIEWS.'imageGallery.php'); ?>

            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <div class="avatar-image mx-auto" cla>
                            <img src="<?php echo constant('URL'); ?>assets/img/no-foto.jpg" id="avatar-image" alt="avatar" class="rounded">
                        </div>
                    </div>
                </div>
            </div>
            <?php if(property_exists($this, 'success') && ($this->success) == true) { ?>
                <div class="alert alert-success" role="alert" style="display: none;"></div>
            <?php } ?>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="firstname">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md">
                    <label for="lastname">Last name</label>
                    <input type="text" name="lastName" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" name="email" class="form-control" placeholder="Email address">
                    </div>
                </div>
                <div class="col-md">
                    <label for="gender">Gender</label>
                    <select id="inputGender" name="gender" class="form-control">
                        <option selected>Choose...</option>
                        <option value="man">Male</option>
                        <option value="woman">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" placeholder="City">
                    </div>
                </div>
                <div class="col-md">
                    <label for="address">Street Address</label>
                    <input type="text" name="streetAddress" class="form-control" placeholder="Street Address">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" placeholder="State">
                    </div>
                </div>
                <div class="col-md">
                    <label for="age">Age</label>
                    <input type="text" name="age" class="form-control" placeholder="Age">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" name="postalCode" class="form-control" placeholder="Postal Code">
                    </div>
                </div>
                <div class="col-md">
                    <label for="phonenumber">Phone Number</label>
                    <input type="text" name="phoneNumber" class="form-control" placeholder="Phone Number">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
            <a href="<?php echo constant('URL'); ?>" class="btn btn-secondary mt-2">Return</a>
        </div>
    </form>

<?php
    include "assets/footer.php";
    include "assets/foot.php";
?>
<script src="<?php echo constant('URL'); ?>assets/js/employee.js"></script>
</body>