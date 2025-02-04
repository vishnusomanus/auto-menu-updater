<?php
class AMU_Settings_Page {
    private $option_name = 'auto_menu_updater_settings';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page() {
        add_options_page('Auto Menu Updater', 'Menu Updater', 'manage_options', 'auto-menu-updater', [$this, 'settings_page']);
    }

    public function register_settings() {
        register_setting('auto_menu_updater_group', $this->option_name, [$this, 'sanitize_settings']);

        // Add settings section
        add_settings_section(
            'amu_main_section',
            'Main Settings',
            [$this, 'section_text'],
            'auto-menu-updater'
        );

        // Add API URL field
        add_settings_field(
            'amu_api_url',
            'API URL',
            [$this, 'api_url_input'],
            'auto-menu-updater',
            'amu_main_section'
        );

        // Add Menu ID field
        add_settings_field(
            'amu_menu_id',
            'Select Menu',
            [$this, 'menu_id_select'],
            'auto-menu-updater',
            'amu_main_section'
        );

        // Add Cron Interval field
        add_settings_field(
            'amu_cron_interval',
            'Cron Interval',
            [$this, 'cron_interval_select'],
            'auto-menu-updater',
            'amu_main_section'
        );
    }

    public function sanitize_settings($input) {
        $sanitized = [];

        $sanitized['api_url'] = isset($input['api_url']) ? esc_url_raw($input['api_url']) : '';
        $sanitized['menu_id'] = isset($input['menu_id']) ? intval($input['menu_id']) : 0;
        $sanitized['cron_interval'] = isset($input['cron_interval']) ? sanitize_text_field($input['cron_interval']) : 'hourly';

        return $sanitized;
    }

    public function section_text() {
        echo '<p>Configure the API URL, select the menu to update, and set the cron interval.</p>';
    }

    public function api_url_input() {
        $options = get_option($this->option_name, []);
        ?>
        <input type="text" name="<?php echo esc_attr($this->option_name); ?>[api_url]"
               value="<?php echo esc_attr($options['api_url'] ?? ''); ?>"
               class="regular-text">
        <?php
    }

    public function menu_id_select() {
        $options = get_option($this->option_name, []);
        $menus = wp_get_nav_menus();
        ?>
        <select name="<?php echo esc_attr($this->option_name); ?>[menu_id]">
            <?php foreach ($menus as $menu): ?>
                <option value="<?php echo esc_attr($menu->term_id); ?>"
                    <?php selected($options['menu_id'] ?? '', $menu->term_id, false); ?>>
                    <?php echo esc_html($menu->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function cron_interval_select() {
        $options = get_option($this->option_name, []);
        $intervals = [
            'every_min' => 'Every Minute',
            'every_5min' => 'Every 5 Minutes',
            'every_10min' => 'Every 10 Minutes',
            'every_15min' => 'Every 15 Minutes',
            'every_30min' => 'Every 30 Minutes',
            'hourly' => 'Every Hour',
            'daily' => 'Every Day',
            'weekly' => 'Every Week',
            'monthly' => 'Every Month',
        ];
        ?>
        <select name="<?php echo esc_attr($this->option_name); ?>[cron_interval]">
            <?php foreach ($intervals as $value => $label): ?>
                <option value="<?php echo esc_attr($value); ?>"
                    <?php selected($options['cron_interval'] ?? '', $value, false); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function settings_page() {
        $sample_api_url = rest_url('amu/v1/sample-menu');
        $home_url = home_url('/');
        $about_url = home_url('/about');
        $team_url = home_url('/about/team');
        ?>
        <div class="wrap">
            <h2>Automatic Menu Updater</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('auto_menu_updater_group');
                do_settings_sections('auto-menu-updater');
                submit_button('Save Settings');
                ?>
            </form>

            <h3>Sample API</h3>
            <p>You can use the following sample API endpoint to test the plugin:</p>
            <p><strong>Endpoint:</strong> <code><?php echo esc_url($sample_api_url); ?></code></p>
            <p><strong>Sample Response:</strong></p>
            <pre>
[
    {
        "title": "Home",
        "url": "<?php echo esc_url($home_url); ?>",
        "parent_id": 0,
        "classes": ["home-link"],
        "target": "_self",
        "description": "Go to the homepage",
        "attr_title": "Homepage",
        "xfn": "nofollow",
        "object_id": 0,
        "object": "custom",
        "type": "custom",
        "order": 1
    },
    {
        "title": "About",
        "url": "<?php echo esc_url($about_url); ?>",
        "parent_id": 0,
        "classes": ["about-link"],
        "target": "_self",
        "description": "Learn more about us",
        "attr_title": "About Us",
        "xfn": "",
        "object_id": 0,
        "object": "custom",
        "type": "custom",
        "order": 2
    },
    {
        "title": "Team",
        "url": "<?php echo esc_url($team_url); ?>",
        "parent_id": "About",
        "classes": ["team-link"],
        "target": "_blank",
        "description": "Meet our team",
        "attr_title": "Our Team",
        "xfn": "",
        "object_id": 0,
        "object": "custom",
        "type": "custom",
        "order": 3
    }
]
            </pre>
        </div>
        <?php
    }
}

// Instantiate the settings page class
new AMU_Settings_Page();
