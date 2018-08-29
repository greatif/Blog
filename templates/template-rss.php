<?php 
rex_response::sendContentType('application/xml; charset=utf-8');
print $this->getArticle(1); ?>