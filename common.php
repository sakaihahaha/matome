
<?php
define('MAGPIE_DIR', './magpierss/'); 

// キャッシュディレクトリ
define('MAGPIE_CACHE_DIR', './cache');

// キャッシュ時間（秒）
define('MAGPIE_CACHE_AGE', 60*1);

// 文字コード指定
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');  // 日本語の文字化けを防ぐ
 
// MagpieRSS読み込み

require_once(MAGPIE_DIR.'rss_fetch.inc');   //rss_cache.incとrss_parse.incはここからrequire_onceされる
require_once(MAGPIE_DIR.'rss_utils.inc');
require_once("Pager/Pager.php");

$site_list = array(
    "http://hamusoku.com/index.rdf",
    "http://alfalfalfa.com/index.rdf",
    "http://labaq.com/index.rdf",
    "http://blog.livedoor.jp/insidears/index.rdf"
    );
$site_count_num = count($site_list);//総サイト数
$per_page = 3;//1ページに表示するサイト数
$delta = ceil($site_count_num/$per_page);//ページャーのインデックス数
$options =array(
    "totalItems"=>$site_count_num,
    "delta"=>$delta,  //ページ数
    "perPage"=>$per_page,  //1ページに表示するサイト数
    "fileName"=>"table.php"
    );

$pager=Pager::factory($options);


if(isset($_GET["pageID"])){
    $page_num = $_GET["pageID"];
    $loop_key = ($page_num * $per_page) - $per_page;
    $end_key = $page_num * $per_page;
    ($page_num * $per_page >= $site_count_num ? $end_key = $site_count_num : $end_key = $page_num * $per_page);
}else{
    $loop_key = 0;
    $end_key = $per_page;
}

//表示ページの分だけサイト情報を取得
for ($i = $loop_key; $i <$end_key ; $i++) { 
   $rss_obj[$i] = fetch_rss($site_list[$i]);
}
//foreach ($site_list as $key => $val) {
//    $rss_obj[] = fetch_rss($val);
//}
//print_r($rss_obj);exit;

///for文で表示ページ分だけループさせる。
for ($i=$loop_key; $i < $end_key; $i++ ) {
    $site[$rss_obj[$i]->channel["title"]] = $rss_obj[$i]->channel["title"];
    $site_link[$rss_obj[$i]->channel["title"]] = $rss_obj[$i]->channel["link"];
    
    //一つのサイトから8件の記事を取得。
    for($j = 0; $j < 8; $j++){
        $title =htmlspecialchars($rss_obj[$i]->items[$j]["title"]);
        $data[$rss_obj[$i]->channel["title"]][$j]["title"] = mb_substr($title, 0, 36, 'utf-8');
        $data[$rss_obj[$i]->channel["title"]][$j]["page_url"] = htmlspecialchars($rss_obj[$i]->items[$j]["link"]);
        
        //画像があればimgタグを代入。なければ説明文を代入。
        if(preg_match('|src="(.*?).jpg"|i',$rss_obj[$i]->items[$j]["content"]["encoded"], $match)){
            $data[$rss_obj[$i]->channel["title"]][$j]["img"] = '<img src="'.$match[1].'.jpg" width="195" />';
        } else {
            $description = htmlspecialchars($rss_obj[$i]->items[$i]["description"]);
            $data[$rss_obj[$i]->channel["title"]][$j]["description"] = mb_substr($description , 0, 104, 'utf-8');
            $data[$rss_obj[$i]->channel["title"]][$j]["img"] = '<h3>'.$data[$rss_obj[$i]->channel["title"]][$j]["description"] .'</h3>';
        }
    }
}
//print_r($data);exit;
?>
