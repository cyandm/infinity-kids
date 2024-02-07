<?php /* Template Name: Front Page */ ?>

<?php get_header(); ?>

<main class="main-body">
  <?php
  get_template_part('/templates/home/head-slider', null, []);
  get_template_part('/templates/home/head-cats', null, []);
  get_template_part('/templates/home/head-product-cat', null, []);
  ?>
</main>

<?php get_footer(); ?>