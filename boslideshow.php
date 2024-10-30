<?php
	/*
	Plugin Name: Slideshowbohemia
	Plugin URI: http://bohemiawebsites.com/component/option,com_jdownloads/Itemid,163/catid,13/task,viewcategory/
	Description: Slideshow gallery using JQuery.
	Version: 0.4
	Author: Kent Elchuk
	Author URI: http://bohemiawebsites.com
	*/
		if ( function_exists('plugins_url') )
		$url = plugins_url(plugin_basename(dirname(__FILE__)));
	else
		$url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));		
		$bw_pluginurl = $url;
		//add javascript
		wp_enqueue_script( "jquery",  $bw_pluginurl."/js/jquery.js" );
		wp_enqueue_script( "jquery.cycle",  $bw_pluginurl."/js/jquery.cycle.js"/*, array( 'jquery' )*/ );
		//add css
		wp_enqueue_style( "boslide_cycle",  $bw_pluginurl."/css/boslide_cycle.css" );		
		//add install and my guess is it initiates boslideshow_install function
	    add_action('admin_menu', 'boslideshow_install');
		//add_option('boslideshow_width', 640);

	function boslideshow_install() {
	global $wpdb;
		add_menu_page('boslideshow', 'boslideshow', 10, __FILE__, 'boslideshow_admin', $url.'../wp-content/plugins/boslideshow/img/menu.gif');
		
		$wpdb->query($query);
		
		//front end options to alter dimensions
		add_option('boslideshow_width', 690);
		add_option('boslideshow_height', 219);
		add_option('boslideshow_marginLeft', 'auto');
		add_option('boslideshow_buttonColor', '#0E3B3B');
		add_option('boslideshow_boboTop', 'auto');
		add_option('boslideshow_timeout', 5000);
		add_option('boslideshow_imgNames', '3_s.png,7_s.gif');
		add_option('boslideshow_imgCaptions', 'caption1,caption2');
		add_option('boslideshow_imgDescriptions', '');
		//add_option('boslideshow_quality', 80);
		//plugin path
		$bw_plugindir = ABSPATH.'wp-content/plugins/boslideshow/';
		load_textdomain('boslideshow', $bw_plugindir.'lang/'.WPLANG.'.mo');
	}

	function boslideshow_admin() {
		include 'boslideshow-admin.php';
	}

	function boslideshow_show() {
		if ( function_exists('plugins_url') )
			$url = plugins_url(plugin_basename(dirname(__FILE__)));
		else
			$url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
		global $wpdb;
		//plugin path
		$bw_plugindir = ABSPATH.'wp-content/plugins/boslideshow/';
		$bw_pluginurl = $url;
		$bw_filesdir = ABSPATH.'wp-content/plugins/boslideshow/files/';
		$bw_filesurl = $url.'/files/';
		add_option('boslideshow_width', 690);
		$img_width = get_option('boslideshow_width');
		$img_height = get_option('boslideshow_height');
		$controls_dist = get_option('boslideshow_boboTop');
		//}		
		?>		
		
		<script type="text/javascript">
//$.noConflict();
$b = jQuery.noConflict();
$b(document).ready(function() {													 

$b('#bogallery').cycle({
	fx: 'scrollRight',
	timeout: /*3000*/<?php echo get_option('boslideshow_timeout'); ?>,
	speed: 500,
	delay: -2000,
	pager: '#pager',
	next: '#next',
	prev: '#prev'
});

$b('#playbocontrol').toggle(
		function() {
			$b('#bogallery').cycle('pause');
			$b(this).text('Play');
		},
		function() {
			$b('#bogallery').cycle('resume');
			$b(this).text('Pause');
		});

}); // end ready()
</script>

<?php
	function explode_to_array($text) {
	//special chars to be removed
	$invalid_array_chars = array("\n");

	if ($text) { 
		    $_text = str_replace($invalid_array_chars, "", $text);
		if ($_text) {
		    $_arr = explode(",", $_text);
		    if ($_arr)
			$_arr = array_map("trim", $_arr);
		    return (! empty($_arr) ? $_arr: false);
		}
	}
	return false;
    }

    // images array
	$imgNames = get_option('boslideshow_imgNames');  
	$imgCaptions = get_option('boslideshow_imgCaptions');  
	/*$imgDescriptions = 'a,b,c'; */
    $imgs = explode_to_array($imgNames);

    // images ALT
    $caps = explode_to_array($imgCaptions);

    //images links
  	/*  $links = explode_to_array($imgLinks);*/
	
	//images description
	$descriptions = explode_to_array($imgDescriptions);
	
	//image stuff
    $i = 0;
    $wcontent = "";
    $class = "";   
	$class2= "class=\"imageElement\""; 

    // construct images content
    	if ($imgs) {
		foreach ($imgs as $imgs_item) {
	    if ($i >0) $class = " class = 'hide_slide'";
	    $wcontent = $wcontent."<div $class><a href='"/*.$links[$i].*/.$bw_filesurl.$imgs_item."'><img src='".$bw_filesurl.$imgs_item."' alt='".$caps[$i]."' width='".$img_width."' height='".$img_height."'/></a><p>".$caps[$i]."</p></div>";
	    $i++;
	}
    }	
?>
<style>	
#pager a,#bomain .bocontrol{font-size:12px;font-weight:bold;color:#FFF;background:<?php echo get_option('boslideshow_buttonColor'); ?>;padding:2px 5px;text-decoration:none;margin-left:5px;cursor:pointer}
#pager a.activeSlide{background-color:#e6e2af;color:#000}
#pager a:hover,#playbocontrol:hover{background:#900}
#bobocontrols{text-align:center;  z-index:5;}</style>
  <div id="bocontainer" style="width:<?php echo get_option('boslideshow_width'); ?>px; margin-left:<?php echo get_option('boslideshow_marginLeft'); ?>px;">   
  <div id="wcontentwrap">
  <div id="bomain" style="width:<?php echo get_option('boslideshow_width'); ?>px; ">   
  <div id="bogallery" style="width:<?php echo get_option('boslideshow_width'); ?>px; ">    	
		    <?php echo $wcontent;  ?>				   
  </div>  
  <div id="bobocontrols" style="margin-top:; width:<?php echo get_option('boslideshow_width')+20; ?>px; margin-top: <?php echo get_option('boslideshow_boboTop'); ?>px; z-index:2;">
  <span id="prev" class="bocontrol">Previous</span>
    <span id="pager" ></span>
    <span id="next" class="bocontrol">Next</span>
    <span id="playbocontrol" class="bocontrol">Pause</span>
  </div>   
</div>  
  </div>  
</div>
<div style="clear:both;"></div>
		<?php } 