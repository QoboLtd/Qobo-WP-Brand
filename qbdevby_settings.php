<?php

class QBDEVBY_Settings
{
    const OPTION_GROUP = 'qbdevby_settings_group';
    const OPTION_NAME = 'qbdevby_settings';
    const OPTION_TITLE = 'Developed by';

    protected $data = array(
        'title' => null,
        'text' => null,
        'text_style' => null,
        'style' => null,
        'light_colour_icon' => null,
        'custom_icon' => null,
        'link' => null,
        'footer' => null,
    );

    public function __construct()
    {
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'add_page'));
        register_activation_hook(QBDEVBY__PLUGIN_FILE, array($this, 'activate'));
    }

    public function admin_init()
    {
        register_setting(self::OPTION_GROUP, self::OPTION_NAME, array($this, 'validate'));
    }

    public function validate($input)
    {
        $valid = array();
        $valid['title'] = sanitize_text_field($input['title']);
        $valid['text'] = sanitize_text_field($input['text']);
        $valid['text_style'] = sanitize_text_field($input['text_style']);
        $valid['style'] = sanitize_text_field($input['style']);
        $valid['light_colour_icon'] = sanitize_text_field($input['light_colour_icon']);
        $valid['custom_icon'] = sanitize_text_field($input['custom_icon']);
        $valid['link'] = sanitize_text_field($input['link']);
        $valid['footer'] = sanitize_text_field($input['footer']);

        return $valid;
    }

    public function add_page()
    {
        add_options_page(self::OPTION_TITLE, self::OPTION_TITLE, 'manage_options', self::OPTION_GROUP, array($this, 'options_do_page'));
    }

    public function options_do_page()
    {
        $options = get_option(self::OPTION_NAME);
        ?>
        <div class="wrap">
            <h2>Developed by Settings</h2>
            <p>Settings for 'Developed by' plugin</p>
            <form method="post" action="options.php">
                <?php settings_fields(self::OPTION_GROUP); ?>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Title</th>
                        <td><input type="text" name="<?php echo self::OPTION_NAME ?>[title]"
                                   value="<?php echo $options['title']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Text</th>
                        <td><input type="text" name="<?php echo self::OPTION_NAME ?>[text]"
                                   value="<?php echo $options['text']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Text Style</th>
                        <td><input type="text" name="<?php echo self::OPTION_NAME ?>[text_style]"
                                   value="<?php echo $options['text_style']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Style</th>
                        <td><input type="text" name="<?php echo self::OPTION_NAME ?>[style]"
                                   value="<?php echo $options['style']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Light colour icon</th>
                        <td><input type="checkbox" name="<?php echo self::OPTION_NAME ?>[light_colour_icon]"
                                   value="1" <?php if ($options['light_colour_icon']) echo 'checked=""'; ?> /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Custom icon *</th>
                        <td><input type="checkbox" name="<?php echo self::OPTION_NAME ?>[custom_icon]"
                                   value="1" <?php if ($options['custom_icon']) echo 'checked=""'; ?> /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Link</th>
                        <td><input type="text" name="<?php echo self::OPTION_NAME ?>[link]"
                                   value="<?php echo $options['link']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Footer</th>
                        <td><input type="checkbox" name="<?php echo self::OPTION_NAME ?>[footer]"
                                   value="1" <?php if ($options['footer']) echo 'checked=""'; ?> /></td>
                    </tr>

                </table>

                <p>
                    * if Custom Icon is selected the logo should be under /images/footer/ directory with name qobo.png
                </p>

                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
                </p>
            </form>
        </div>
        <?php
    }

    public function activate()
    {
        update_option(self::OPTION_NAME, $this->data);
    }

    public function deactivate()
    {
        delete_option(self::OPTION_NAME);
    }
}