<?php

// Url zum Feed
$base='http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; 

// Document Header definieren
$xml = new SimpleXMLElement('<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');


// Channel.Deklaration 
$channel = $xml->addChild("channel");

$xml->addAttribute('version', '2.0'); 
$atom = $xml->channel->addChild('atom:atom:link'); //atom node
$atom->addAttribute('href', $base); // atom node attribut
$atom->addAttribute('rel', 'self');
$atom->addAttribute('type', 'application/rss+xml');

$channel->addChild("title", "REX_VALUE[2]");
$channel->addChild("link", 'http://' . $_SERVER['HTTP_HOST'] . $url);
$channel->addChild("description", "REX_VALUE[3]");
$channel->addChild("language", "de-de");
$channel->addChild('generator', 'REDAXO rss'); // generator node

$newsDataId = UrlGenerator::getId();
$newsArticleId = REX_LINK[id=1];
$datas = rex_sql::factory()->getArray('SELECT * FROM rex_blog ORDER BY id DESC');

	if (count($datas)) {
        foreach ($datas as $data) {
			if ($data['status'] == 1 ) {
				$item  = $channel->addChild("item");
				$artId = $data['id'];
				// Ermitteln der URL des Posting-Artikels
				$url   = rex_getUrl($newsArticleId, '', ['id' => $data['id']]);
				$item->addChild("title", $data['title']);
				$item->addChild("link", 'http://' . $_SERVER['HTTP_HOST'] . $url);
				$item->addChild("guid", 'http://' . $_SERVER['HTTP_HOST'] . $url);
				// Datum und Uhrezeit des Postings
				$rssdate = date("D, d M Y H:i:s +0100", $data['datestamp']);
				$item->addChild('pubDate', $data['datestamp']);
				$contribution = htmlspecialchars(trim(strip_tags(substr($data['contribution'], 0, 500))));
				if ($data['headerimage'] != '' ) {
					$item->addChild("description", '<img width="300" height="200" src="http://'.$_SERVER[HTTP_HOST].'/media/'.$data['headerimage'].'"></img><br />'.$contribution . '...');
				} else {
					$item->addChild("description", $contribution . '...');
				}
			}
		}
	}

// Ausgabe des RSS-Feeds
echo $xml->asXML();
?>
