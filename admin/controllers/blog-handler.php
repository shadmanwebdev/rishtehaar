<?php
    include '../../partials/functions.php';
    include '../../Classes/Db.php';
    include '../../Classes/Blog.php';
    
    $blog = new Blog();
    if(isset($_POST['create_post'])) {
        $blog->create();
    }
    if(isset($_POST['update_post'])) {
        $blog->update($_POST['post_id']);
    }
    if(isset($_POST['delete_post'])) {
        $blog->delete($_POST['post_id']);
    }
    if(isset($_POST['delete_post_img'])) {
        $blog->del_thumbnail($_POST['thumbnail'], $_POST['post_id']);
    }
    if(isset($_POST['get_edit_post'])) {
        $blog->get_edit_post_form($_POST['id']);
    }
?>