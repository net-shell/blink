<?php
namespace Ash\Engine;


class Site
{

    public function Title()
    {
		return '<?php echo bloginfo(\'name\'); ?>';
    }
	
    public function SubTitle()
    {
		return '<?php echo bloginfo(\'description\'); ?>';
    }
	
    public function ContentStart()
    {
		return '<?php if (have_posts()) : while (have_posts()) : the_post(); ?>';
	}
	
	public function ContentTitle()
	{
		return '<?php the_title(); ?>';
	}
	
	public function ContentTime($format = 'F jS, Y')
	{
		return '<?php the_time(\'' . $format . '\') ?>';
	}
	
	public function Content($more = '(more...)')
	{
		return '<?php the_content(__(\'' . $more . '\')); ?>';
	}

    public function ContentEnd()
	{
		return '<?php endwhile; else: ?>';
	}
	
    public function NoContentStart()
	{
		return '<?php if(!have_posts()) ?>';
    }
	
    public function NoContentEnd()
	{
		return '<?php endif; ?>';
	}
	
	public function Sidebar()
	{
		return '<div id="sidebar">
<h2>Categories</h2>
<ul>
<?php wp_list_cats(\'sort_column=name&optioncount=1&hierarchical=0\'); ?>
</ul>
<h2 >Archives</h2>
<ul >
<?php wp_get_archives(\'type=monthly\'); ?>
</ul>
</div>';
	}

	private $cdnPackages = [
		'bootstrap-css' => '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css',
		'bootstrap-js' => '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js',
		'jquery' => '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js'
	];
	private function _cdn($uri)
	{
		$ext = substr($uri, strripos($uri, '.'));
		switch($ext)
		{
			case '.js':	return '<script src="' . $uri . '"></script>'; break;
			case '.css':	return '<link rel="stylesheet" href="' . $uri . '" />'; break;
		}
	}
	public function Cdn($package)
	{
		$package = $this->cdnPackages[$package];
		$html = '';
		if(is_array($package))
			foreach($package as $uri)
				$html .= $this->_cdn($uri);
		else $html .= $this->_cdn($package);
		return $html;
	}
}