<?php 

/* template:blog_rssfeed V1.0 */

rex_response::sendContentType('application/xml; charset=utf-8');
print $this->getArticle(1);
