**Automatic Menu Updater**
==========================

A WordPress plugin that automatically updates WordPress menus via API calls. It supports multi-level menus, all menu attributes, and customizable cron intervals.

**Features**
------------

*   **API Integration**: Fetches menu data from an external API.
    
*   **Multi-Level Menus**: Supports hierarchical (nested) menu structures.
    
*   **All Menu Attributes**: Handles titles, URLs, classes, targets, descriptions, and more.
    
*   **Cron Scheduling**: Updates menus at customizable intervals (e.g., every minute, hourly, daily).
    
*   **Sample API**: Includes a built-in sample API endpoint for testing.
    

**Installation**
----------------

1.  Download the plugin files and place them in the wp-content/plugins/auto-menu-updater directory.
    
2.  Activate the plugin through the **Plugins** page in the WordPress admin.
    
3.  Go to **Settings > Menu Updater** to configure the plugin.
    

**Configuration**
-----------------

1.  **API URL**: Enter the URL of the API that provides the menu data.
    
2.  **Select Menu**: Choose the WordPress menu to update.
    
3.  **Cron Interval**: Set how often the menu should be updated (e.g., every minute, hourly, daily).
    

**Sample API**
--------------

The plugin includes a sample API endpoint for testing:

*   **Endpoint**: /wp-json/amu/v1/sample-menu
    
    ```json 
        [{
            "title": "Home",
            "url": "https://example.com/",
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
            "url": "https://example.com/about",
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
            "url": "https://example.com/about/team",
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
        }]
     ```
    

**Usage**
---------

1.  **Set Up the API**:
    
    *   Ensure your API returns menu data in the required JSON format.
        
    ```json 
    [{
        "title": "Home",
        "url": "https://example.com/",
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
    }]
    ```
        
2.  **Configure the Plugin**:
    
    *   Go to **Settings > Menu Updater**.
        
    *   Enter the API URL and select the menu to update.
        
    *   Choose the desired cron interval.
        
3.  **Test the Plugin**:
    
    *   Use the sample API endpoint to test the plugin.
        
    *   Verify that the selected menu is updated correctly.
        

**Cron Intervals**
------------------

The plugin supports the following cron intervals:

*   Every Minute
    
*   Every 5 Minutes
    
*   Every 10 Minutes
    
*   Every 15 Minutes
    
*   Every 30 Minutes
    
*   Every Hour
    
*   Every Day
    
*   Every Week
    
*   Every Month
    

**Customization**
-----------------

*   **Custom API**: Replace the sample API with your own API endpoint.
    
*   **Custom Cron Intervals**: Add new intervals by modifying the add\_custom\_cron\_intervals method in the AMU\_Cron\_Handler class.
    

**Troubleshooting**
-------------------

*   **Menu Not Updating**:
    
    *   Check the API URL and ensure it returns valid JSON.
        
    *   Verify that the selected menu exists in WordPress.
        
*   **Cron Not Running**:
    
    *   Ensure the cron interval is set correctly.
        
    *   Check the WordPress cron system using a plugin like **WP Crontrol**.
        

**Changelog**
-------------

### **Version 1.1**

*   Added support for multi-level menus.
    
*   Added all menu attributes (e.g., classes, targets, descriptions).
    
*   Added a sample API endpoint for testing.
    
*   Added a cron interval dropdown in the settings page.
    

### **Version 1.1**

*   Initial release with basic menu updating functionality.
    

**License**
-----------

This plugin is licensed under the **GPLv2** or later.

**Contributing**
----------------

Contributions are welcome! Please open an issue or submit a pull request on [GitHub](https://github.com/vishnusomanus/auto-menu-updater).

**Support**
-----------

For support, please open an issue on [GitHub](https://github.com/vishnusomanus/auto-menu-updater) or contact the developer directly.