<?php

require('../include/mellivora.inc.php');

$cache = new Cache_Lite_Output(array('cacheDir'=>CONFIG_PATH_CACHE, 'lifeTime'=>CONFIG_CACHE_TIME_HOME));
if (!($cache->start('home'))) {

    require(CONFIG_PATH_THIRDPARTY . 'nbbc/nbbc.php');

    head('Home');

    $bbc = new BBCode();
    $bbc->SetEnableSmileys(false);

    $stmt = $db->query('SELECT * FROM news ORDER BY added DESC');
    while($news = $stmt->fetch(PDO::FETCH_ASSOC)) {
        section_head($news['title']);
        echo $bbc->parse($news['body']);
    }

    foot();

    $cache->end();
}