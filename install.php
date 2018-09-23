<?php
/**
 * @author kontakt[at]greatif[dot]de
 * @package redaxo5
 * @license MIT
 */

/** @var rex_addon $this */
// install blog database
rex_sql_table::get(rex::getTable('blog'))
    ->ensureColumn(new rex_sql_column('id', 'int(11)', false, null, 'auto_increment'))
    ->ensureColumn(new rex_sql_column('datestamp', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('title', 'text'))
    ->ensureColumn(new rex_sql_column('author', 'text'))
    ->ensureColumn(new rex_sql_column('contribution', 'text'))
    ->ensureColumn(new rex_sql_column('headerimage', 'text'))
    ->ensureColumn(new rex_sql_column('images', 'text'))
    ->ensureColumn(new rex_sql_column('youtube', 'text'))
    ->ensureColumn(new rex_sql_column('contact', 'text'))
    ->ensureColumn(new rex_sql_column('description', 'text'))
    ->ensureColumn(new rex_sql_column('comments', 'text'))
    ->ensureColumn(new rex_sql_column('status', 'text'))
    ->setPrimaryKey('id')
    ->ensure();

rex_sql_table::get(rex::getTable('yform_field'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('table_name', 'varchar(100)'))
    ->ensureColumn(new rex_sql_column('prio', 'int(11)'))
    ->ensureColumn(new rex_sql_column('type_id', 'varchar(100)'))
    ->ensureColumn(new rex_sql_column('type_name', 'varchar(100)'))
    ->ensureColumn(new rex_sql_column('list_hidden', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('search', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('name', 'text'))
    ->ensureColumn(new rex_sql_column('label', 'text'))
    ->ensureColumn(new rex_sql_column('options', 'text'))
    ->ensureColumn(new rex_sql_column('multiple', 'text'))
    ->ensureColumn(new rex_sql_column('default', 'text'))
    ->ensureColumn(new rex_sql_column('size', 'text'))
    ->ensureColumn(new rex_sql_column('only_empty', 'text'))
    ->ensureColumn(new rex_sql_column('message', 'text'))
    ->ensureColumn(new rex_sql_column('table', 'text'))
    ->ensureColumn(new rex_sql_column('field', 'text'))
    ->ensureColumn(new rex_sql_column('type', 'text'))
    ->ensureColumn(new rex_sql_column('empty_option', 'text'))
    ->ensureColumn(new rex_sql_column('types', 'text'))
    ->ensureColumn(new rex_sql_column('fields', 'text'))
    ->ensureColumn(new rex_sql_column('address', 'text'))
    ->ensureColumn(new rex_sql_column('width', 'text'))
    ->ensureColumn(new rex_sql_column('height', 'text'))
    ->ensureColumn(new rex_sql_column('attributes', 'text'))
    ->ensureColumn(new rex_sql_column('preview', 'text'))
    ->ensureColumn(new rex_sql_column('category', 'text'))
    ->ensureColumn(new rex_sql_column('values', 'text'))
    ->ensureColumn(new rex_sql_column('format', 'text'))
    ->ensureColumn(new rex_sql_column('show_value', 'text'))
    ->ensureColumn(new rex_sql_column('html', 'text'))
    ->ensureColumn(new rex_sql_column('notice', 'text'))
    ->ensureColumn(new rex_sql_column('rules', 'text'))
    ->ensureColumn(new rex_sql_column('script', 'text'))
    ->ensure();

// install comments database
rex_sql_table::get(rex::getTable('ycom_comment'))
    ->ensureColumn(new rex_sql_column('id', 'int(11)', false, null, 'auto_increment'))
    ->ensureColumn(new rex_sql_column('comment', 'text'))
    ->ensureColumn(new rex_sql_column('user_id', 'text'))
    ->ensureColumn(new rex_sql_column('status', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('article', 'text'))
    ->ensureColumn(new rex_sql_column('stamp', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('vorname', 'text'))
    ->ensureColumn(new rex_sql_column('nachname', 'text'))
    ->ensureColumn(new rex_sql_column('emailadresse', 'text'))
    ->ensureColumn(new rex_sql_column('webseite', 'text'))
    ->ensureColumn(new rex_sql_column('blogartikel_id', 'text'))
    ->setPrimaryKey('id')
    ->ensure();

// add column "med_description" to table "media"
rex_sql_table::get(rex::getTable('media'))
    ->ensureColumn(new rex_sql_column('med_description', 'text', 'NULL'))
    ->alter();

// install data entries
$sql = rex_sql::factory();
if (sizeof($sql->getArray("SELECT id FROM " . rex::getTable('metainfo_field') . " WHERE title='Beschreibung'")) <= 0) {
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/metainfo_field.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }
}
if (sizeof($sql->getArray("SELECT id FROM " . rex::getTable('yform_table') . " WHERE table_name='rex_blog'")) <= 0) {
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/yform_table_blog.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }
}
if (sizeof($sql->getArray("SELECT id FROM " . rex::getTable('yform_table') . " WHERE table_name='rex_ycom_comment'")) <= 0) {
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/yform_table_ycom_comment.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }
}
if (sizeof($sql->getArray("SELECT id FROM " . rex::getTable('yform_field') . " WHERE table_name='rex_blog'")) <= 0) {
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/yform_field_blog.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }
}
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/yform_field_ycom_comment_complete.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }

if (sizeof($sql->getArray("SELECT id FROM " . rex::getTable('url_generate') . " WHERE rex_url_generate.table='1_xxx_rex_blog'")) <= 0) {
    try {
        $sql = rex_sql::factory();
        rex_sql_util::importDump($this->getPath('dump/url_generate.sql'));
    } catch (rex_sql_exception $e) {
        rex_logger::logException($e);
        print rex_view::error($e->getMessage());
    }
}

// installie Blog Modul
$content = '';
$search_modul_blog = 'module:blog_output';

$blogmodule = rex_sql::factory();
$blogmodule->setQuery('select * from rex_module where output LIKE "%' . $search_modul_blog . '%"');

$module_id = 0;
$module_name = '';
foreach ($blogmodule->getArray() as $module) {
    $module_id = $module['id'];
    $module_name = $module['name'];
}

$yform_module_name = 'Blog';

$input = rex_file::get(rex_path::addon('blog', 'module/blog_input.php'));
$output = rex_file::get(rex_path::addon('blog', 'module/blog_output.php'));

$mi = rex_sql::factory();
$mi->setTable('rex_module');
$mi->setValue('input', $input);
$mi->setValue('output', $output);

if ($module_name == $yform_module_name) {
    $mi->setWhere('id="' . $module_id . '"');
    $mi->update();
} else {
    $mi->setValue('name', $yform_module_name);
    $mi->insert();
    $module_id = (int)$mi->getLastId();
    $module_name = $yform_module_name;
}

// install Blog-Teaser Modul
$content = '';
$search_modul_blogteaser = 'module:blog-teaser_output';

$blogteasermodule = rex_sql::factory();
$blogteasermodule->setQuery('select * from rex_module where output LIKE "%' . $search_modul_blogteaser . '%"');

$module_id = 0;
$module_name = '';
foreach ($blogteasermodule->getArray() as $module) {
    $module_id = $module['id'];
    $module_name = $module['name'];
}

$yform_module_name = 'Blog-Teaser';

$input = rex_file::get(rex_path::addon('blog', 'module/blog-teaser_input.php'));
$output = rex_file::get(rex_path::addon('blog', 'module/blog-teaser_output.php'));

$mi = rex_sql::factory();
$mi->setTable('rex_module');
$mi->setValue('input', $input);
$mi->setValue('output', $output);

if ($module_name == $yform_module_name) {
    $mi->setWhere('id="' . $module_id . '"');
    $mi->update();
} else {
    $mi->setValue('name', $yform_module_name);
    $mi->insert();
    $module_id = (int)$mi->getLastId();
    $module_name = $yform_module_name;
}

// installie Blog RSS-Feed Modul
$content = '';
$search_modul_blog_rssfeed = 'module:blog-rssfeed_output';

$blogrssmodule = rex_sql::factory();
$blogrssmodule->setQuery('select * from rex_module where output LIKE "%' . $search_modul_blog_rssfeed . '%"');

$module_id = 0;
$module_name = '';
foreach ($blogrssmodule->getArray() as $module) {
    $module_id = $module['id'];
    $module_name = $module['name'];
}

$yform_module_name = 'Blog - RSS-Feed';

$input = rex_file::get(rex_path::addon('blog', 'module/rss-feed_input.php'));
$output = rex_file::get(rex_path::addon('blog', 'module/rss-feed_output.php'));

$mi = rex_sql::factory();
$mi->setTable('rex_module');
$mi->setValue('input', $input);
$mi->setValue('output', $output);

if ($module_name == $yform_module_name) {
    $mi->setWhere('id="' . $module_id . '"');
    $mi->update();
} else {
    $mi->setValue('name', $yform_module_name);
    $mi->insert();
    $module_id = (int)$mi->getLastId();
    $module_name = $yform_module_name;
}

// installie RSS-Feed Template
$content = '';
$attributes ='{"ctype":[],"modules":{"1":{"all":"1"}},"categories":{"all":"1"}}';
$active = '1';
$search_template_blog_rssfeed = 'template:blog_rssfeed';

$blogrsstemplate = rex_sql::factory();
$blogrsstemplate->setQuery('select * from rex_template where content LIKE "%' . $search_template_blog_rssfeed . '%"');

$template_id = 0;
$template_name = '';
foreach ($blogrsstemplate->getArray() as $template) {
    $template_id = $template['id'];
    $template_name = $template['name'];
}

$yform_template_name = 'Blog - RSS-Feed';

$content = rex_file::get(rex_path::addon('blog', 'templates/template-rss.php'));

$ti = rex_sql::factory();
$ti->setTable('rex_template');
$ti->setValue('content', $content);
$ti->setValue('attributes', $attributes);
$ti->setValue('active', $active);

if ($template_name == $yform_template_name) {
    $ti->setWhere('id="' . $template_id . '"');
    $ti->update();
} else {
    $ti->setValue('name', $yform_template_name);
    $ti->insert();
    $template_id = (int)$ti->getLastId();
    $template_name = $yform_template_name;
}
