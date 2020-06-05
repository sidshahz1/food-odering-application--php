<!---session start--->
<?php include('../utilities/dbConnection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Registration</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- java script file -->
    <script src="./javascript/formValidations.js"></script>
</head>
<body>
    <div class="container">
        <!-- alert for any error or success from backend-->
        <?php include('../utilities/alert.php') ?>
        <!-- div to display front end validation errors -->
        <div id='alertDiv' class="alert alert-danger" style="display:none"></div>

        <div class="header row justify-content-center">
            <h2> Register User</h2>
        </div>
        <div class="shadow p-3 mb-5 bg-white rounded" >
            <form action="../server/server.php" method="post" onSubmit="return registrationValidation()">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" name="email" placeholder="your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" name="pass1" placeholder="your password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password: </label>
                    <input type="password" class="form-control" name="pass2" placeholder="confirm password" required>
                </div>
                <div class="form-group">
                    select default food preference:
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="preference" value="veg" checked>
                    <label class="form-check-label">veg</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="preference" value="non veg">
                    <label class="form-check-label">non veg</label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="register_user"> Register </button>
                </div>
                <div class="form-group">
                    Already a user <a href="userLogin.php">Log in</a>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline-primary" href="restroRegistration.php">Register as restro</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>