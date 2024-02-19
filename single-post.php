<?php
$cynProduct = new cyn_products();
$post_id    = get_the_ID();
$postCategories = wp_get_post_categories($post_id);
$postTitle      = get_the_title($post_id);
$postPermalink  = get_the_permalink($post_id);
$relatedPosts   = get_field("related_posts", $post_id);
$likedPosts     = get_field("liked_posts", $post_id);
?>

<?php get_header(); ?>

<main class="main-body" role="main">
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="container">
      <a href="<?= site_url() ?>">خانه</a>
      <i class="iconsax" icon-name="arrow-left"></i>

      <a href="<?= site_url() . '/blog' ?>">مقالات</a>
      <i class="iconsax" icon-name="arrow-left"></i>

      <?php if (is_array($postCategories) && count($postCategories) > 0) : ?>
        <?php $term = $cynProduct->cyn_getProductTermAttr($postCategories[0]); ?>

        <a href="<?= $term['url'] ?>">
          <?= $term['name'] ?>
        </a>
        <i class="iconsax" icon-name="arrow-left"></i>
      <?php endif; ?>

      <a href="<?= $postPermalink ?>">
        <?= $postTitle ?>
      </a>
  </nav>

  <section class="container">
    <div class="post-header">
      <h1 class="title"><?= $postTitle ?></h1>
      <img src="<?= get_the_post_thumbnail_url($post_id, "full") ?>" alt="<?= $postTitle ?>">

      <div class="post-details">

      </div>
    </div>
    <div class="clearfix s-11"></div>

    <article class="article-content">
      <?php the_content() ?>
    </article>
    <div class="clearfix s-11"></div>

    <!-- <div class="comments" id="comments">
      <div class="caption">
        <h2>دیدگاه ها<i></i>
          <small>
            <span>
              <?php //echo get_comments_number($id); 
              ?>
            </span>
            دیدگاه
          </small>
        </h2>
      </div>

      <?php //comments_template(); 
      ?>
    </div> -->
  </section>
  <div class="clearfix s-11"></div>

  <?php
  if (isset($relatedPosts) && !empty($relatedPosts)) :
    get_template_part('/templates/loop/swiper-products', null, [
      'queryArgs'   => array(
        'post_type' => 'post',
        'post__in'  => $relatedPosts
      ),
      'parentClass' => "container",
      'navigation'  => true,
      'title'       => "مقالات مرتبط",
      'bgDark'      => false,
      'before'      => '<section class="">',
      'after'       => '</section> <div class="clearfix s-11"></div>',
      'blog'        => true
    ]);
  endif;

  if (isset($likedPosts) && !empty($likedPosts)) :
    get_template_part('/templates/loop/swiper-products', null, [
      'queryArgs'   => array(
        'post_type' => 'post',
        'post__in'  => $likedPosts
      ),
      'parentClass' => "container",
      'navigation'  => true,
      'title'       => "شاید بپسندید",
      'bgDark'      => false,
      'before'      => '<section class="">',
      'after'       => '</section> <div class="clearfix s-11"></div>',
      'blog'        => true
    ]);
  endif;
  ?>
</main>

<?php get_footer(); ?>