<?php
session_start();
date_default_timezone_set('PRC');

if (!isset($_POST['note_tag'])) {
    return;
}

if (!isset($_POST['title'])) {
    return;
}

if (!isset($_POST['content'])) {
    return;
}

if (!isset($_SESSION['nickname'])) {
    echo '请先登陆';
    return;
}

if (!isset($_SESSION['figureurl_qq'])) {
    echo '请先登陆';
    return;
}

if (!isset($_SESSION['user_id'])) {
    echo 'param error user_id';
    return;
}

$tag = $_POST['note_tag'];
$title = $_POST['title'];
$content = $_POST['content'];

$nick_name = $_SESSION['nickname'];
$user_id = $_SESSION['user_id'];

$time_stamp = time();

//TODO 插入数据前 检测collection 是否存在，不存在则不插入
$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');

/** 初始化content_id*/
/** 生成自增id*/
$query = array(
    "findandmodify" => "col_increase",
    "query" => ['table' => 'inc_content_id'],
    "update" => ['$inc' => ['content_id_now' => 1]],
    'upsert' => true,
    'new' => true,
    'fields' => ['content_id_now' => 1]
);
$command = new MongoDB\Driver\Command($query);
$command_cursor = $manager->executeCommand('db_account', $command);
$response = $command_cursor->toArray()[0];
$content_id = $response->value->content_id_now;

/** 标题信息*/
$note_title_info = [
    'contentid' => $content_id,
    'authorid' => $user_id,
    'authorname' => $nick_name,
    'author_figure' => $_SESSION['figureurl_qq'],
    'title' => $title,
    'content' => $content,
    'createtime' => $time_stamp,
    'comment_count' => 0
];
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($note_title_info);
$db_collection_name = 'db_tag.' . $tag;
$manager->executeBulkWrite($db_collection_name, $bulk);

/** 更新redis的编辑时间 加入排序列表*/
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
/**
 * 全部文章更新排序,
 * $score1 是编辑时间
 * $value1 是$tag和$content_id的组合 $tag_$content_id
 */
$redis->zAdd('content_all', $time_stamp, $tag . '_' . $content_id);
/** 指定tag更新排序*/
$redis->zAdd($tag, $time_stamp, $tag . '_' . $content_id);

/** 跳转到指定评论页面*/
$url = 'note_get.php?tag=' . $tag . '$contentid=' . $content_id;
echo '<script language = "javascript" type = "text/javascript">window.location.href=' . $url . '</script>';