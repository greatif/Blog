INSERT INTO `rex_yform_field` (`table_name`, `prio`, `type_id`, `type_name`, `list_hidden`, `search`, `name`, `label`, `not_required`, `options`, `multiple`, `default`, `size`, `only_empty`, `message`, `table`, `hashname`, `password_hash`, `no_db`, `password_label`, `field`, `type`, `empty_value`, `empty_option`, `max_size`, `types`, `fields`, `position`, `address`, `width`, `height`, `attributes`, `preview`, `category`, `values`, `format`, `show_value`, `html`, `notice`, `regex`, `pattern`, `current_date`, `widget`, `query`, `year_start`, `year_end`, `rules`, `nonce_key`, `nonce_referer`, `sizes`, `messages`, `rules_message`, `script`)
VALUES
  ('rex_blog',1,'value','datestamp',0,1,'datestamp','Datum','','','','','','0','','','','','','','','','','','','','','','','','','','','','','Y-m-d H:i:s','','','','','','','','','','','','','','','','',''),
  ('rex_blog',2,'value','text',0,1,'title','Titel','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"Titel des Beitrags\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',4,'value','text',0,1,'author','Autor','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"Autor des Beitrags\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',6,'value','textarea',1,1,'contribution','Beitrag','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"Text\",\"class\":\"form-control cke5-editor\",\"data-profile\":\"default\",\"data-lang\":\"de\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',7,'value','be_media',1,1,'headerimage','Titel-Grafik','','','0','','','','','','','','','','','','','','','jpg,png,gif','','','','','','','1','13','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',8,'value','be_media',1,1,'images','Fotos','','','1','','','','','','','','','','','','','','','jpg,png,gif','','','','','','','1','4','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',9,'value','text',1,1,'youtube','YouTube Video einbetten','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"embed code\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',5,'value','text',1,1,'contact','Kontakt zum Autor','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"kontakt.autor@email.de\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',3,'value','text',1,1,'description','Beschreibung','','','','','','','','','','','','','','','','','','','','','','','','{\"placeholder\":\"description in Metatags\"}','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',10,'value','select',0,1,'comments','Kommentare','','nein=0,ja=1','0','0','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''),
  ('rex_blog',11,'value','select',0,0,'status','translate:status','','offline=0,online=1,Arbeitsversion=2','0','0','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
