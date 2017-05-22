<?php
require_once('Michelf/Markdown.php');

use \Michelf\Markdown;

class Blog{
	protected $blog_num_per_page;
	
	protected $blogs = array(
		// blogs,
		'service-caller' => array(
			'title'    => '自制chrome调用贴吧service插件正式发布',
			'markdown' => 'service-caller.md',
			'date'     => '2013/11/01',
		),
	);
	
	protected $pages = array(
		// pages
		'about' => array(
			'title'    => 'About',
			'markdown' => 'about.md',
		),
		'profile' => array(
			'title'    => 'My Profile',
			'markdown' => 'my-profile.md',
		),
		'project' => array(
			'title'    => 'My Project',
			'markdown' => 'my-projects.md',
		),
	);
	
	public function __construct($blog_num_per_page = 10)
	{
		$this->blog_num_per_page = $blog_num_per_page > 0 ? $blog_num_per_page : 10;
	}
	
	public function getAllBlogs()
	{
		return $this->blogs;
	}
	
	public function getBlogNum()
	{
		$blog_count = 0;
		foreach ( $this->blogs as $blog_info )
			$blog_count++;
		return $blog_count;
	}
	
	public function getBlogsByPage($page = 1)
	{
		$blog_start = ($page - 1) * $this->blog_num_per_page;
		$cur_blog_num = 0;
		$pivot = 0;
		$page_blogs = array();
		foreach ( $this->blogs as $blog_name => $blog_info ){
			if ( $pivot === $blog_start ){
				$page_blogs[$blog_name] = $blog_info;
				$cur_blog_num++;
			}
			else{
				$pivot++;
			}
			if ( $cur_blog_num === $this->blog_num_per_page ){
				break;
			}
		}
		return $page_blogs;
	}
	
	public function getBlogInfo($blog_name)
	{
		if ( !isset($this->blogs[$blog_name]) )
			return false;
		return $this->blogs[$blog_name];
	}
	
	public function getBlogHTML($blog_name)
	{
		if ( !($blog_info = $this->getBlogInfo($blog_name)) )
			return false;
		
		$md_file = $blog_info['markdown'];
		$md_path = "doc/$md_file";
		if ( !is_file($md_path) )
			return false;

		$markdown = file_get_contents($md_path);
		return Markdown::defaultTransform($markdown);
	}

	public function getPageInfo($page_name)
	{
		if ( !isset($this->pages[$page_name]) )
			return false;
		return $this->pages[$page_name];
	}

	public function getPageHTML($page_name)
	{
		if ( !($page_info = $this->getPageInfo($page_name)) )
			return false;
		
		$md_file = $page_info['markdown'];
		$md_path = "doc/$md_file";
		if ( !is_file($md_path) )
			return false;

		$markdown = file_get_contents($md_path);
		return Markdown::defaultTransform($markdown);
	}
}
?>
