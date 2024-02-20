<?php

if (!class_exists('cyn_products')) {
  class cyn_products
  {

    function __construct()
    {
    }

    /** product terms **/
    public function cyn_getProductTerms($parent0 = true, $onlyId = false, $taxonomy = "product_cat")
    {
      global $wpdb;
      $terms = [];

      if (is_int($parent0)) {
        $termsID = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='$taxonomy' AND parent='$parent0'");
      } elseif ($parent0 == true) {
        $termsID = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='$taxonomy' AND parent='0'");
      } else {
        $termsID = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='$taxonomy'");
      }

      foreach ($termsID as $tId) {
        if ($onlyId == true) {
          $terms[] = $tId;
        } else {
          $termAttr = $this->cyn_getProductTermAttr($tId);
          $terms[$termAttr['id']] = $termAttr;
        }
      }

      return $terms;
    }

    public function cyn_getProductTermAttr($termID)
    {
      global $wpdb;
      $termsAttr = array();
      $wpTerm    = get_term($termID);
      $termUrl   = get_term_link($wpTerm);
      $termMeta  = $wpdb->get_row("SELECT meta_value FROM $wpdb->termmeta WHERE term_id=$termID AND meta_key='thumbnail_id'");

      $termsAttr["id"]     = $termID;
      $termsAttr["name"]   = $wpTerm->name;
      $termsAttr["slug"]   = $wpTerm->slug;
      $termsAttr["parent"] = $wpTerm->parent;
      $termsAttr["count"]  = $wpTerm->count;
      $termsAttr["url"]    = $termUrl;

      if (isset($termMeta)) {
        $termAttach = wp_get_attachment_url($termMeta->meta_value);
        $termThumb = wp_get_attachment_image_url($termMeta->meta_value);

        $termsAttr["attachment"] = $termAttach;
        $termsAttr["thumbnail"] = $termThumb;
      }

      return $termsAttr;
    }


    /** archive product filter **/
    public function cyn_archive_pre_get_posts($query)
    {
      if ($query->is_archive && $query->is_main_query() && !is_admin() && !is_category()) {
        function filterNumbers($val)
        {
          return ((int)$val > 0);
        }

        $getCats   = isset($_GET['cats']) ? array_filter(explode(",", $_GET['cats']), "filterNumbers") : [];
        $getAges   = isset($_GET['ages']) ? array_filter(explode(",", $_GET['ages']), "filterNumbers") : [];
        $getColors = isset($_GET['colors']) ? array_filter(explode(",", $_GET['colors']), "filterNumbers") : [];

        $tax_query = array('relation' => "AND");

        if (count($getCats) > 0) {
          $tax_query[] = array(
            'taxonomy' => $GLOBALS['wc_cats_tax_name'],
            'field' => "term_id",
            'terms' => $getCats,
          );
        }

        if (count($getAges) > 0) {
          $tax_query[] = array(
            'taxonomy' => $GLOBALS['cyn_ages_tax_name'],
            'field' => "term_id",
            'terms' => $getAges,
          );
        }

        if (count($getColors) > 0) {
          $tax_query[] = array(
            'taxonomy' => $GLOBALS['cyn_colors_tax_name'],
            'field' => "term_id",
            'terms' => $getColors,
          );
        }

        $query->set('tax_query', $tax_query);
        $GLOBALS["archive_query"] = $query;
      }
    }
  }
}
