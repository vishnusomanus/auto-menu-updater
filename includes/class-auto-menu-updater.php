<?php
class Auto_Menu_Updater {
    public function __construct() {
        add_action('init', [$this, 'schedule_cron_event']);
        add_action('auto_menu_updater_cron_hook', [$this, 'update_menu_from_api']);
    }

    public function schedule_cron_event() {
        if (!wp_next_scheduled('auto_menu_updater_cron_hook')) {
            wp_schedule_event(time(), 'hourly', 'auto_menu_updater_cron_hook');
        }
    }

    public function update_menu_from_api() {
        $options = get_option('auto_menu_updater_settings', []);
        if (empty($options['api_url']) || empty($options['menu_id'])) {
            return;
        }

        $response = wp_remote_get($options['api_url']);
        if (is_wp_error($response)) {
            return;
        }

        $menu_data = json_decode(wp_remote_retrieve_body($response), true);
        if (!is_array($menu_data)) {
            return;
        }

        $menu_id = intval($options['menu_id']);

        // Remove all existing menu items
        $existing_items = wp_get_nav_menu_items($menu_id);
        if ($existing_items) {
            foreach ($existing_items as $item) {
                wp_delete_post($item->ID, true);
            }
        }

        // Store menu item IDs for parent-child relationships
        $menu_item_ids = [];

        // First pass: Create all menu items
        foreach ($menu_data as $item) {
            $menu_item_args = [
                'menu-item-title' => $item['title'],
                'menu-item-url' => $item['url'],
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => 0, // Default to top-level
                'menu-item-classes' => implode(' ', $item['classes'] ?? []),
                'menu-item-target' => $item['target'] ?? '_self',
                'menu-item-description' => $item['description'] ?? '',
                'menu-item-attr-title' => $item['attr_title'] ?? '',
                'menu-item-xfn' => $item['xfn'] ?? '',
                'menu-item-object-id' => $item['object_id'] ?? 0,
                'menu-item-object' => $item['object'] ?? 'custom',
                'menu-item-type' => $item['type'] ?? 'custom',
                'menu-item-position' => $item['order'] ?? 0,
            ];

            $menu_item_id = wp_update_nav_menu_item($menu_id, 0, $menu_item_args);
            $menu_item_ids[$item['title']] = $menu_item_id; // Store ID for reference
        }

        // Second pass: Update parent-child relationships
        foreach ($menu_data as $item) {
            if (!empty($item['parent_id'])) {
                // Find the parent menu item ID
                $parent_item = array_filter($menu_data, function ($parent) use ($item) {
                    return $parent['title'] === $item['parent_id'];
                });
                $parent_item = reset($parent_item);

                if ($parent_item) {
                    $parent_item_id = $menu_item_ids[$parent_item['title']];
                    wp_update_nav_menu_item($menu_id, $menu_item_ids[$item['title']], [
                        'menu-item-title' => $item['title'],
                        'menu-item-url' => $item['url'],
                        'menu-item-status' => 'publish',
                        'menu-item-classes' => implode(' ', $item['classes'] ?? []),
                        'menu-item-target' => $item['target'] ?? '_self',
                        'menu-item-description' => $item['description'] ?? '',
                        'menu-item-attr-title' => $item['attr_title'] ?? '',
                        'menu-item-xfn' => $item['xfn'] ?? '',
                        'menu-item-object-id' => $item['object_id'] ?? 0,
                        'menu-item-object' => $item['object'] ?? 'custom',
                        'menu-item-type' => $item['type'] ?? 'custom',
                        'menu-item-position' => $item['order'] ?? 0,
                        'menu-item-parent-id' => $parent_item_id,
                    ]);
                }
            }
        }
    }
}

// Instantiate the class
new Auto_Menu_Updater();
