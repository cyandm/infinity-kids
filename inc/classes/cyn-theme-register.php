<?php

if (!class_exists('cyn_register')) {
  class cyn_register
  {

    function __construct()
    {
      add_action('customize_register', [$this, 'cyn_basic_settings']);
      add_action('after_setup_theme', [$this, 'cyn_register_nav']);
    }

    public function cyn_basic_settings($wp_customize)
    {
      $wp_customize->add_section('basic_settings', [
        'title' => 'تنظیمات اولیه',
        'priority' => 1
      ]);

      // ADD Second Custom Logo 
      $wp_customize->add_setting(
        'cyn_second_logo',
        [
          'type' => 'option'
        ]
      );
      $wp_customize->add_control(
        new WP_Customize_Upload_Control(
          $wp_customize,
          'cyn_second_logo',
          array(
            'label' => 'آیکون دوم',
            'section' => 'basic_settings',
            'settings' => 'cyn_second_logo'
          )
        )
      );
    }

    public function cyn_register_nav()
    {
      register_nav_menus([
        'header' => 'Header'
      ]);
    }
  }
}
