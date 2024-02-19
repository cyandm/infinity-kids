<?php
$cynProducts = new cyn_products();
$paged       = (get_query_var('paged')) ? get_query_var('paged') : 1;
$productCats = $cynProducts->cyn_getProductTerms(true, false, $GLOBALS['wc_cats_tax_name']);
// $offersCats  = $cynProducts->cyn_getProductTerms(true, false, $GLOBALS['cyn_offers_tax_name']);
$agesCats    = $cynProducts->cyn_getProductTerms(true, false, $GLOBALS['cyn_ages_tax_name']);
$colorsCats  = $cynProducts->cyn_getProductTerms(true, false, $GLOBALS['cyn_colors_tax_name']);
// $productAndOffers = array_merge($productCats, $offersCats);

$getCats   = isset($_GET['cats']) ? explode(",", $_GET['cats']) : [];
$getAges   = isset($_GET['ages']) ? explode(",", $_GET['ages']) : [];
$getColors = isset($_GET['colors']) ? explode(",", $_GET['colors']) : [];
?>

<aside class="sidebar">
  <form class="input-group" action="<?php echo site_url() ?>" method="GET">
    <button type="submit" class="btn iconsax" icon-name="search-normal-2"></button>
    <input name="s" type="text" class="form-control" variant="search" placeholder="جستجو" required>
  </form>
  <div class="clearfix s-6"></div>

  <form id="archive-product-filter-form" class="filter-form" action="" method="GET">
    <?php /* wc_cats_tax_name */ ?>
    <?php if (count($productCats) > 0) : ?>
      <div class="filter-container">
        <div class="title">
          <p class="h3">دسته بندی</p>
        </div>
        <div class="clearfix s-0"></div>

        <?php foreach ($productCats as $termId => $termAttr) : ?>
          <?php if ($termAttr['parent'] == 0) : ?>
            <button class="btn" variant="<?= in_array($termAttr['id'], $getCats) ? 'secondary' : 'text-light' ?>" type="button" data-cat="<?= $termAttr['id'] ?>" data-tax="cats">
              <?= $termAttr['name'] ?>
            </button>

            <?php foreach ($productCats as $childTermId => $childTermAttr) : ?>
              <?php if ($childTermAttr['parent'] == $termAttr['id']) : ?>
                <button class="btn child-term" variant="<?= in_array($childTermAttr['id'], $getCats) ? 'secondary' : 'text-light' ?>" type="button" data-cat="<?= $childTermAttr['id'] ?>" data-tax="cats">
                  <?= $childTermAttr['name'] ?>
                </button>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="clearfix s-6"></div>
    <?php endif; ?>

    <?php /* cyn_ages_tax_name */ ?>
    <?php if (count($agesCats) > 0) : ?>
      <div class="filter-container">
        <div class="title">
          <p class="h3">سن</p>
        </div>
        <div class="clearfix s-0"></div>

        <?php foreach ($agesCats as $termId => $termAttr) : ?>
          <?php if ($termAttr['parent'] == 0) : ?>
            <button class="btn" variant="<?= in_array($termAttr['id'], $getAges) ? 'secondary' : 'text-light' ?>" type="button" data-cat="<?= $termAttr['id'] ?>"  data-tax="ages">
              <?= $termAttr['name'] ?>
            </button>

            <?php foreach ($agesCats as $childTermId => $childTermAttr) : ?>
              <?php if ($childTermAttr['parent'] == $termAttr['id']) : ?>
                <button class="btn child-term" variant="<?= in_array($childTermAttr['id'], $getAges) ? 'secondary' : 'text-light' ?>" type="button" data-cat="<?= $childTermAttr['id'] ?>"  data-tax="ages">
                  <?= $childTermAttr['name'] ?>
                </button>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="clearfix s-6"></div>
    <?php endif; ?>

    <?php /* cyn_colors_tax_name */ ?>
    <?php if (count($colorsCats) > 0) : ?>
      <div class="filter-container">
        <div class="title">
          <p class="h3">رنگ</p>
        </div>
        <div class="clearfix s-0"></div>

        <div class="colors">
          <?php foreach ($colorsCats as $termId => $termAttr) : ?>
            <button class="btn" type="button" variant="<?= in_array($termAttr['id'], $getColors) ? 'secondary' : 'text-light' ?>" data-cat="<?= $termAttr['id'] ?>"  data-tax="colors" title="<?= $termAttr['name'] ?>">
              <img src="<?= get_field("cat_image", $GLOBALS['cyn_colors_tax_name'] . "_" . $termId) ?>" alt="<?= $termAttr['name'] ?>">
            </button>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="clearfix s-6"></div>
    <?php endif; ?>

    <input type="hidden" name="orderby" value='<?= isset($_GET['orderby']) ? $_GET['orderby'] : '' ?>'>
    <input type="hidden" name="cats" value='<?= isset($_GET['cats']) ? $_GET['cats'] : '' ?>'>
    <input type="hidden" name="ages" value='<?= isset($_GET['ages']) ? $_GET['ages'] : '' ?>'>
    <input type="hidden" name="colors" value='<?= isset($_GET['colors']) ? $_GET['colors'] : '' ?>'>
    <input type="hidden" name="page" value='<?= $paged ?>'>

    <input type="submit" value="submit">
  </form>
</aside>