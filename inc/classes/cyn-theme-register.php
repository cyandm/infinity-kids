<?php

if (!class_exists('cyn_register')) {
  class cyn_register
  {

    function __construct()
    {
      add_action('init', [$this, 'cyn_register_tax']);
      add_action('after_setup_theme', [$this, 'cyn_register_nav']);
      add_action('customize_register', [$this, 'cyn_basic_settings']);
    }

    public function cyn_register_nav()
    {
      register_nav_menus([
        'header'          => "منوی هدر",
        'footer_shop'     => "فروشگاه",
        'footer_articles' => "مطالب مفید",
        'footer_services' => "خدمات مشتریان"
      ]);
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
      $this->cyn_add_control($wp_customize, $section, "textarea", "cyn_shop_address", "آدرس فروشگاه");
      $this->cyn_add_control($wp_customize, $section, "textarea", "cyn_shop_map", "نقشه");
      $this->cyn_add_control($wp_customize, $section, "textarea", "cyn_shop_support", "پشتیبانی");
      $this->cyn_add_control($wp_customize, $section, "tel", "cyn_phone_number1", "شماره تماس 1");
      $this->cyn_add_control($wp_customize, $section, "tel", "cyn_phone_number2", "شماره تماس 2");
      $this->cyn_add_control($wp_customize, $section, "url", "cyn_instagram", "آدرس اینستاگرام");
      $this->cyn_add_control($wp_customize, $section, "url", "cyn_pinterest", "آدرس پینترست");
      $this->cyn_add_control($wp_customize, $section, "url", "cyn_whatsapp", "آدرس واتساپ");
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

    public function cyn_register_tax()
    {
      // -> init offers taxonomy
      $cyn_offers_tax_name = $GLOBALS['cyn_offers_tax_name'];
      $args = array(
        'labels' => array(
          'name' => "پیشنهادات",
          'menu_name' => "پیشنهادات",
          'all_items' => "همه پیشنهادات",
          'add_new_item' => "افزودن پیشنهاد جدید",
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
      );
      register_taxonomy($cyn_offers_tax_name, array('product'), $args);
      // insert offers terms
      $this->cyn_insert_terms(array(), $cyn_offers_tax_name);

      // -> init cyn_colors taxonomy
      $cyn_colors_tax_name = $GLOBALS['cyn_colors_tax_name'];
      $args = array(
        'labels' => array(
          'name' => "رنگبندی",
          'menu_name' => "رنگبندی",
          'all_items' => "همه رنگبندی ها",
          'add_new_item' => "افزودن رنگبندی جدید",
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
      );
      register_taxonomy($cyn_colors_tax_name, array('product'), $args);
      // insert cyn_colors terms
      $this->cyn_insert_terms(array(), $cyn_colors_tax_name);

      // -> init cyn_ages taxonomy
      $cyn_ages_tax_name = $GLOBALS['cyn_ages_tax_name'];
      $args = array(
        'labels' => array(
          'name' => "رده سنی",
          'menu_name' => "رده سنی",
          'all_items' => "همه رده سنی ها",
          'add_new_item' => "افزودن رده سنی جدید",
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
      );
      register_taxonomy($cyn_ages_tax_name, array('product'), $args);
      // insert cyn_ages terms
      $this->cyn_insert_terms(array(), $cyn_ages_tax_name);
    }

    private function cyn_insert_terms($new_tags, $taxonomy_name)
    {
      if (count($new_tags) < 1)
        return;

      foreach ($new_tags as $tag => $name) {
        $term_exist = get_term_by('slug', $tag, $taxonomy_name);
        if ($term_exist == false)
          wp_insert_term(
            $name,
            $taxonomy_name,
            array(
              'slug' => $tag
            )
          );
      }
    }
  }
}
