REX_TEMPLATE[1]
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?= rex_url::frontend() ?>"><img src="<?= rex_url::base('resources/css/images/logo.png') ?>" alt="REDAXO CMS"></a>
	</div>
	<div class="navbar-collapse collapse navbar-right">
		<!-- Navigation -->
		REX_TEMPLATE[3]
		<!--/Navigation -->

	</div><!--/.nav-collapse -->
  </div>
</div>

<!-- *******************************************************
Headerpic
******************************************************* -->
REX_TEMPLATE[5]

<?php
// Breadcrumb
$path = explode("|",$this->getValue("path").$this->getValue("article_id")."|");
$secondLevel = $path[2];

if ($secondLevel != '') { // Breadcrumb nur in mindestens der zweiten Ebene anzeigen
	echo '<div class="container breadcrumb-wrapper">';
		echo 'Du bist hier: ';
		$startArticle = rex_article::get(rex_article::getSiteStartArticleId());
		$startArticleUrl = $startArticle->getUrl();
		$startArticleName = $startArticle->getName();
		echo '<a href="'.$startArticleUrl.'"><span class="home_link">'.$startArticleName.'</a></span>';

		$nav = rex_navigation::factory();
		echo $nav->showBreadcrumb('', true);
	echo '</div>';
}

/*
Wenn das Template "01 . Standard" gewählt ist, geht der Content-Container über die volle Breite.
*/
if (SITE_TYPE == 'col1') { ?>
	<article class="mtb">
		<?php echo $this->getArticle('1'); ?>
	</article>
<?php }

/*
Wenn das Template "02 . Zweispalter" gewählt ist, gibt es eine Hauptspalte und eine Seitenspalte in der Teilung 2/3 - 1/3.
*/
if (SITE_TYPE == 'col2') { ?>
	<div class="container mtb">
		<div class="row">

			<div class="col-lg-8 col-sm-12">
				<?php echo $this->getArticle('1'); ?>
			</div>

			<div class="col-lg-3 col-lg-offset-1 sidebar hidden-xs hidden-sm">
				<!-- Subnavigation -->
				REX_TEMPLATE[8]
				<!-- /Subnavigation -->

				<!-- ggf. weiterer Content -->
				<?php echo $this->getArticle('2'); ?>
			</div>

		</div>
	</div>
<?php } ?>

<!-- *******************************************************
 FOOTER
 ******************************************************* -->
REX_TEMPLATE[7]

<!-- REDAXO 5 rocks! -->

<!-- Javascripts -->
<script type="text/javascript" src="<?= rex_url::base('resources/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/jquery.hoverex.min.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/jquery.prettyPhoto.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/jquery.flexslider-min.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/prettify.js') ?>"></script>
<script type="text/javascript" src="<?= rex_url::base('resources/js/redaxo-demo.js') ?>"></script>

</body>
</html>
