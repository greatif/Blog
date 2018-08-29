<?php

echo rex_view::title('<i class="rex-icon fa-pencil-square-o"></i> Blog');

$subpage = rex_be_controller::getCurrentPagePart(2);

rex_be_controller::includeCurrentPageSubPath();