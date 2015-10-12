<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<title>まとめサイト</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<?php require_once("common.php"); ?>

<div id="contents">
	<div class="inner clearfix">
	<p class="pager"><?php print $pager->links; ?></p>
		<?php foreach ($site as $site_name ) { ?>
			<h2><a href="<?php print $site_link[$site_name]; ?>"><?php print $site_name; ?></a></h2>
			<p class="sitename"><?php print $site_link[$site_name]; ?></p>
				<?php for($j = 0; $j < 8; $j++){ ?>
					<div class="box_S">
						<a href="<?php print $data[$site_name][$j]["page_url"]; ?>">
							<div class="box_inner">
								<h3><?php print $data[$site_name][$j]["title"]; ?></h3>
								<div class="img_box"><?php print $data[$site_name][$j]["img"]; ?></div>
							</div>
						</a>
					</div>
				<?php } ?>
		<?php } ?>
	</div><!-- .inner -->
	<p class="pager"><?php print $pager->links; ?></p>
</div><!-- /#contents -->
<div id="footer">
<!-- /#footer --></div>

</body>
</html>
