<?php
class QBDEVBY_Widget extends WP_Widget {

    function QBDEVBY_Widget(){
        // Instantiate the parent object
        parent::__construct(
            'QBDEVBY_Widget',
            __('Developed by', 'qobo-developedby'),
            array('description' => "Widget for 'Developed by'")
            );
    }

    function widget($args, $instance){
        $options = empty($instance['override_settings'])? get_option(QBDEVBY_Settings::OPTION_NAME):$instance;
        
        $title = apply_filters( 'widget_title', $options['title'] );
        $title_tag = $title;
        if(!empty($title))
            $title_tag = $args['before_title'] . $title . $args['after_title'];
        $options['title'] = $title_tag;
                
        echo $args['before_widget'];
        QBDEVBY_DevelopedBy::print_developedby($options);
        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['override_settings'] = (!empty($new_instance['override_settings']))? strip_tags($new_instance['override_settings']):0;
        $instance['title'] = (!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
        $instance['text'] = (!empty($new_instance['text']))? strip_tags($new_instance['text']):'';
        $instance['text_style'] = (!empty($new_instance['text_style']))? strip_tags($new_instance['text_style']):'';
        $instance['style'] = (!empty($new_instance['style']))? strip_tags($new_instance['style']):'';
        $instance['light_colour_icon'] = (!empty($new_instance['light_colour_icon']))? strip_tags($new_instance['light_colour_icon']):0;
        $instance['link'] = (!empty($new_instance['link']))? strip_tags($new_instance['link']):'';
      
        return $instance;
    }
    
    function form( $instance ) {
        $override_settings = empty($instance['override_settings'])? 0:1;
        $title = isset($instance['title'])? $instance['title']:__('', 'qobocrm-realestates-property-view');
        $text = isset($instance['text'])? $instance['text']:__('Developed by', 'qobo-developedby');
        $text_style = isset($instance['text_style'])? $instance['text_style']:'';
        $style = isset($instance['style'])? $instance['style']:'text-align:center;';
        $light_colour_icon = empty($instance['light_colour_icon'])? 0:1;
        $link = isset($instance['link'])? $instance['link']:'http://www.qobo.biz';
        ?>
        <p>
          <input class="widefat" id="<?php echo $this->get_field_id('override_settings'); ?>" name="<?php echo $this->get_field_name('override_settings'); ?>" type="checkbox" value="1" <?php if($override_settings) echo 'checked=""'; ?> onchange="qbdevby_widgets_hideAllOtherInputFields_toggle(this.id, this.checked)" />
          <label for="<?php echo $this->get_field_id('override_settings'); ?>"><?php _e('Override Settings', 'qobo-developedby'); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'qobo-developedby'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'qobo-developedby'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Text Style:', 'qobo-developedby'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('text_style'); ?>" name="<?php echo $this->get_field_name('text_style'); ?>" type="text" value="<?php echo esc_attr($text_style); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style:', 'qobo-developedby'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="text" value="<?php echo esc_attr($style); ?>" />
        </p>
        <p>
          <input class="widefat" id="<?php echo $this->get_field_id('light_colour_icon'); ?>" name="<?php echo $this->get_field_name('light_colour_icon'); ?>" type="checkbox" value="1" <?php if($light_colour_icon) echo 'checked=""'; ?> />
          <label for="<?php echo $this->get_field_id('light_colour_icon'); ?>"><?php _e('Light color icon', 'qobo-developedby'); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'qobo-developedby'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
        </p>
        <script type="text/javascript">qbdevby_widgets_hideAllOtherInputFields_toggle('<?php echo $this->get_field_id('override_settings'); ?>', <?php echo $override_settings;?>);</script>
        <?php
    }
}

function qbdevby_widget_register_widgets(){
    register_widget('QBDEVBY_Widget');
}
add_action('widgets_init', 'qbdevby_widget_register_widgets');