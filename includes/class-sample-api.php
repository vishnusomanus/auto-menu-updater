<?php
class AMU_Sample_API {
    public function __construct() {
        add_action('rest_api_init', [$this, 'register_sample_api']);
    }

    public function register_sample_api() {
        register_rest_route('amu/v1', '/sample-menu', [
            'methods' => 'GET',
            'callback' => [$this, 'get_sample_menu'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function get_sample_menu() {
        return [
            [
                "title" => "Home",
                "url" => home_url('/'),
                "parent_id" => 0,
                "classes" => ["home-link"],
                "target" => "_self",
                "description" => "Go to the homepage",
                "attr_title" => "Homepage",
                "xfn" => "nofollow",
                "object_id" => 0,
                "object" => "custom",
                "type" => "custom",
                "order" => 1
            ],
            [
                "title" => "About",
                "url" => home_url('/about'),
                "parent_id" => 0,
                "classes" => ["about-link"],
                "target" => "_self",
                "description" => "Learn more about us",
                "attr_title" => "About Us",
                "xfn" => "",
                "object_id" => 0,
                "object" => "custom",
                "type" => "custom",
                "order" => 2
            ],
            [
                "title" => "Team",
                "url" => home_url('/about/team'),
                "parent_id" => "About",
                "classes" => ["team-link"],
                "target" => "_blank",
                "description" => "Meet our team",
                "attr_title" => "Our Team",
                "xfn" => "",
                "object_id" => 0,
                "object" => "custom",
                "type" => "custom",
                "order" => 3
            ],
            [
                "title" => "History",
                "url" => home_url('/about/history'),
                "parent_id" => "About",
                "classes" => ["team-link"],
                "target" => "_blank",
                "description" => "History",
                "attr_title" => "History",
                "xfn" => "",
                "object_id" => 0,
                "object" => "custom",
                "type" => "custom",
                "order" => 3
            ]
        ];
    }
}