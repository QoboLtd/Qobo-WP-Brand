<?php
/**
 * Plugin for 'Developed by'
 *
 * @author     Qobo ltd
 * @version    0.1
 * @link       http://www.qobo.biz
 */
class QBDEVBY_DevelopedBy {
    
    /**
     * Prints 'Developed by'
     * 
     * @param array $options array of options for 'Developed by' snippet (title, style, text, text_style, light_colour_icon)
     */
    public static function print_developedby($options){
        $title = $options['title'];
        $style = empty($options['style'])? '':' style="'.$options['style'].'"';
        $text = $options['text'];
        $text_style = empty($options['text_style'])? '':' style="'.$options['text_style'].'"';
        $icon = null;
        $icon_over = QBDEVBY__PLUGIN_DIR_URL.'/inc/images/icon_hover.png';
        $link = $options['link'];
        
        if($options['light_colour_icon'])
            $icon = QBDEVBY__PLUGIN_DIR_URL.'/inc/images/icon_light.png';
        else
           $icon = QBDEVBY__PLUGIN_DIR_URL.'/inc/images/icon_dark.png';
        
        ?>
        <!-- Developed by -->
        <?php echo $title;?>
        <p<?php echo $style;?>>
          <span<?php echo $text_style;?>><?php echo $text;?>&nbsp;<a href=<?php echo $link;?>><img src="<?php echo $icon;?>" onmouseover="this.src='<?php echo $icon_over;?>'" onmouseout="this.src='<?php echo $icon;?>'"/></a></span>
        </p>
        <?php
    }
    
    /**
     * Prints 'Developed by' for footer
     * 
     * Based on corresponding settings
     */
    public static function print_developedby_footer(){
      $options = get_option(QBDEVBY_Settings::OPTION_NAME);
    
      if($options['footer']){
        $options['title'] = empty($options['title'])? null:'<h3 class="widget-title">'.apply_filters( 'widget_title', $options['title'] ).'</h3>';
        self::print_developedby($options);
      }
    }
    
    /**
     * Enqueue script
     * 
     * Current enqueued script is for widget settings form only to be added at the admin widgets page
     */
    public static function admin_enqueue_script($hook) {
        if('widgets.php' == $hook)
            wp_enqueue_script('qbdevby-widgets-script', plugins_url( '/inc/js/widgets.js', __FILE__ ));
    }
}

//print 'Developed by' in footer
add_action('wp_footer', array('QBDEVBY_DevelopedBy', 'print_developedby_footer'));
//add js in admin if on widgets page
add_action('admin_enqueue_scripts', array('QBDEVBY_DevelopedBy', 'admin_enqueue_script'));