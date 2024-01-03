(() => {
  // assets/js/pages/header.js
  jQuery(document).ready(($) => {
    const openSearchBtn = $("#open-header-search");
    $(openSearchBtn).on("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const inputGroup = $(openSearchBtn).next();
      $(inputGroup).fadeToggle(
        250,
        "linear",
        () => {
          if ($(inputGroup).hasClass("active"))
            $(inputGroup).removeClass("active");
          else
            $(inputGroup).addClass("active");
        }
      );
    });
  });
  jQuery(document).ready(($) => {
    const openMobileMenu = $("#header-mobile #open-mobile-menu");
    const menuModal = $("#header-mobile #mobile-menu-modal");
    const closeModal = $("#header-mobile #mobile-menu-modal, #header-mobile .close-modal");
    const modalContainer = $("#header-mobile #mobile-menu-modal .modal-container");
    $(openMobileMenu).on("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      if (!$(menuModal).hasClass("active"))
        $(menuModal).addClass("active");
    });
    $(closeModal).on("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      $(menuModal).removeClass("active");
    });
    $(modalContainer).on("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
    });
  });
})();
