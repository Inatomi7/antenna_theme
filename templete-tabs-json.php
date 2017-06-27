<?php
/**
 * Template Name: template-tabs-json
 *
 */
?>


<?php

// アンテナサイトのサブドメインを抽出
$server_domain = $_SERVER['HTTP_HOST'];
preg_match('/(.*)\.fuuuuuuuck\.com/', $server_domain , $sub_domain );

$tabs  = file_get_contents( "../json/tabs.json");
$tabs = mb_convert_encoding($tabs, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$tabs = json_decode($tabs,true);

?>

<?php foreach ($tabs[$sub_domain[1]]['tab_names'] as $key => $value) {

    $args = array(
      'fields'        => 'ids', //取得するのはタームID
      'slug'    => $value //名前タームの名前より
    ); 
    $parent_terms_ID = get_terms('category', $args) ; //親タームのID取得
    $parent_terms_ID = $parent_terms_ID[0];

    $args = array(
      'hide_empty'    => false, //記事がないものは取得しない
      'fields'        => 'ids', //取得するのは子タームID
      'parent'    => $parent_terms_ID //親タームのIDを指定して子タームのID情報全て取得する
   );

    $args2 = array(
      'hide_empty'    => false, //記事がないものは取得しない
      'fields'        => 'names', //取得するのは子ターム名
      'parent'    => $parent_terms_ID //親タームのIDを指定して子ターム名情報全て取得する
   );

    $terms_ids = get_terms('category', $args) ;
    $terms_names = get_terms('category', $args2) ;

?>

            <h2><?php echo $value; ?></h2>
            <p>
            <?php
                foreach ($terms_ids as $key => $value) {
                  echo '"' . $terms_names[$key] . '" ,' ;
                }
            ?>
            </p>
            <br /><br />
<?php
}

?>
