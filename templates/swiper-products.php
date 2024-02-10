<?php

/**
 * $queryArgs: array;
 * $parentClass: string;
 * $before: string;
 * $after: string;
 * $navigation: boolean;
 * $title: string;
 * $showAll: string;
 * $bgDark: boolean;
 * $smPerPage: number;
 */

$queryArgs   = isset($args['queryArgs']) ? $args['queryArgs'] : [];
$parentClass = isset($args['parentClass']) ? $args['parentClass'] : "";
$navigation  = isset($args['navigation']) ? $args['navigation'] : false;
$bgDark      = isset($args['bgDark']) ? $args['bgDark'] : false;
$smPerPage   = isset($args['smPerPage']) ? $args['smPerPage'] : 3;

$wpQuery = new WP_Query($queryArgs);
if (!$wpQuery->have_posts())
  return wp_reset_postdata();
?>

<?php echo isset($args['before']) ? $args['before'] : '' ?>
<div class="<?= $parentClass ?>">
  <div class="swiper-products swiper <?= $bgDark ? 'bg-dark' : '' ?>">
    <?php if ($navigation) : ?>
      <div class="swiper-navigation">
        <?php if (isset($args['title'])) : ?>
          <h3 class="title h2"><?= $args['title'] ?></h3>
        <?php endif; ?>

        <div class="navigation-btns">
          <button class="swiper-btn-prev btn" variant="default"><i class="iconsax" icon-name="chevron-right"></i></button>
          <button class="swiper-btn-next btn" variant="default"><i class="iconsax" icon-name="chevron-left"></i></button>
        </div>

        <?php if (isset($args['showAll'])) : ?>
          <a href="<?= $args['showAll'] ?>" class="btn show-all" variant="<?= $bgDark ? 'text-secondary' : 'text-primary' ?>">
            مشاهده همه
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="swiper-wrapper">
      <?php
      while ($wpQuery->have_posts()) :
        $wpQuery->the_post();
        echo '<div class="swiper-slide">';
        wc_get_template_part('content', 'product');
        echo "</div>";
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
  </div>

  <div class="swiper-products-sm <?= $bgDark ? 'bg-dark' : '' ?>">
    <?php if ($navigation) : ?>
      <div class="swiper-navigation">
        <?php if (isset($args['title'])) : ?>
          <h3 class="title h2"><?= $args['title'] ?></h3>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="">
      <?php
      $counter = 0;
      while ($wpQuery->have_posts() && $counter < $smPerPage) :
        $wpQuery->the_post();
        wc_get_template_part('content', 'product-sm');
        $counter++;
      endwhile;
      wp_reset_postdata();
      ?>
    </div>

    <?php if (isset($args['showAll'])) : ?>
      <div class="f-row c-auto">
        <a href="<?= $args['showAll'] ?>" class="btn show-all" variant="<?= $bgDark ? 'text-secondary' : 'text-primary' ?>">
          مشاهده همه
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php echo isset($args['after']) ? $args['after'] : '' ?>