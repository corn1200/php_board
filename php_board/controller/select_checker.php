<?php
    $category = $_POST['category'];
    $search = $_POST['search'];

    if(isset($category) && isset($search)) {
        return "&category=$category&search=$search";
    } else {
        return "";
    }
?>