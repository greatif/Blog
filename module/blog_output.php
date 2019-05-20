<?php

/* module:blog_output V1.0 */

setlocale(LC_TIME, "de_DE.utf8");

    echo '<div class="blog-rss-abo"><a href="'.rex_geturl(REX_LINK[id=1]).'"><i class="ti-rss"></i></a></div>';

$newsDataId = UrlGenerator::getId();
$newsArticleId = $this->getValue('article_id');

$datenschutz_article_id = REX_LINK[id=2];
$datenschutz_url = rex_getUrl($datenschutz_article_id);

$art_teaser = '';
$blog = '';
$blogbeitrag = '';
$ycom_user = rex_ycom_auth::getUser();
$kommentare = '';

if ($newsDataId > 0) {
    $datas = rex_sql::factory()->getArray('SELECT * FROM rex_blog WHERE id = ? AND status = 1 OR status = 2', [$newsDataId]);
    if (count($datas)) {
        $data = current($datas);
        $datumneu = rex_formatter::format($data['datestamp'],'strftime','%A, %d.%m.%Y');

        $blogbeitrag .= '
        <div class="blog">';

            $blogbeitrag .= '
            <div class="beitrag">';
            
            if ($data['status'] == '2') {
                $blogbeitrag .= '
                <h2 class="text-center" style="font-weight: bold; color: #FF0000;">A R B E I T S V E R S I O N</h2>';
            }
            
                $blogbeitrag .= '
                <h3>' . $datumneu . '</h3>';
                $blogbeitrag .= '
                <h1>' . $data['title'] . '</h1>';
                $blogbeitrag .= '
                <p><b>von<a href="mailto:' . $data['contact'] . '"> ' . $data['author'] . '</a></b></p>';    

                if (rex_addon::get('hyphenator')->isAvailable()) {    
                    $blogbeitrag .= '
                    <p class="text-justify">' . hyphenator::hyphenate($data['contribution']) . '</p>';
                } else {
                    $blogbeitrag .= '
                    <p class="text-justify">' . $data['contribution'] . '...</p>';
                }

                $blogbeitrag .= '
            </div>';

        if ($data['images'] != '') {
            $sql = rex_sql::factory();
            $sql_query = '
                SELECT
                    id, filename, med_description
                FROM
                    rex_media
                ORDER BY id DESC';
 
            $sql->setQuery($sql_query);
 
            $blogbeitrag .= '
            <!-- Anfang PhotoSwipe -->
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Schließen (Esc)"></button>
                <button class="pswp__button pswp__button--fs" title="Vollbild"></button>
                <button class="pswp__button pswp__button--zoom" title="Vergrößern / Verkleinern"></button>
                <button class="pswp__button pswp__button--share" title="Teilen"></button>
                <!-- <button class="pswp__button pswp__button--bestellen" title="Bestellen"></button> -->

            <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                  </div>
                </div>
            </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
                <button class="pswp__button pswp__button--arrow--left" title="Zurück (Pfeil links)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Weiter (Pfeil rechts)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
            </div>
            </div>
            </div> <!-- Ende PhotoSwipe -->
            <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            <div class="row">';

                $imagelist = explode(',', $data['images']);    
                foreach ($imagelist as $file) {
                $media = rex_media::get($file);
                $description = $media->getValue('med_description');         
                $pic = rex_path::media($file);
                $size = getimagesize($pic);
                $width = $size[0];
                $height = $size[1];

                if (rex_addon::get('lazyload')->isAvailable()) {
                    $blogbeitrag .= '
                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="col-md-3 col-sm-6 gallery-item">
                            <a href="'.rex_url::base('media/'.$file.'').'" itemprop="contentUrl" data-size="'.$width.'x'.$height.'">
                            <img src="'.rex_url::base('index.php?rex_media_type=lazyimage&rex_media_file='.$file.'').'" width="100%" height="100%" itemprop="thumbnail" alt="'.$description.'" data-src="'.rex_url::base('index.php?rex_media_type=thumb&rex_media_file='.$file.'').'" class="b-lazy img-rounded img-responsive" /></a>
                            <figcaption itemprop="caption description" class="gallery-caption">'.$description.'</figcaption>
                        </figure>';
                } else {
                    $blogbeitrag .= '
                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="col-md-3 col-sm-6 gallery-item">
                            <a href="'.rex_url::base('media/'.$file.'').'" itemprop="contentUrl" data-size="'.$width.'x'.$height.'">
                            <img src="'.rex_url::base('index.php?rex_media_type=thumb&rex_media_file='.$file.'').'" itemprop="thumbnail" alt="'.$description.'" class="img-rounded img-responsive" /></a>
                            <figcaption itemprop="caption description" class="gallery-caption">'.$description.'</figcaption>
                        </figure>';                }
                
                $sql->next();
                }

            $blogbeitrag .= '</div>';
            $blogbeitrag .= '</div>';            

        }

        if ($data['youtube'] != '') {
        $blogbeitrag .= '
        <div class="youtube"><iframe src="https://www.youtube-nocookie.com/embed/' . $data['youtube'] . '?rel=0&amp;showinfo=0" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
        }

            $blogbeitrag .= '
            <div class="buttons">
            <h3><small>Diesen Artikel teilen</small></h3>
            <a class="btn btn-icon btn-fill btn-facebook" href="http://www.facebook.com/sharer/sharer.php?u=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-icon btn-fill btn-twitter" href="https://twitter.com/intent/tweet?text=' . preg_replace ( '/[^a-z0-9_ßöäüÖÄÜ ]/i', '', $data['title'] ) . '&url=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '&via=TWITTER-NAME"><i class="fa fa-twitter"></i></a>
            <a class="btn btn-icon btn-fill btn-google" href="https://plus.google.com/share?url=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><i class="fa fa-google"></i></a>
            <a class="btn btn-icon btn-fill btn-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '&title=' . preg_replace ( '/[^a-z0-9_ßöäüÖÄÜ ]/i', '', $data['title'] ) . '&summary=LINKEDIN-NAME&source=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><i class="fa fa-linkedin"></i></a>
            <a class="btn btn-icon btn-fill btn-xing" href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><i class="fa fa-xing"></i></a>
            <a class="btn btn-icon btn-fill btn-pinterest" href="http://pinterest.com/pin/create/button/?url=http://' . $_SERVER['HTTP_HOST'] . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '&description=' . preg_replace ( '/[^a-z0-9_ßöäüÖÄÜ ]/i', '', $data['title'] ) . '&media=http://' . $_SERVER['HTTP_HOST'] . '/media/' . $data['headerimage'] . '"><i class="fa fa-pinterest"></i></a>
            </div>
            <div class="buttons">
            <a href="' . rex_getUrl($newsArticleId) . '" title="Zurück zur Übersicht" alt="Übersicht"><button class="btn btn-icon"><i class="ti-control-backward"></i></button></a>
            <a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '?pdf=1" target="_blank" title="Artikel als PDF-Dokument ausgeben" alt="Als PDF-Dokument ausgeben"><button class="btn btn-icon"><i class="fa fa-file-pdf-o"></i></button></a>
            </div>';

            $blogbeitrag .= '
            </div>';

    if ($data['comments'] == '1') {
    if ($ycom_user) {

        $sql = rex_sql::factory();
        $sql_query = '
            SELECT
                firstname, name, rex_ycom_user.status, pic, comment, rex_ycom_comment.status, stamp, vorname, nachname, webseite,
                DATE_FORMAT(stamp, "%d.%m.%Y, %H:%i") as comment_date
            FROM
                rex_ycom_user, rex_ycom_comment
            WHERE
                rex_ycom_comment.article = "'.$this->article_id.'"
            AND
                rex_ycom_comment.status = "1"
            AND
                rex_ycom_comment.blogartikel_id = "'.$data['id'].'"            
            ORDER BY
                stamp DESC';

        $sql->setQuery($sql_query);

        $kommentare .= '
        <div class="section section-nude-gray" id="comments">
            <div class="media-area">
                <h3 class="text-center">Kommentare ('.$sql->getRows().')</h3>
                <hr>';

                for ($i=0; $i<$sql->getRows(); $i++) {

                    if ($sql->getValue('vorname') == '') {
                        $profile_pic = 'profile_default.png';
                            if ($sql->getValue('pic') != '') $profile_pic = $sql->getValue('pic');
                            $kommentare .= '
                                <div class="media">
                                  <div class="avatar">
                                        <img class="media-object" alt="'.$sql->getValue('firstname').' '.$sql->getValue('name').'" src="'.rex_url::base('index.php?rex_media_type=profile&rex_media_file='.$profile_pic.'').'">
                                  </div>
                                  <div class="media-body">
                                        <h5 class="media-heading">'.$sql->getValue('firstname').' '.$sql->getValue('name').'</h5>
                                        <div class="pull-right">
                                            <h6 class="text-muted">'.$sql->getValue('comment_date').'</h6>
                                        </div>

                                        <p>'.nl2br($sql->getValue('comment')).'</p>
                                  </div>
                                </div> <!-- end media -->';
                    }

                    if ($sql->getValue('vorname') != '') {
                        $profile_pic = 'profile_default.png';
                            $kommentare .= '
                                <div class="media">
                                  <div class="avatar">
                                        <img class="media-object" alt="'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'" src="'.rex_url::base('index.php?rex_media_type=profile&rex_media_file='.$profile_pic.'').'">
                                  </div>
                                  <div class="media-body">';
                                        if ($sql->getValue('webseite') != '') {
                                            $kommentare .= '<a href="http://'.$sql->getValue('webseite').'" target="_blank"><h5 class="media-heading">'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'</h5></a>';
                                        } else {
                                            $kommentare .= '<h5 class="media-heading">'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'</h5>';
                                        }
                                        $kommentare .= '<div class="pull-right">
                                            <h6 class="text-muted">'.$sql->getValue('comment_date').'</h6>
                                        </div>

                                        <p>'.nl2br($sql->getValue('comment')).'</p>
                                  </div>
                                </div> <!-- end media -->';
                    }

                    $sql->next();
                }

            $kommentare .= '
            </div> <!-- end media-area -->
        </div>
        <div id="comments-end"></div>';

        // Formulare zeigen
        $yform = new rex_yform();
        $yform->setObjectparams('form_skin', 'bootstrap');
        $yform->setObjectparams('form_anchor', 'comments-end');
        $yform->setObjectparams('form_showformafterupdate', 0);
        $yform->setObjectparams('real_field_names', true);
        $yform->setObjectparams('form_action', rex_getUrl($newsArticleId, '', ['id' => $data['id']]));

        $yform->setValueField('hidden', array("article", $this->article_id));
        $yform->setValueField('hidden', array("blogartikel_id", $data['id']));
        $yform->setValueField('hidden', array("user_id", rex_ycom_auth::getUser()->getValue('id')));
        $yform->setValueField('hidden', array("vorname", rex_ycom_auth::getUser()->getValue('firstname')));
        $yform->setValueField('hidden', array("nachname", rex_ycom_auth::getUser()->getValue('name')));
        $yform->setValueField('hidden', array("status", "1"));
        $yform->setValueField('hidden', array("stamp", date("YmdHis")));

        $yform->setValueField('textarea', array("comment","Kommentar schreiben"));
        $yform->setValidateField('empty', array("comment","Bitte Kommentar eingeben"));

        $yform->setActionField('db', array('rex_ycom_comment'));
        // ggf. Kommentar auch an Admin senden:
        // $yform->setActionField('email', array('absender@email.de', 'empfaenger@email.de', 'Neuer Kommentar von ###vorname### ###nachname###', '###comment###'));
        $yform->setActionField('showtext', array("Kommentar wurde hinzugefügt.",'<div class="alert alert-success">',"</div>","1"));
        $kommentare .= $yform->getForm();
    }

    if ($ycom_user == '') {
        $sql = rex_sql::factory();
        $sql_query = '
            SELECT
                firstname, name, pic, comment, rex_ycom_comment.status, stamp, vorname, nachname, emailadresse, webseite, blogartikel_id,
                DATE_FORMAT(stamp, "%d.%m.%Y, %H:%i") as comment_date
            FROM
                rex_ycom_user, rex_ycom_comment
            WHERE
                rex_ycom_comment.article = "'.$this->article_id.'"
            AND
                rex_ycom_comment.status = "1"
            AND
                rex_ycom_comment.blogartikel_id = "'.$data['id'].'"            
            ORDER BY
                stamp DESC';

        $sql->setQuery($sql_query);

        $kommentare .= '
        <div class="section section-nude-gray" id="comments">
            <div class="media-area">
                <h3 class="text-center">'.$sql->getRows().' Kommentare</h3>
                <hr>';

                for ($i=0; $i<$sql->getRows(); $i++) {

                    if ($sql->getValue('vorname') != '') {
                        $profile_pic = 'profile_default.png';

                            $kommentare .= '
                            <div class="media">
                                  <div class="avatar">
                                        <img class="media-object" alt="'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'" src="'.rex_url::base('index.php?rex_media_type=profile&rex_media_file='.$profile_pic.'').'">
                                  </div>
                                  <div class="media-body">';
                                        if ($sql->getValue('webseite') != '') {
                                            $kommentare .= '<a href="http://'.$sql->getValue('webseite').'" target="_blank"><h5 class="media-heading">'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'</h5></a>';
                                        } else {
                                            $kommentare .= '<h5 class="media-heading">'.$sql->getValue('vorname').' '.$sql->getValue('nachname').'</h5>';
                                        }
                                        $kommentare .= '<div class="pull-right">
                                            <h6 class="text-muted">'.$sql->getValue('comment_date').'</h6>
                                        </div>

                                        <p>'.nl2br($sql->getValue('comment')).'</p>

                                  </div>
                            </div> <!-- end media -->';
                    }
                    
                    if ($sql->getValue('vorname') == '') {
                        $profile_pic = 'profile_default.png';
                        if ($sql->getValue('pic') != '') $profile_pic = $sql->getValue('pic');

                            $kommentare .= '
                            <div class="media">
                                  <div class="avatar">
                                        <img class="media-object" alt="'.$sql->getValue('firstname').' '.$sql->getValue('name').'" src="'.rex_url::base('index.php?rex_media_type=profile&rex_media_file='.$profile_pic.'').'">
                                  </div>
                                  <div class="media-body">
                                        <h5 class="media-heading">'.$sql->getValue('firstname').' '.$sql->getValue('name').'</h5>
                                        <div class="pull-right">
                                            <h6 class="text-muted">'.$sql->getValue('comment_date').'</h6>
                                        </div>

                                        <p>'.nl2br($sql->getValue('comment')).'</p>

                                  </div>
                            </div> <!-- end media -->';
                    }
                
                    $sql->next();
                }

            $kommentare .= '
            </div> <!-- end media-area -->
        </div>
        <div id="comments-end"></div>';
        
        // Formulare zeigen
        $yform = new rex_yform();
        $yform->setObjectparams('form_skin', 'bootstrap');
        $yform->setObjectparams('form_anchor', 'comments-end');
        $yform->setObjectparams('form_showformafterupdate', 0);
        $yform->setObjectparams('real_field_names', true);
        $yform->setObjectparams('form_action', rex_getUrl($newsArticleId, '', ['id' => $data['id']]));

        $yform->setValueField('hidden', array("article", $this->article_id));
        $yform->setValueField('hidden', array("blogartikel_id", $data['id']));
        $yform->setValueField('hidden', array("status", "0"));
        $yform->setValueField('hidden', array("stamp", date("YmdHis")));

        $yform->setValueField('fieldset', array("kommentar", "Kommentar schreiben"));
        $yform->setValueField('html', array("pflichtangaben", "<b><i>* Pflichtangaben</i></b><br /><br />"));
        
        $yform->setValueField('ip', array("ip"));

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-12 col-md-12" style="padding: 5px;">'));            
        $yform->setValueField('textarea', array("comment","#placeholder:Kommentar schreiben","Kommentar: *"));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));
        $yform->setValidateField('empty', array("comment","Bitte Kommentar schreiben!"));

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-6 col-md-3" style="padding: 5px;">'));        
        $yform->setValueField('text', array("vorname","#placeholder:Vorname","Vorname: *"));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));
        $yform->setValidateField('empty', array("vorname","Bitte Vorname eingeben!"));

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-6 col-md-3" style="padding: 5px;">'));
        $yform->setValueField('text', array("nachname","#placeholder:Nachname","Nachname: *"));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));
        $yform->setValidateField('empty', array("nachname","Bitte Nachname eingeben!"));

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-6 col-md-3" style="padding: 5px;">'));
        $yform->setValueField('text', array("emailadresse","#placeholder:wird nicht veröffentlicht","E-Mail-Adresse: *"));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));
        $yform->setValidateField('empty', array("emailadresse","Bitte Email-Adresse angeben!"));            
        $yform->setValidateField('email', array("emailadresse","Bitte eine korrekte Email-Adresse angeben!"));        

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-6 col-md-3" style="padding: 5px;">'));
        $yform->setValueField('text', array("webseite","#placeholder:ohne http://","Webseite"));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));        

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-12 col-md-12" style="padding: 5px;">'));
        $yform->setValueField('checkbox', array('checkbox_dsgvo','Ich habe die <a href="'.$datenschutz_url.'" target="_blank">Datenschutzerklärung</a> zur Kenntnis genommen. Ich stimme zu, dass meine Angaben und Daten elektronisch erhoben und gespeichert werden.','0,1','0','no_db'));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));
        $yform->setValidateField('empty', array('checkbox_dsgvo','Bitte bestätigen Sie, dass Sie die Datenschutzerklärung zur Kenntnis genommen haben und stimmen Sie der elektronischen Verwendung Ihrer Daten zur Beantwortung Ihrer Anfrage zu.'));

        $yform->setValueField('html', array('opendiv','openDIV','<div id="customizeddiv" class="col-xs-12 col-sm-12 col-md-12" style="padding: 5px;">'));
        $yform->setValueField('captcha', array("Bitte Sicherheitscode eingeben","Falscher Sicherheitscode", rex_getUrl($newsArticleId, '', ['id' => $data['id']])));
        $yform->setValueField('html', array('closediv','closeDIV','</div>'));        

        // Spamschutz
        // function "yform_validate_timer" in /addons/project/boot.php
        // $yform->setValueField('text', array("botkontrolle","#placeholder: E-Mail-Adresse wiederholen (wird nicht veröffentlicht)","Sicherheitseingabe: *", "", 'no_db'));
        // $yform->setValidateField('compare', array("emailadresse","botkontrolle","!=", "Sicherheitsüberprüfung fehlgeschlagen!"));
        $yform->setValueField('php', array("validate_timer","spamschutz","<?php echo '<input name=\"validate_timer\" type=\"hidden\" value=\"'.microtime(true).'\" />' ?>"));
        $yform->setValidateField('customfunction', array('validate_timer', 'yform_validate_timer', '5', 'Spam-Bots haben keine Chance!'));        
        
        $yform->setActionField('db', array('rex_ycom_comment'));
        
        // ggf. Kommentar auch an Admin senden:
        // $yform->setActionField('email', array('absender@email.de', 'empfaenger@email.de', 'Neuer Kommentar von ###vorname### ###nachname###', '###ip### ###emailadresse### ###comment###'));

        $yform->setActionField('showtext', array("Ihr Kommentar wurde gespeichert und wird nach Überprüfung veröffentlicht.",'<div class="alert alert-success">',"</div>","1"));
        $kommentare .= $yform->getForm();
    }

        $blogbeitrag .= $kommentare;
    }
        echo $blogbeitrag;
    }
} else {
    $datas = rex_sql::factory()->getArray('SELECT * FROM rex_blog ORDER BY id DESC');
    if (count($datas)) {
        $blog .= '    
        <div class="row">';
        foreach ($datas as $data) {
            if ($data['status'] == '1') {
        
                $datumneu = rex_formatter::format($data['datestamp'],'strftime','%A, %d.%m.%Y');
                $art_teaser = strip_tags(substr($data['contribution'], 3, 150));
            $blog .= '
            <div class="col-md-3 col-sm-6">';
            $blog .= '
            <div class="blogbeitrag">';

            if (rex_addon::get('lazyload')->isAvailable()) {
                if (rex_addon::get('hyphenator')->isAvailable()) {        
                    $blog .= '
                    <div class="head"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><h1>' . $datumneu . '<br />' . $data['title'] . '</h1><img class="image b-lazy" src="index.php?rex_media_type=lazyimage&rex_media_file=' . $data['headerimage'] . '" width="100%" height="100%" alt="' . $data['title'] . '" data-src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . hyphenator::hyphenate($art_teaser) . '...</p></div><div class="text-center"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
                } else {
                    $blog .= '
                    <div class="head"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><h1>' . $datumneu . '<br />' . $data['title'] . '</h1><img class="image b-lazy" src="index.php?rex_media_type=lazyimage&rex_media_file=' . $data['headerimage'] . '" width="100%" height="100%" alt="' . $data['title'] . '" data-src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . $art_teaser . '...</p></div><div class="text-center"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
                }
            } else {
                if (rex_addon::get('hyphenator')->isAvailable()) {        
                    $blog .= '
                    <div class="head"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><h1>' . $datumneu . '<br />' . $data['title'] . '</h1><img class="image" src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '" alt="' . $data['title'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . hyphenator::hyphenate($art_teaser) . '...</p></div><div class="text-center"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
                } else {
                    $blog .= '
                    <div class="head"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><h1>' . $datumneu . '<br />' . $data['title'] . '</h1><img class="image" src="index.php?rex_media_type=thumb&rex_media_file=' . $data['headerimage'] . '" alt="' . $data['title'] . '"></a></div><div class="equal-height-REX_SLICE_ID"><p>' . $art_teaser . '...</p></div><div class="text-center"><a href="' . rex_getUrl($newsArticleId, '', ['id' => $data['id']]) . '"><button class="btn btn-icon"><i class="ti-book"></i> Weiterlesen</button></a></div>';
                }
            }

            $blog .= '
            </div></div>';

            }
        }
        $blog .= '
        </div>';
        
    if (rex::isBackend()) {
        echo 'Blog-Modul';
        echo '<div id="backend" style="display:none;">';
    }
    echo $blog;
        if (rex::isBackend()) {
        echo '</div>';
    }
    }
}
?>

<script>
$(function() {
    $('.equal-height-REX_SLICE_ID').matchHeight();
});
</script>
