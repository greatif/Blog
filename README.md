# Blog for REDAXO
This addon offers a simple blog-system.
It is the transfer of originally two modules into an addon.
Accordingly, existing REDAXO addons and resources are predominantly used or assumed.
As editor the [CKEditor 5](https://github.com/FriendsOfREDAXO/cke5) is used, the gallery is distributed via PhotoSwipe.
A modified version of the [R-Tricks](https://friendsofredaxo.github.io/tricks/module/minibeispiel_rss-feed) is used to generate the RSS feed.
The provision of PDF files is done via the addon [PDFout](https://github.com/FriendsOfREDAXO/pdfout).

![blog](https://user-images.githubusercontent.com/8527203/44779535-0900a180-ab80-11e8-9732-2ae2d719da01.png)

[blog example](https://greatif.de/blog/)

## Features

- creating blog submissions with information about the author
- meta informations "Title", "Description" und "Cannonical Link" for each entry
- title-picutres for each entry
- gallery function
- YouTube integration
- RSS function
- socialsharing function
- PDF output
- comment function
- article status: online, offline, working version
- teaser funktion
- works with [Community-Demo](https://github.com/FriendsOfREDAXO/demo_community)

## Installation
- moules and templates are installed automatically
- create a category "Blog"
- inside the category "Blog" create an article "RSS-Feed" and assign the template "Blog - RSS-Feed"
- inside the article "RSS-Feed" insert the module "Blog - RSS-Feed" an set it
- inside the article of the blog insert the module "Blog" and set it
- inside the start-article insert the module "Blog-Teaser" and set it
- set in the URL-addon, in which article the output of the blog takes place
- include .css and .js files:
```
<link rel="stylesheet" href="<?php echo rex_url::base('assets/addons/blog/blog.css') ?>">
<link rel="stylesheet" href="<?php echo rex_url::base('assets/addons/blog/photoswipe.css') ?>">

<script type="text/javascript" src="<?php echo rex_url::base('assets/addons/blog/photoswipe.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo rex_url::base('assets/addons/blog/photoswipe-ui-default.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo rex_url::base('assets/addons/blog/init-gallery.js') ?>"></script>
```

## Requirements

- YForm 2.3
- YCom 2.1
- YRewrite 2.3
- URL 1.0.1
- PHPMailer 2.0.1
- CKEditor 5 2.1
- PDFOut 1.4.2
- Auth-PlugIn
- Group-PlugIn
- PhotoSwipe

## Support
- [LazyLoad addon](https://github.com/eaCe/lazyload)
- [Hyphenator addon](https://github.com/FriendsOfREDAXO/hyphenator)

## Changelog

siehe [CHANGELOG.md](https://github.com/greatif/blog/blob/master/CHANGELOG.md)

## Author

**greatif**

* http://www.greatif.de
* https://github.com/greatif
