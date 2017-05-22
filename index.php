<?php require_once('view/widget/head.php'); ?>

<?php
require_once('blog.php');

$page = isset($_GET['p']) ? intval($_GET['p']) : 1;
$blogs_per_page = 6;
	
$blog = new Blog($blogs_per_page);
$page_blogs = $blog->getBlogsByPage($page);

foreach ( $page_blogs as $blog_name => $blog_info ){
	$title = $blog_info['title'];
	$date = $blog_info['date'];
	$markdown = $blog_info['markdown'];
	echo "<div class=\"article\">\n";
	echo "<div class=\"article_head\">\n";
	echo "<div class=\"article_title\"><a href=\"http://crispgm.sinaapp.com/doc/$blog_name\">$title</a></div>\n";
	echo "<div class=\"article_date\">$date</div>\n";
	echo "</div>\n";
	echo "<div class=\"article_main\">\n";
	echo $blog->getBlogHTML($blog_name);
	echo "</div></div>\n";
}

$total_blog = $blog->getBlogNum();
$total_page = intval(ceil($total_blog/$blogs_per_page));
$np = $page + 1;
$pp = $page - 1;
if ( $pp >= 1 || $np<=$total_page ){
	echo "<nav id=\"page_num\">";
	if ( $pp >= 1 ){
		echo "<a href=\"http://crispgm.sinaapp.com/index?p=$pp\" id=\"prev\">Prev</a>";
	}
	if ( $np <= $total_page ){
		echo "<a href=\"http://crispgm.sinaapp.com/index?p=$np\" id=\"next\">Next</a>";
	}
	echo "</nav>";
}
?>

<?php require_once('view/widget/foot.php'); ?>
