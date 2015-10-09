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
		<?php for ($i=0; $i < $site_count_num; $i++ ) { ?>
			<h2><a href="<?php print $site_link[$i]; ?>"><?php print $site_name[$i]; ?></a></h2>
			<p><?php print $site_link[$i]; ?></p>
				<?php for($j = 0; $j < 8; $j++){ ?>
					<div class="box_S">
						<a href="<?php print $data[$i][$j]["page_url"]; ?>">
							<div class="box_inner">
								<h3><?php print $data[$i][$j]["title"]; ?></h3>
								<div class="img_box"><?php print $data[$i][$j]["img"]; ?></div>
							</div>
						</a>
					</div>
				<?php } ?>
		<?php } ?>
	</div><!-- .inner -->
</div><!-- /#contents -->
<div id="footer">
<!-- /#footer --></div>



</body>
</html>
