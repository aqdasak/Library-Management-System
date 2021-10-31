<?php
function add_category($conn, $category_name)
{
    $sql = "INSERT INTO `category`(`category_name`) VALUES('$category_name')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return get_category_id($conn, $category_name);
    }
    return NULL;
}

function get_category_id($conn, $category_name)
{
    $sql = "SELECT category_id FROM category WHERE category_name='$category_name'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return  mysqli_fetch_assoc($result)['category_id'];
    }
    return NULL;
}

function get_category_name($conn, $category_id)
{
    $sql = "SELECT category_name FROM category WHERE category_id='$category_id'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return  mysqli_fetch_assoc($result)['category_name'];
    }
    return NULL;
}
// require_once __DIR__ . '/_dbconnect.php';
// echo var_dump(add_category($conn, 'EIetn'));
