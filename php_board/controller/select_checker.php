<?php
    $category = $_POST['category'];
    $search = $_POST['search'];

    if(isset($category) && isset($search)) {
        echo "&category=$category&search=$search";
    } else {
        echo "";
    }
?>