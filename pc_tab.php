<!--pc_tab_start-->
<script type="text/javascript">

$(function() {

    $("#tab li").click(function() {
        var num = $("#tab li").index(this);
        $(".content_wrap").addClass('disnon');
        $(".content_wrap").eq(num).removeClass('disnon');
        $("#tab li").removeClass('select');
        $(this).addClass('select')
    });

    $("#tab li:last-child").css("border-right","none");

});

$(function() {//クッキーから直前のタブ選択情報を取得してclass操作 pc_tab2.phpにも影響する

    var tab_active_cookie = $.cookie("<?php echo $sub_domain[1]; ?>_tab_active") ;

    if(tab_active_cookie != null){
        $(".parenttab_" + tab_active_cookie ).addClass("select");
        $(".tab_" + tab_active_cookie ).removeClass("disnon");
    }else{
        $(".parenttab_0").addClass("select");
        $(".tab_0").removeClass("disnon");
    }

});

function tab_active(get_tab_number){//タブ選択情報をクッキーに保存  pc_tab2.phpにも影響する

  $.removeCookie("<?php echo $sub_domain[1]; ?>_tab_active");//cookie削除

  var date=new Date();
  date.setTime(date.getTime() + (60 * 1000));//単位ミリ秒
  $.cookie("<?php echo $sub_domain[1]; ?>_tab_active", get_tab_number, { 
  expires: date,
  path:"/",
  domain:location.hostname
  });

}

</script>

<?php

$tabs = file_get_contents( "../json/tabs.json");
$tabs = mb_convert_encoding($tabs, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$tabs = json_decode($tabs,true);

$ga_pop_cate_json = file_get_contents( "../ga/pop_categorys.json");
$ga_pop_cate_json = mb_convert_encoding($ga_pop_cate_json , 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$ga_pop_cate_json = json_decode($ga_pop_cate_json,true);

$ga_tab_cate_json = file_get_contents( "../ga/tab_categorys_list.json");
$ga_tab_cate_json = mb_convert_encoding($ga_tab_cate_json , 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$ga_tab_cate_json = json_decode($ga_tab_cate_json,true);

?>

<div class="cat_box <?php echo "tab" . $tabs[$sub_domain[1]]['tab_number']; ?>">

    <ul id="tab" class="clearfix">
        <!--<li class="parenttab_pickup" onclick="tab_active(0)">pickup</li>-->
        <?php
          foreach ($tabs[$sub_domain[1]]['tab_names'] as $key => $value) {
            echo '<li class="parenttab_' . $key . '" onclick="tab_active(' . $key . ');">' . $value . '</li>' ;
          }
        ?>
    </ul>

<?php foreach ($tabs[$sub_domain[1]]['tab_names'] as $key => $value) {

    $args = array(
      'fields'        => 'ids', //取得するのはタームID
      'slug'    => $value //名前タームの名前より
    ); 
    $parent_terms_ID = get_terms('category', $args) ; //親タームのID取得
    $parent_terms_ID = $parent_terms_ID[0];

    $args = array(
      'hide_empty'    => false, //記事がないものは取得しない
      'orderby'       => 'count',//記事数でソート
      'order'        => 'DESC',//降順
      'fields'        => 'ids', //取得するのは子タームID
      'number'        => 50,
      'parent'    => $parent_terms_ID //親タームのIDを指定して子タームのID情報全て取得する
   );

    $args2 = array(
      'hide_empty'    => false, //記事がないものは取得しない
      'orderby'       => 'count',//記事数でソート
      'order'        => 'DESC',//降順
      'fields'        => 'names', //取得するのは子ターム名
      'number'        => 50,
      'parent'    => $parent_terms_ID //親タームのIDを指定して子ターム名情報全て取得する
   );

    $terms_ids = get_terms('category', $args) ;
    $terms_names = get_terms('category', $args2) ;

?>

      <div class="content_wrap tab_<?php echo $key ; ?> disnon">
        <ul class="clearfix">
          <?php
            if($value == 'pickup'){ //pickup（総合人気順）の抽出
                foreach ($ga_pop_cate_json as $key => $value) {
                  echo '<li><a href="/category/'. $value[1] .'/' . $value[0] .'">' . $value[0] . '</a></li>' ;
                }
            }else{ ?> 
                <li><a href="<?php echo get_category_link( $parent_terms_ID ); ?>"><?php echo $value; ?></a></li>
                <?php
                    $count = 0 ;
                    foreach ($ga_tab_cate_json[$value] as $key => $value2) { //各タブカテの人気順をあるだけ出す
                      echo '<li><a href="/category/' . $value . '/' . $value2 . '">' . $value2 . '</a></li>' ;
                      $count++;
                      if($count == 50){ break; }
                    }
                      $tab_cate_count = count($ga_tab_cate_json[$value]);
                      if($tab_cate_count < 50){
                          $tab_cate_count = 50 - $tab_cate_count; //50までどれくらい足りないかの数に変更する
                          $i = 0;
                          foreach ($terms_ids as $key => $value3) { //数が少ない場合は、クリックされていないモノを記事数順に出す
                            if( array_search($terms_names[$key],$ga_tab_cate_json[$value]) === false ){
                                echo '<li><a href="' . get_category_link( $value3 ) .'">' . $terms_names[$key] . '</a></li>' ;
                                $i++;
                            }
                            if($i == $tab_cate_count){ break; } //
                          }
                      }
                ?>
          <?php } ?>
        </ul>
      </div>

<?php
}
?>
</div>
<!--pc_tab_end-->