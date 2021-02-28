<?php
require 'config.php';
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    $id = $_GET['id'];
    $query = "SELECT * FROM employees WHERE id=$id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
            }
        } else {
            echo 'No records found.';
        }
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($connect);
    }
} else {
    echo "Sorry, you've made an invalid request.";
}

$firstnameerr = $lastnamerr = $emailerr = '';

if (isset($_POST['updateEmployee'])) {
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
        $query = "UPDATE employees SET firstname = '" . $firstname . "', lastname = '" . $lastname . "', email = '" . $email . "' WHERE id = " . $id;

        $result = mysqli_query($connect, $query);

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
    <title>Edit employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Edit Employee</h2>
                </div>

                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
                    <div class="form-group <?php echo !empty($firstnameerr) ? 'has-error' : '' ?>">
                        <label for="firstname">First name:</label>
                        <input type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter first name" name="firstname">
                        <span class="help-block"><?php echo $firstnameerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($lastnamerr) ? 'has-error' : '' ?>">
                        <label for="firstname">Last name:</label>
                        <input type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>" placeholder="Enter last name" name="lastname">
                        <span class="help-block"><?php echo $lastnamerr ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($emailerr) ? 'has-error' : '' ?>">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $email; ?>" id="email" placeholder="Enter email" name="email">
                        <span class="help-block"><?php echo $emailerr ?></span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" class="btn btn-primary" value="Submit" name="updateEmployee">
                </form>
            </div>
        </div>
    </div>

</body>

</html>