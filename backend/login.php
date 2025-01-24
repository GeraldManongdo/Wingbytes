<?php

require("server.php");


// LOGIN USER
if (isset($_POST['login_admin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (count($errors) == 0) {
        // $password = md5($password);
        $query = "SELECT * FROM account WHERE email=? AND password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $access_level = $row['access_level'];
            $_SESSION['email'] = $email;

            if ($access_level == "staff") {
                $_SESSION['success'] = "Login Success";
                header('location: ../staff/POS.php');
                exit();
            }

            $_SESSION['success'] = "Login Success";
            header('location: ../admin/dashboard.php');
            exit();
        } else {
            $errorName = "Wrong email or password";
            header('location: ../?error=' . $errorName);
            exit();
        }
    }


}

$conn->close();

?>