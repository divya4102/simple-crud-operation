<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    require 'config.php';

    $id = $_GET['id'];
    $query = "DELETE FROM employees WHERE id=$id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header('Location:index.php');
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($connect);
    }
} else {
    echo "Sorry, you've made an invalid request.";
}
?>