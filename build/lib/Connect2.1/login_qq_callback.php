<?php
require_once("API/qqConnectAPI.php");
$qc = new QC();
$access_token = $qc->qq_callback();
$open_id = $qc->get_openid();
//$url = 'https://graph.qq.com/user/get_user_info?access_token='. $access_token .'&oauth_consumer_key=101569922&openid='. $open_id .'';
echo $access_token;
echo '<br>';
echo $open_id;