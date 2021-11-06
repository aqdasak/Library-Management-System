<?php
require_once __DIR__ . '/_dbconnect.php';
require_once __DIR__ . '/_sql.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


function is_admin_loggedin()
{
    if (isset($_SESSION['login']) and $_SESSION['login']['admin']) {
        return true;
    }
    return false;
}
function is_member_loggedin()
{
    if (isset($_SESSION['login']) and !$_SESSION['login']['admin']) {
        return true;
    }
    return false;
}

function login_admin($email, $password)
{
    global $conn;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $sql = "SELECT `admin_id`, `password` FROM `admin` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result and mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = array('admin' => true, 'id' => $row['admin_id']);
            return true;
        }
    }
    return false;
}

function login_member($email, $password)
{
    global $conn;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $sql = "SELECT `member_id`,`password` FROM `member` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result and mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = array('admin' => false, 'id' => $row['member_id']);
            return true;
        }
    }
    return false;
}

function logout()
{
    session_unset();
    session_destroy();
}

function signup_admin($firstname, $lastname, $phone, $email, $password)
{
    global $conn;
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `admin` (`firstname`, `lastname`, `phone`, `email`, `password`) " . VALUES($firstname, $lastname, $phone, $email, $password);

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    }
    return false;
}

function signup_member($firstname, $lastname, $phone, $email, $password)
{
    global $conn;
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `member` (`firstname`, `lastname`, `phone`, `email`, `password`,`verified`)" . VALUES($firstname, $lastname, $phone, $email, $password, 0);

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    }
    return false;
}
