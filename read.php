<?php
require_once('view/widget/head.php');
?>

<?php
require_once('blog.php');

$doc  = $_GET['doc'];

$blog = new Blog();

if (!$blog_info = $blog->getBlogInfo($doc)){
	$html = '404: Not Found.';
	$title = '';
}
else{
	$title = $blog_info['title'];
	$type = $blog_info['type'];
	$date = $blog_info['date'];
	$html = $blog->getBlogHTML($doc);
}
?>
<div class="article">
	<div class="article_head">
		<div class="article_title"><?php echo $title; ?></div>
<?php
if ($type === blog){
	echo "<div class=\"article_date\">$date</div>";
}	
?>
	</div>
	<div class="article_main"><?php echo $html; ?></div>
</div>
<?php
require_once('view/widget/disqus.php');
require_once('view/widget/foot.php');
?>
