<?php
//var_dump($_GET);//GET인자의 값을 표시해주는 코드
//var_dump($_GET['id']);//GET인자의 값중  id값만 표시
// 1. 데이터베이스 서버에 접속
$link = mysql_connect('localhost', 'root', '111111');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
// 2. 데이터베이스 선택
mysql_select_db('opentutorials');
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
if (!empty($_GET['id'])) {
	$sql = "SELECT * FROM topic WHERE id = " . $_GET['id'];
	$result = mysql_query($sql);
	//sql변수  질어어의 결과를 식별해주는 식별자를 result변수에 담음
	$topic = mysql_fetch_assoc($result);
	//result의 내용을 topic에 담음
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
			body {
				font-size: 0.8em;
				font-family: dotum;
				line-height: 1.6em;
			}
			body.black {
				background-color: black;
				color: white;
			}
			body.black a {
				color: white;
			}
			body.black a:hover {
				color: #f60;
			}
			body.black header {
				border-bottom: 1px solid #333;
			}
			body.black nav {
				border-right: 1px solid #333;
			}
			header {
				border-bottom: 1px solid #ccc;
				padding: 20px 0;
			}
			#toolbar {
				padding: 10px;
				float: right;
			}
			nav {
				float: left;
				margin-right: 20px;
				min-height: 500px;
				border-right: 1px solid #ccc;
			}
			nav ul {
				list-style: none;
				padding-left: 0;
				padding-right: 20px;
			}
			article {
				float: left;
			}
			footer {
				clear: both;
			}
			a {
				text-decoration: none;
			}
			a:link, a:visited {
				color: #333;
			}
			a:hover {
				color: #f60;
			}
			h1 {
				font-size: 1.4em;
			}
			.description {
				width: 500px;
			}
        </style>
    </head>
  
    <body id="body">
        <div>
            <header>
                <h1>JavaScript</h1>
            </header>
            <div id="toolbar">
                <input type="button" value="black" onclick="document.getElementById('body').className='black'" />
                <input type="button" value="white" onclick="document.getElementById('body').className='white'" />
            </div>
            <nav>
                <ul>
                    <?php
					$sql = "select id,title from topic";
					$result = mysql_query($sql);
					while ($row = mysql_fetch_assoc($result)) {//더이상 리턴 할 값이 없으면 false가 되어 while문 종료
						echo " <li><a href=\"?id={$row['id']}\">{$row['title']}</a></li> ";
					}
                    ?>
                </ul>
			</nav>
            <article>
                <?php
                if(!empty($topic)){
                ?>
                <h2><?=$topic['title']// '=': echo 없이 화면에 바로 출력?></h2> 
                <div class="description">
                    <?=$topic['description'] ?>
                </div>
                <?php
				}
                ?>
            </article>
        </div>
    </body>
</html>
