<?php
require 'config.php';
$firstname = $lastname = $email = '';
$firstnameerr = $lastnamerr = $emailerr = '';

if (isset($_POST['addEmployee'])) {
    extract($_POST);

    if (empty($firstname)) {
        $firstnameerr = 'Please enter first name';
    }

    if (empty($lastname)) {
        $lastnamerr = 'Please enter last name';
    }

    if (empty($email)) {
        $emailerr = 'Please enter email address';
    } else {        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {            
            $emailerr = 'Please enter valid email address';
        }        
    }
    
    if (empty($firstnameerr) && empty($lastnamerr) && empty($emailerr)) {
        $query = "INSERT INTO employees (firstname, lastname, email) values('" . $firstname . "', '" . $lastname . "', '" . $email . "')";
        $result = mysqli_query($connect, $query);

        $errmsg = '';
        if ($result) {
            header('location: index.php');
        } else {
            echo 'Something went wrong!! Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">

    </style>
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Add New Employee</h2>
                </div>

                <form action="add.php" class="" method="POST">
                    <div class="form-group <?php echo !empty($firstnameerr) ? 'has-error' : '' ?>">
                        <label for="firstname">First name:</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname" value="<?php echo $firstname; ?>">
                        <span class="help-block"><?php echo $firstnameerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($lastnamerr) ? 'has-error' : '' ?>">
                        <label for="firstname">Last name:</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastnamerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($emailerr) ? 'has-error' : '' ?>">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $emailerr ?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit" name="addEmployee">
                </form>
            </div>
        </div>
    </div>

</body>

</html>