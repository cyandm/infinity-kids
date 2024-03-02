/** Home faq **/
jQuery(document).ready(($) => {
  const faqItem = $(".home-faq .faq-item");
  const faqTitle = $(".home-faq .faq-item .faq-title");
  const faqContent = $(".home-faq .faq-item .faq-content");

  $(faqTitle).on("click", (e) => {
    e.preventDefault();

    const nextContent = $(e.target).next();
    const parentItem = $(e.target).parent(".faq-item");

    if ($(parentItem).hasClass("active")) {
      // deactivate current item
      $(nextContent).slideUp(250);
      $(parentItem).removeClass("active");
    } else {
      // deactivate all items
      $(faqContent).slideUp(250);
      $(faqItem).removeClass("active");
      // active current item
      $(nextContent).slideDown(250);
      $(parentItem).addClass("active");
    }
  });
});

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

/* Login Page */
jQuery(document).ready(($) => {
  const logiForm = $("#user_login_form");

  if (logiForm) {
    // numbers keyup
    const otp_inps = $("#user_login_form .otp-inputs .otp-inp");

    $(otp_inps).on('keyup', (e) => {
      e.preventDefault();
      const thisTarget = e.target;

      if (thisTarget.value && thisTarget.value !== "") {
        const hasClass = $(thisTarget).hasClass('last');

        if (thisTarget.value.length > 1) {
          thisTarget.value = thisTarget.value.slice(1, 2);
        }

        if (!hasClass) {
          const nextInp = $(thisTarget).next("input[type='number'].otp-inp")[0];
          $(nextInp).focus();
        }
      } else {
        const prevInp = $(thisTarget).prev("input[type='number'].otp-inp")[0];
        $(prevInp).focus();
      }
    });

    // otp timer
    const otp_timer = $("#user_login_form #otp_timer");
    if (otp_timer) {
      const timer = {
        t: 300,
        m: 0,
        s: 0
      }

      const timerInterval = setInterval(() => {
        if (timer.t > 0) {
          timer.t--;
          timer.m = parseInt(timer.t / 60);
          timer.s = timer.t % 60;

          $(otp_timer).text(`ارسال مجدد کد تایید در ${timer.m}:${timer.s}`);
        } else {
          clearInterval(timerInterval);
          $(otp_timer).prop('disabled', false);
          $(otp_timer).text('ارسال مجدد کد تایید');
        }
      }, 1000);

      $(otp_timer).on("click", (e) => {
        e.preventDefault();
        window.location.reload();
      })
    }
  }
});

/** Cart page cart items **/
/*
jQuery(document).ready(($) => {
  const removeItem = $("main.main-body.page section.cart-items .cart_item .product-details .product-remove .btn");
  $(removeItem).on("click", (e) => {
    const items = $("main.main-body.page section.cart-items .cart_item");
    if(items.length < 2) {
      window.location.reload();
    }
  });
});
*/