<?php
require_once('view/widget/head.php');
?>

<?php
require_once('blog.php');

$doc  = $_GET['doc'];

$blog = new Blog();

if (!$page_info = $blog->getPageInfo($doc)){
	$html = '404: Not Found.';
	$title = '';
}
else{
	$title = $page_info['title'];
	$date = '';
	$html = $blog->getPageHTML($doc);
}
?>
<div class="article">
	<div class="article_head">
		<div class="article_title"><?php echo $title; ?></div>
	</div>
	<div class="article_main"><?php echo $html; ?></div>
</div>
<?php
require_once('view/widget/foot.php');
?>
