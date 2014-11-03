<?php
/*
Plugin Name: Qobo - Developed By
Plugin URI: http://www.qobo.biz
Description: Plugin for 'Developed by'
Author: Qobo ltd
Version: 0.1
Author URI: http://www.qobo.biz
*/

define('QBDEVBY__PLUGIN_DIR', plugin_dir_path( __FILE__ ));
require_once (QBDEVBY__PLUGIN_DIR.'qbdevby_widget.php');
require_once (QBDEVBY__PLUGIN_DIR.'qbdevby_settings.php');

define('QBDEVBY__PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ));

new QBDEVBY_Settings();

function qbdevby_developedby() {
    $options = get_option(QBDEVBY_Settings::OPTION_NAME);
    
    if($options['footer']){
        $title = empty($options['title'])? null:'<h3 class="widget-title">'.apply_filters( 'widget_title', $options['title'] ).'</h3>';
        $icon = null;
        $icon_over = QBDEVBY__PLUGIN_DIR_URL.'/images/icon_hover.png';
        if($options['light_colour_icon'])
            $icon = QBDEVBY__PLUGIN_DIR_URL.'/images/icon_light.png';
        else
           $icon = QBDEVBY__PLUGIN_DIR_URL.'/images/icon_dark.png';
        $text = $options['text'];
        $text_style = empty($options['text_style'])? '':' style="'.$options['text_style'].'"';
        $style = empty($options['style'])? '':' style="'.$options['style'].'"';
        $link = $options['link'];
        
        ?>
        <!-- Developed by -->
        <?php echo $title;?>
        <p<?php echo $style;?>>
          <span<?php echo $text_style;?>><?php echo $text;?>&nbsp;<a href=<?php echo $link;?>><img src="<?php echo $icon;?>" onmouseover="this.src='<?php echo $icon_over;?>'" onmouseout="this.src='<?php echo $icon;?>'"/></a></span>
        </p>
        <?php
    }
}
add_action('wp_footer', qbdevby_developedby);