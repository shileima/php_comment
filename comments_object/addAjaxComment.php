<?php
/**
 * Created by PhpStorm.
 * User: Loading
 * Date: 2017/11/22
 * Time: 15:10
 */

header("Content-type: text/html; charset=utf-8");
include 'commentBook.php';

$username = $_POST['username'];
$content = $_POST['content'];

if($username == '' || $content ==''){
    /* echo '用户名或评论不能为空<a href="commentBook.php">返回评论区</a>';*/
    echo json_encode(array('code'=>1,'msg'=>'用户名或评论不能为空'));
}else{
    $comment = array('username'=>$username,'content'=>$content);

    $commentAdd = new CommentBook();
    $commentAdd->write($comment);
}