<?php /* Template Name: Login */ ?>

<?php
$userLink = get_permalink(get_option('woocommerce_myaccount_page_id'));
if (is_user_logged_in()) {
  wp_redirect($userLink);
  exit();
}

$get_header_footer = isset($args['get_header_footer']) ? $args['get_header_footer'] : true;
?>

<?php
$cyn_sms = new cyn_sms();
$prePass = constant('SECURE_AUTH_KEY');

$pageCondition = $_POST
  && isset($_POST["user_tel"]);

$otpCondition  = $_POST
  && isset($_POST["user_tel_h"])
  && isset($_POST["otp-inp-n1"])
  && isset($_POST["otp-inp-n2"])
  && isset($_POST["otp-inp-n3"])
  && isset($_POST["otp-inp-n4"]);

$params = array();
$alerts = array();


if ($pageCondition) {
  $tel = substr((string)$_POST["user_tel"], -10);
  $params["user_tel"] = $tel;
  $is_user = username_exists($tel);
  $user = get_user_by('login', $tel);

  if ($is_user == false && $user == false) {
    $newUser = wp_create_user(
      $tel,
      $prePass . "-" . $tel
    );

    if (!is_wp_error($newUser)) {
      $newOtp = rand(1000, 9999);
      $currentTime = current_time('timestamp');

      update_user_option($newUser, 'show_admin_bar_front', false);
      $addMeta = update_user_meta($newUser, "cyn_otp", array('otp' => $newOtp, 'time' => $currentTime));

      if ($addMeta != false) {
        $cyn_sms->cyn_send_verification(array($tel), $newOtp);
      } else {
        $alerts[] = 'مشکلی در ذخیره داده ها به وجود آمده. لطفا دوباره امتحان کنید';
      }
    } else {
      $alerts[] = 'مشکلی در ایجاد کاربر به وجود آمده. لطفا دوباره امتحان کنید.';
    }
  } else {
    $userID = $user->ID;
    $newOtp = rand(1000, 9999);
    $currentTime = current_time('timestamp');

    $addMeta = update_user_meta($userID, "cyn_otp", array('otp' => $newOtp, 'time' => $currentTime));

    if ($addMeta != false) {
      $cyn_sms->cyn_send_verification(array($tel), $newOtp);
    } else {
      $alerts[] = 'مشکلی در ذخیره داده ها به وجود آمده. لطفا دوباره امتحان کنید';
    }
  }
}

if ($otpCondition) {
  $otpN1 = (int)$_POST["otp-inp-n1"];
  $otpN2 = (int)$_POST["otp-inp-n2"];
  $otpN3 = (int)$_POST["otp-inp-n3"];
  $otpN4 = (int)$_POST["otp-inp-n4"];
  $otp = $otpN1 . $otpN2 . $otpN3 . $otpN4;

  $tel = substr((string)$_POST["user_tel_h"], -10);
  $user = get_user_by('login', $tel);

  if ($user != false) {
    $userID = $user->ID;
    $metaOtp = get_user_meta($userID, 'cyn_otp', true);
    $currentTime = current_time('timestamp');

    if ($otp == $metaOtp['otp'] && ($currentTime - $metaOtp['time']) < 300) {
      $signon = wp_signon(array(
        'user_login' => $tel,
        'user_password' => $prePass . "-" . $tel,
        'remember' => true
      ));

      if (!is_wp_error($signon)) {
        update_user_meta($userID, "cyn_otp", "");
        wp_redirect($userLink);
        exit();
      } else {
        $alerts[] = 'مشکلی در ورود به وجود آمده. لطفا دوباره امتحان کنید';
      }
    } else {
      $alerts[] = 'رمز وارد شده صحیح نمیباشد یا زمان آن به اتمام رسیده';
    }
  } else {
    $alerts[] = 'کاربر مورد نظر پیدا نشد';
  }
}
?>

<?php if ($get_header_footer)
  get_header(); ?>

<main class="main-body login">
  <div class="clearfix s-16"></div>

  <div class="container">
    <div class="login-container">
      <div class="r">
        <form action="./" method="POST" id="user_login_form" class="w-100">
          <div class="tel">
            <label for="user_tel_inp">شماره همراه خود را <span>بدون صفر</span> وارد نمایید</label>
            <div class="clearfix s-2"></div>

            <div class="">
              <?php if (!$pageCondition) : ?>
                <div class="input-group ltr">
                  <button type="button" class="btn">+98</button>
                  <input type="tel" name="user_tel" class="form-control f-ltr" variant="search" id="user_tel_inp" pattern="[9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" minlength="10" maxlength="10" placeholder="9xx-xxx-xxxx" required />
                </div>
              <?php else : ?>
                <div class="input-group ltr">
                  <button type="button" class="btn">+98</button>
                  <input type="tel" name="" class="form-control f-ltr" variant="search" id="user_tel_inp" value="<?php echo isset($params["user_tel"]) ? $params["user_tel"] : ''; ?>" disabled />
                </div>
                <input type="hidden" name="user_tel_h" value="<?php echo isset($params["user_tel"]) ? $params["user_tel"] : ''; ?>">
              <?php endif; ?>
            </div>
          </div>
          <div class="clearfix s-4"></div>

          <?php if (!$pageCondition) : ?>
            <button class="btn" variant="primary" id="send_otp" type="submit">
              ارسال کد تایید یک‌بار مصرف
            </button>
          <?php else : ?>
            <button class="btn" variant="primary" id="otp_timer" type="button" disabled>
              ارسال مجدد کد تایید
              5:00
            </button>
          <?php endif; ?>

          <?php if ($pageCondition) : ?>
            <div class="clearfix s-11"></div>
            <div class="otp-inputs" id="otp-inputs">
              <input type="number" name="otp-inp-n1" id="" class="otp-inp form-control" min="0" max="9" placeholder="X" maxlength="1" required />
              <input type="number" name="otp-inp-n2" id="" class="otp-inp form-control" min="0" max="9" placeholder="X" maxlength="1" required />
              <input type="number" name="otp-inp-n3" id="" class="otp-inp form-control" min="0" max="9" placeholder="X" maxlength="1" required />
              <input type="number" name="otp-inp-n4" id="" class="otp-inp form-control last" min="0" max="9" placeholder="X" maxlength="1" required />
            </div>
            <div class="clearfix s-4"></div>

            <button class="btn" variant="primary" id="submit_otp" type="submit">تایید</button>
          <?php endif; ?>

          <?php if (count($alerts) > 0) : ?>
            <div class="form-alert flex flex-col gap-2">
              <?php foreach ($alerts as $alert) : ?>
                <div class="alert-item bg-secondary-500 rounded text-center p-2">
                  <p class="text-sm"><?php echo $alert; ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </form>
      </div>

      <div class="l">
        <div class="">
          <img src="<?php echo get_template_directory_uri() . '/assets/img/login.webp' ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix s-16"></div>
</main>

<?php if ($get_header_footer)
  get_footer(); ?>