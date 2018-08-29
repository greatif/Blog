<?php
/**
 * @author kontakt[at]greatif[dot]de Joachim Doerr
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

// install yform-tables database
rex_sql_table::get(rex::getTable('yform_table'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('status', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('table_name', 'varchar(100)'))
    ->ensureColumn(new rex_sql_column('name', 'varchar(100)'))
    ->ensureColumn(new rex_sql_column('description', 'text'))
    ->ensureColumn(new rex_sql_column('list_amount', 'tinyint(3) unsigned', false, '50'))
    ->ensureColumn(new rex_sql_column('list_sortfield', 'varchar(255)', false, 'id'))
    ->ensureColumn(new rex_sql_column('list_sortorder', 'enum(\'ASC\',\'DESC\')', false, 'ASC'))
    ->ensureColumn(new rex_sql_column('prio', 'int(11)'))
    ->ensureColumn(new rex_sql_column('search', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('hidden', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('export', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('import', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('mass_deletion', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('mass_edit', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('history', 'tinyint(1)'))
    ->ensureIndex(new rex_sql_index('table_name', ['table_name'], rex_sql_index::UNIQUE))
    ->ensure();

// install yform-fields database
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
    ->ensureColumn(new rex_sql_column('not_required', 'text'))
    ->ensureColumn(new rex_sql_column('options', 'text'))
    ->ensureColumn(new rex_sql_column('multiple', 'text'))
    ->ensureColumn(new rex_sql_column('default', 'text'))
    ->ensureColumn(new rex_sql_column('size', 'text'))
    ->ensureColumn(new rex_sql_column('only_empty', 'text'))
    ->ensureColumn(new rex_sql_column('message', 'text'))
    ->ensureColumn(new rex_sql_column('table', 'text'))
    ->ensureColumn(new rex_sql_column('hashname', 'text'))
    ->ensureColumn(new rex_sql_column('password_hash', 'text'))
    ->ensureColumn(new rex_sql_column('no_db', 'text'))
    ->ensureColumn(new rex_sql_column('password_label', 'text'))
    ->ensureColumn(new rex_sql_column('field', 'text'))
    ->ensureColumn(new rex_sql_column('type', 'text'))
    ->ensureColumn(new rex_sql_column('empty_value', 'text'))
    ->ensureColumn(new rex_sql_column('empty_option', 'text'))
    ->ensureColumn(new rex_sql_column('max_size', 'text'))
    ->ensureColumn(new rex_sql_column('types', 'text'))
    ->ensureColumn(new rex_sql_column('fields', 'text'))
    ->ensureColumn(new rex_sql_column('position', 'text'))
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
    ->ensureColumn(new rex_sql_column('regex', 'text'))
    ->ensureColumn(new rex_sql_column('pattern', 'text'))
    ->ensureColumn(new rex_sql_column('current_date', 'text'))
    ->ensureColumn(new rex_sql_column('widget', 'text'))
    ->ensureColumn(new rex_sql_column('query', 'text'))
    ->ensureColumn(new rex_sql_column('year_start', 'text'))
    ->ensureColumn(new rex_sql_column('year_end', 'text'))
    ->ensureColumn(new rex_sql_column('rules', 'text'))
    ->ensureColumn(new rex_sql_column('nonce_key', 'text'))
    ->ensureColumn(new rex_sql_column('nonce_referer', 'text'))
    ->ensureColumn(new rex_sql_column('sizes', 'text'))
    ->ensureColumn(new rex_sql_column('messages', 'text'))
    ->ensureColumn(new rex_sql_column('rules_message', 'text'))
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

rex_sql_table::get(rex::getTable('url_generate'))
    ->ensureColumn(new rex_sql_column('id', 'int(11) unsigned', false, null, 'auto_increment'))
    ->ensureColumn(new rex_sql_column('article_id', 'int(11)'))
    ->ensureColumn(new rex_sql_column('clang_id', 'int(11)', false, '1'))
    ->ensureColumn(new rex_sql_column('url', 'text'))
    ->ensureColumn(new rex_sql_column('table', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('table_parameters', 'text'))
    ->ensureColumn(new rex_sql_column('relation_table', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('relation_table_parameters', 'text'))
    ->ensureColumn(new rex_sql_column('relation_insert', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('createdate', 'int(11)'))
    ->ensureColumn(new rex_sql_column('createuser', 'varchar(255)'))
    ->ensureColumn(new rex_sql_column('updatedate', 'int(11)'))
    ->ensureColumn(new rex_sql_column('updateuser', 'varchar(255)'))
    ->setPrimaryKey('id')
    ->ensure();

// install yform data
try {
    $sql = rex_sql::factory();
    if (
        sizeof($sql->getArray("SELECT id FROM " . rex::getTable('yform_table') . " WHERE id=5")) <= 0
    ) {
        rex_sql_util::importDump($this->getPath('data.sql'));
    }
} catch (rex_sql_exception $e) {
    rex_logger::logException($e);
    print rex_view::error($e->getMessage());
}
