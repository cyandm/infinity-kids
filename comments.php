<?php

if (have_comments()) :
?>
  <div class="comment-list" id="comment-list">
    <?php
    $list = wp_list_comments(
      array(
        'style' => 'div',
        'short_ping' => true,
        'avatar_size' => 0,
      )
    );
    ?>
  </div>
<?php
else :
?>
  <div class="comment-list">
    <p style="margin-top: 1rem;">دیدگاهی وجود ندارد.</p>
  </div>
<?php
endif;


comment_form(
  array(
    'logged_in_as' => null,
    'title_reply' => "ارسال دیدگاه جدید",
    'title_reply_to' => "ارسال پاسخ به %s",
    'comment_field' => '<div class="input-group"><textarea id="comment" name="comment" class="form-control" rows="3" maxlength="65525" placeholder="دیدگاه شما" required></textarea></div>',
    'id_submit' => "submit-commentform",
    'class_submit' => "btn-primary cursor-pointer",
    'name_submit' => "submit-commentform",
    'label_submit' => "ارسال دیدگاه",
    'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
  )
);

?>