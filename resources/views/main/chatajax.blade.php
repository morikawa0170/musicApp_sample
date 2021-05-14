<?php
$link = mysqli_connect('morikawa.naviiiva.work', 'naviiiva_user', '!Samurai1234', 'morikawa');
if($_SERVER['REQUEST_METHOD'] == 'POST'){ //タイトル（プレイリストid）とチャットをdbに登録
   $title = $_POST["title"]; //プレイリストID
	$msg = $_POST["msg"]; //チャットの文
	$insert = "insert into chat(title, msg) values(\"$title\",\"$msg\")";
	if ($result = mysqli_query($link, $insert)) {
		header("Location: playsub.php?url=https://open.spotify.com/playlist/".$title);
	}
} else { //チャットの文をjsonに変換して表示
    $title = $_GET["title"];
	$query = "SELECT * from chat where title='".$title."' order by id desc";
	if ($result = mysqli_query($link, $query)) {
		$msg = array();
		foreach($result as $row) {
			$msg[] = array(
				'msg'=>$row['msg']
			);
		}
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($msg);
	}
}
?>