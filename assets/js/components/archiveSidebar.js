/** Product archive sidebar on change **/
jQuery(document).ready(($) => {
  $("#archive-product-filter-form button").on("click", (e) => {
    const catId = $(e.target).attr("data-cat");
    const tax = $(e.target).attr("data-tax");

    const catsInput = $("#archive-product-filter-form input[name='cats']")[0];
    const agesInput = $("#archive-product-filter-form input[name='ages']")[0];
    const colorsInput = $("#archive-product-filter-form input[name='colors']")[0];

    if (!catsInput || !agesInput || !colorsInput)
      return;

    let taxInput;
    switch (tax) {
      case "cats":
        taxInput = catsInput;
        break;
      case "ages":
        taxInput = agesInput;
        break;
      case "colors":
        taxInput = colorsInput;
        break;
      default:
        taxInput = catsInput;
        break;
    }

    const catsValue = $(taxInput).attr("value");
    const btnVariant = $(e.target).attr("variant");
    if (btnVariant == "secondary") {
      $(e.target).attr("variant", "text-light");
      $(taxInput).attr("value", catsValue.replaceAll(catId + ",", ""));
    } else {
      $(e.target).attr("variant", "secondary");
      $(taxInput).attr("value", catsValue + catId + ",");
    }
  });

  $("#product-archive-ordering input[name='orderby']").on("change", (e) => {
    const orderby = $(e.target).attr("value");
    const orderbyInput = $("#archive-product-filter-form input[name='orderby']")[0];

    if (!orderbyInput)
      return;

    $(orderbyInput).attr("value", orderby);
  });
});
