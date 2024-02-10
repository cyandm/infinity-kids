<?php

$queryArgs = array(
  'post_type' => 'product',
  'posts_per_page' => 16
);

get_template_part('/templates/swiper-products', null, [
  'queryArgs' => $queryArgs,
  'navigation' => true,
  'title' => "تخفیف خورده ها",
  'showAll' => "#",
  'bgDark' => false
]);

?>
<div class="clearfix s-11"></div>
