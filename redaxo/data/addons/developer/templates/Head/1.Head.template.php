,<?php
 //error_reporting(0);
error_reporting(E_ALL);
// Das Error-Reporting sollte nur während der Entwicklung angeschaltet sein. Bei einer Libe-Website sollte es auf 0 gestellt werden.

// Ist der User nicht eingeloggt?
if (!rex_backend_login::hasSession()) {
	// Ist der aufgerufene Artikel offline?
	if ($this->getValue('status') == 0) {
		// dann zur Fehlerseite weiterleiten
		header ('HTTP/1.1 301 Moved Permanently');
		header('Location: '.rex_getUrl(rex_article::getNotFoundArticleId(), rex_clang::getCurrentId()));
		die();
	}
}

// Benötigt für Eingabe- und Ausgabe-Modul Tabs und Akkordions
rex::setProperty('tabs', new ArrayIterator());

header('Content-Type: text/html; charset=utf-8');
?><!DOCTYPE html>
<html lang="<?php echo rex_clang::getCurrent()->getCode(); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	// Als Title-Tag den Artikelnamen, außer er wird manuell gesetzt
	if ($this->getValue("art_title") != "") {
		$title = htmlspecialchars($this->getValue('art_title'));
	} else {
		$title = htmlspecialchars($this->getValue('name'));
	}

	echo '
	<title>'.$title.'</title>';

	// Keywords and description
	// Wenn der aktuelle Artikel kein Keyword und Description besitzt, werden die aus dem Startartikel genommen
	if ($this->getValue("art_keywords") != "") {
		$keywords = $this->getValue("art_keywords");
	} else {
		$home = new rex_article_content(rex_article::getSiteStartArticleId());
		$keywords = $home->getValue('art_keywords');
	}

	if ($this->getValue("art_description") != "") {
		$description = $this->getValue("art_description");
	} else {
		$home = new rex_article_content(rex_article::getSiteStartArticleId());
		$description = $home->getValue('art_description');
	}

	echo '
	<meta name="keywords" content="'.htmlspecialchars($keywords).'">';

	echo '
	<meta name="description" content="'.htmlspecialchars($description).'">';
	?>

	REX_ASSETS[type=css file=lasse] 
	<link rel="stylesheet" href="<?= rex_url::base('resources/css/bootstrap.css') ?>">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
