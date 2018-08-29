<?php

$moduleInput = rex_file::get(rex_path::addon('blog') . "module/rss-feed_input.php");
$moduleOutput = rex_file::get(rex_path::addon('blog') . "module/rss-feed_output.php");

$content = '
<p class="headline">' . rex_i18n::msg('blog_module_input') . '</p><pre class="rex-code"><code>' . blog_parsedown::highlight($moduleInput) . '</code></pre>
<br />
<p class="headline">' . rex_i18n::msg('blog_module_output') . '</p><pre class="rex-code"><code>' . blog_parsedown::highlight($moduleOutput) . '</code></pre>';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('module'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');