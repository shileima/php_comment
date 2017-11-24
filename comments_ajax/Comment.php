<?php
/**
 * Created by PhpStorm.
 * User: Loading
 * Date: 2017/11/23
 * Time: 12:39
 */

class Comment
{
    private $username;
    public $content;

/*    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }*/

    /*方法是 __set __get 的话，可以使用 $commont->username 来设置和获取变量*/
    public function __set($name,$value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }
}

$commont = new Comment();

/*$commont->set(username,'Loading123');*/

/*var_dump($commont->get(username));*/

$commont->username = 'LoadingName';

var_dump($commont->username);



class CommentBook
{
    const FilePath = 'commentBook.txt';

    public function getCommentList(){
        return unserialize(file_get_contents(self::FilePath));
    }

    public function write($commentData){
        $commentList = $this->getCommentList();

        if(is_array($commentList)){
            array_unshift($commentList,$commentData);
        }else{
            $commentList = [$commentData];
        }
    }
}

echo '<hr>';

$commontBook = new CommentBook();

echo $commontBook::FilePath;

