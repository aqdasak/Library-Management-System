<?php
require_once __DIR__ . '/_dbconnect.php';

function add_category($category_name)
{
    global $conn;
    $sql = "INSERT INTO `category`(`category_name`) VALUES('$category_name')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return get_category_id($category_name);
    }
    return NULL;
}

function get_category_id($category_name)
{
    global $conn;
    $sql = "SELECT category_id FROM category WHERE category_name='$category_name'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return  mysqli_fetch_assoc($result)['category_id'];
    }
    return NULL;
}

function get_category_name($category_id)
{
    global $conn;
    $sql = "SELECT category_name FROM category WHERE category_id='$category_id'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return  mysqli_fetch_assoc($result)['category_name'];
    }
    return NULL;
}
