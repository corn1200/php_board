<?php
    $category = $_POST['category'];
    $search = $_POST['search'];
    $order = $_POST['order'];

    if(isset($category) && isset($search) && $category != null && $category != "" && $search != null && $search != "") {
        echo "&category=$category&search=$search";
    } else {
        echo "";
    }
?>