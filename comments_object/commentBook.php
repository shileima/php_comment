<?php
/**
 * Created by PhpStorm.
 * User: Loading
 * Date: 2017/11/23
 * Time: 12:39
 */

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

        $commentFile = fopen(self::FilePath,'w');
        fwrite($commentFile,serialize($commentList));
        fclose($commentFile);
    }

    public function view($page,$limit){

        $commentList = $this->getCommentList();
        $totalCount = count($commentList);
        $totalPage = ceil($totalCount/$limit);

        $page = max(1,$page);
        $page = min($totalPage,$page);

        $start = ($page-1)*$limit;

        for($i=$start;$i<$start+$limit;$i++){
            if(isset($commentList[$i])){
                echo '<div style="margin: 10px 0;">用户名: '.$commentList[$i]['username'].'<br>'.'内容: '.$commentList[$i]['content'].'</div>'.'<hr>';
            } else {
                break;
            }
        }
    }

    public function page($page,$limit,$link){
        $commentList = $this->getCommentList();
        $totalCount = count($commentList);
        $totalPage = ceil($totalCount/$limit);


        for($i=1;$i<=$totalPage;$i++){
            if($i == $page){
                echo "<li class='active'><a href='$link?page=$i&&limit=$limit'>$i </a></li>";
            }else {
                echo "<li><a href='$link?page=$i&&limit=$limit'>$i </a></li>";
            }
        }
    }
}

