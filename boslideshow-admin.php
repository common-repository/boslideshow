<?php global $wpdb; ?>
<?php
	if ( function_exists('plugins_url') )
		$url = plugins_url(plugin_basename(dirname(__FILE__)));
	else
		$url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
?>
<?php $bw_plugindir = ABSPATH.'wp-content/plugins/boslideshow/'; ?>
<?php $bw_pluginurl = $url; ?>
<?php $bw_filesdir = ABSPATH.'wp-content/plugins/boslideshow/files/'; ?>
<?php $bw_filesurl = $url.'/files/'; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $bw_pluginurl; ?>/css/boslide_cycle.css" />
<script type="text/javascript" src="<?php echo $bw_pluginurl; ?>/js/functions.js"></script>
<?php
if (isset($_POST['options'])) {
			update_option('boslideshow_width', $_POST['boslideshow_width']);
			update_option('boslideshow_height', $_POST['boslideshow_height']);
			update_option('boslideshow_marginLeft', $_POST['boslideshow_marginLeft']);
			update_option('boslideshow_buttonColor', $_POST['boslideshow_buttonColor']);
			update_option('boslideshow_boboTop', $_POST['boslideshow_boboTop']);
			update_option('boslideshow_imgNames', $_POST['boslideshow_imgNames']);
			update_option('boslideshow_imgCaptions', $_POST['boslideshow_imgCaptions']);
			update_option('boslideshow_timeout', $_POST['boslideshow_timeout']);
					
		}
		?>   
  <div id="boslideshow_options" class="boslideshow_box">
    <form name="boslideshow_options" method="post" action="">
      <table>
        <tr>
          <td><?php _e('Width','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_width" value="<?php echo get_option('boslideshow_width'); ?>" />
            px</td>
        </tr>
        <tr>
          <td><?php _e('Height','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_height" value="<?php echo get_option('boslideshow_height'); ?>" />
            px</td>
        </tr>
		<tr>
          <td><?php _e('Margin Left','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_marginLeft" value="<?php echo get_option('boslideshow_marginLeft'); ?>" />
            px</td>
        </tr>
		<tr>
          <td><?php _e('Button Distance','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_boboTop" value="<?php echo get_option('boslideshow_boboTop'); ?>" />
            px</td>
        </tr>
		<tr>
          <td><?php _e('Button Color','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_buttonColor" value="<?php echo get_option('boslideshow_buttonColor'); ?>" />
            Use hex code or color</td>
        </tr>
		<tr>
          <td><?php _e('Image names','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_imgNames" value="<?php echo get_option('boslideshow_imgNames'); ?>" />
            </td>
        </tr>
		<tr>
          <td><?php _e('Image Captions','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_imgCaptions" value="<?php echo get_option('boslideshow_imgCaptions'); ?>" />
            </td>
        </tr>
        <tr>
          <td><?php _e('Timeout','boslideshow'); ?>
            :</td>
          <td><input type="text" name="boslideshow_timeout" value="<?php echo get_option('boslideshow_timeout'); ?>" />
            ms</td>
        </tr>
		
        <tr>
          <td colspan="2"><input type="submit" name="options" value="<?php _e('Save','boslideshow'); ?>" class="button-secondary action" /></td>
        <tr>
      </table>
    </form>
  </div>
  
  <?php
		//}
	?>
</div>
