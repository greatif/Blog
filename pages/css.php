<?php

$css = rex_file::get(rex_path::addon('blog') . "css/css.php");

$content = '
<p class="headline">' . rex_i18n::msg('blog_css') . '</p><pre class="rex-code"><code>' . blog_parsedown::highlight($css) . '</code></pre>';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('CSS'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
