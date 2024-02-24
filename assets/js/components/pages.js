/** Blog page term select **/
jQuery(document).ready(($) => {
  $("#blog-head-term-select").on("change", (e) => {
    e.preventDefault();
    const termVal = e.target.value;
    window.open(termVal, "_self");
  });
});

/** Single product page sizes guide modal **/
jQuery(document).ready(($) => {
  const sizesGuideModal = $("#sizes-guide-modal")[0];
  if (!sizesGuideModal)
    return;

  $("#sizes-guide-open").on("click", (e) => {
    e.preventDefault();

    if (!$(sizesGuideModal).hasClass("active")) {
      $(sizesGuideModal).addClass("active");
      $(document.body).css("overflow", "hidden");
    }
  });

  $("[data-action='close-sizes']").on("click", (e) => {
    e.preventDefault();

    if ($(e.target).attr("data-action") === "close-sizes") {
      $(sizesGuideModal).removeClass("active");
      $(document.body).attr("style", "");
    }
  });
});