<?php
class AMU_Cron_Handler {
    public function __construct() {
        add_action('init', [$this, 'schedule_event']);
        add_filter('cron_schedules', [$this, 'add_custom_cron_intervals']);
    }

    public function add_custom_cron_intervals($schedules) {
        $schedules['every_min'] = [
            'interval' => 60, // 1 minute
            'display' => __('Every Minute','auto-menu-updater'),
        ];
        $schedules['every_5min'] = [
            'interval' => 300, // 5 minutes
            'display' => __('Every 5 Minutes','auto-menu-updater'),
        ];
        $schedules['every_10min'] = [
            'interval' => 600, // 10 minutes
            'display' => __('Every 10 Minutes','auto-menu-updater'),
        ];
        $schedules['every_15min'] = [
            'interval' => 900, // 15 minutes
            'display' => __('Every 15 Minutes','auto-menu-updater'),
        ];
        $schedules['every_30min'] = [
            'interval' => 1800, // 30 minutes
            'display' => __('Every 30 Minutes','auto-menu-updater'),
        ];
        $schedules['weekly'] = [
            'interval' => 604800, // 1 week
            'display' => __('Once Weekly','auto-menu-updater'),
        ];
        $schedules['monthly'] = [
            'interval' => 2592000, // 1 month (approx)
            'display' => __('Once Monthly','auto-menu-updater'),
        ];
        return $schedules;
    }

    public function schedule_event() {
        $options = get_option('auto_menu_updater_settings', []);
        $interval = $options['cron_interval'] ?? 'hourly';

        if (!wp_next_scheduled('auto_menu_updater_cron_hook')) {
            wp_schedule_event(time(), $interval, 'auto_menu_updater_cron_hook');
        } else {
            $next_scheduled = wp_get_schedule('auto_menu_updater_cron_hook');
            if ($next_scheduled !== $interval) {
                wp_clear_scheduled_hook('auto_menu_updater_cron_hook');
                wp_schedule_event(time(), $interval, 'auto_menu_updater_cron_hook');
            }
        }
    }
}