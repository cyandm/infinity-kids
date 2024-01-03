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
      $section = "basic_settings";

      $wp_customize->add_section(
        $section,
        [
          'title' => 'تنظیمات اولیه',
          'priority' => 1
        ]
      );

      $this->cyn_add_control($wp_customize, $section, "file", "cyn_second_logo", "آیکون دوم");
      $this->cyn_add_control($wp_customize, $section, "file", "cyn_footer_img", "تصویر فوتر");
    }

    private function cyn_add_control($wp_customize, $section, $type, $id, $label)
    {
      $wp_customize->add_setting(
        $id,
        ['type' => 'option']
      );

      if ($type == "file") {
        $wp_customize->add_control(
          new WP_Customize_Upload_Control(
            $wp_customize,
            $id,
            array(
              'label' => $label,
              'section' => $section,
              'settings' => $id
            )
          )
        );
      } else {
        $wp_customize->add_control(
          $id,
          array(
            'label' => $label,
            'section' => $section,
            'settings' => $id,
            'type' => $type
          )
        );
      }
    }

    public function cyn_register_nav()
    {
      register_nav_menus([
        'header' => 'Header'
      ]);
    }
  }
}
