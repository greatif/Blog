<?php

$blog_article_id = REX_LINK[id=1];
$blog_url = rex_getUrl($blog_article_id);

$newsDataId = UrlGenerator::getId();
$art_teaser = '';
$blog = '';
$zaehler = '1';
$ausgaben = REX_VALUE[1];

    $datas = rex_sql::factory()->getArray('SELECT * FROM rex_blog ORDER BY id DESC');
    if (count($datas)) {
		$blog .= '	
		<div class="row">';
		$blog .= '			
		<hr /><a href="'.$blog_url.'"><h2 class="text-center title-uppercase">Blog</h2></a><br>';
        foreach ($datas as $data) {
			if ($data['status'] == '1' && $zaehler <= $ausgaben) {
				$datumneu = new DateTime($data['datestamp']);
				$art_teaser = strip_tags(substr($data['contribution'], 3, 300));
				$blog .= '
				<div class="col-md-6 col-sm-6">';
				$blog .= '
				<div class="blogbeitrag">';

				if (rex_addon::get('lazyload')->isAvailable()) {
					if (rex_addon::get('hyphenator')->isAvailable()) {	
						$blog .= '
						<div class="head teaser"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><h1>' . $datumneu->format('d.m.Y') . '<br />' . $data['title'] . '</h1><img class="b-lazy" src="index.php?rex_media_type=lazyimage&rex_media_file=' . $data['headerimage'] . '" width="100%" height="100%" alt="' . $data['title'] . '" data-src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . hyphenator::hyphenate($art_teaser) . '...</p></div><div class="text-center"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
					} else {
						$blog .= '
						<div class="head teaser"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><h1>' . $datumneu->format('d.m.Y') . '<br />' . $data['title'] . '</h1><img class="image b-lazy" src="index.php?rex_media_type=lazyimage&rex_media_file=' . $data['headerimage'] . '" width="100%" height="100%" alt="' . $data['title'] . '" data-src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . $art_teaser . '...</p></div><div class="text-center"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
					}		
				} else {
					if (rex_addon::get('hyphenator')->isAvailable()) {	
						$blog .= '
						<div class="head teaser"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><h1>' . $datumneu->format('d.m.Y') . '<br />' . $data['title'] . '</h1><img class="image" src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '" alt="' . $data['title'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . hyphenator::hyphenate($art_teaser) . '...</p></div><div class="text-center"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
					} else {
						$blog .= '
						<div class="head teaser"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><h1>' . $datumneu->format('d.m.Y') . '<br />' . $data['title'] . '</h1><img class="image" src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '" alt="' . $data['title'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . $art_teaser . '...</p></div><div class="text-center"><a href="' . rex_getUrl($blog_article_id, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
					}
				}
		
				$blog .= '
				</div></div>';
				$zaehler++;	
			}
        }
		$blog .= '
		</div>';
		
	if (rex::isBackend()) {
		echo 'Blog-Teaser';
		echo '<div id="backend" style="display:none;">';
	}
	echo $blog;
		if (rex::isBackend()) {
		echo '</div>';
	}
    }
	
?>

<script>
$(function() {
    $('.equal-height-REX_SLICE_ID').matchHeight();
});
</script>
