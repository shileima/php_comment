<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
    <title>PHP 简易评论</title>
</head>
<style>
    #comment {margin-top: 0.4vw;}
    hr{margin:10px 0;}
</style>
<body>
<div id="container" style="margin: 10px;">
    <div class="form-group">
        <label for="exampleInputEmail1">用户名:</label>
        <input id="username" type="text" class="form-control" name="username" placeholder="username">
    </div>
    <div class="form-group">
        <label for="content">评论:</label>
        <textarea id="content" type="text" class="form-control" name="content" placeholder="content"></textarea>
    </div>
    <button id="submit" type="submit" class="btn btn-default">提交</button>

    <div id="comment">
        <?php
        include 'commentBook.php';

        $page = isset($_GET['page'])?intval($_GET['page']):1;
        $limit = isset($_GET['limit'])?intval($_GET['limit']):3;

        $commentView = new CommentBook();

        $commentView->view($page,$limit);


        ?>
    </div>

    <nav aria-label="...">
        <ul class="pagination">
            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>

            <?php
                $commentPage = new CommentBook();
                $commentPage->page($page,$limit,'viewAjaxComment.php');
            ?>

        </ul>
    </nav>

</div>
<!--<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>-->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script>
    $('#submit').on('click',function(){
        $.ajax({
            type: 'POST',
            url: 'addAjaxComment.php',
            dataType: 'json',
            data: {'username':$('#username').val(),'content':$('#content').val()},
            success: function(data){
                alert(data.msg)
                if(!data.code){
                    window.location.reload();
                }
            }
        })
    })


</script>
</body>
</html>
