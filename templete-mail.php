<?php
/**
 * Template Name: template-mail
 *
 */
?>

<?php

// アンテナサイトのサブドメインを抽出
$server_domain = $_SERVER['HTTP_HOST'];
preg_match('/(.*)\.fuuuuuuuck\.com/', $server_domain , $sub_domain );

if($sub_domain[1] == "kikaku"){
  $site_name = "企画アンテナ";
}elseif($sub_domain[1] == "shirouto"){
  $site_name = "素人アンテナ";
}elseif($sub_domain[1] == "wife-madam"){
  $site_name = "人妻熟女アンテナ";
}elseif($sub_domain[1] == "rape"){
  $site_name = "レイプアンテナ";
}elseif($sub_domain[1] == "chakuero"){
  $site_name = "着エロアンテナ";
}

if (mail("fuuuuuuuck01@gmail.com", $site_name . "：" . number_format($wpdb->get_var("SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'")) . "件" , "" , "From:" . $site_name . "記事数" )) {
  echo "メールが送信されました。";
  echo number_format($wpdb->get_var("SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'"));
} else {
  echo "メールの送信に失敗しました。";
}

?>