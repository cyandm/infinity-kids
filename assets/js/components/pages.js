/** Blog page term select **/
jQuery(document).ready(($) => {
  $("#blog-head-term-select").on("change", (e) => {
    e.preventDefault();
    const termVal = e.target.value;
    window.open(termVal, "_self");
  });
});