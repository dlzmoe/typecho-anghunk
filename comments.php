<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
  <?php $this->comments()->to($comments); ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
      <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
      </div>

      <h4 id="response"><?php _e('添加新评论'); ?></h4>
      <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
        <?php if ($this->user->hasLogin()) : ?>
          <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
          </p>
        <?php else : ?>
          <p class="item-input">
            <label for="author" class="required"><?php _e('称呼'); ?></label>
            <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
          </p>
          <p class="item-input">
            <label for="mail" <?php if ($this->options->commentsRequireMail) : ?> class="required" <?php endif; ?>><?php _e('Email'); ?></label>
            <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> />
          </p>
          <p class="item-input">
            <label for="url" <?php if ($this->options->commentsRequireURL) : ?> class="required" <?php endif; ?>><?php _e('网站'); ?></label>
            <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
          </p>
        <?php endif; ?>
        <p class="item-textarea">
          <label for="textarea" class="required"><?php _e('内容'); ?></label>
          <textarea placeholder="支持匿名评论，如果你希望得到回复，可以填写邮箱和昵称。" rows="8" cols="50" name="text" id="textarea" class="textarea" required><?php $this->remember('text'); ?></textarea>
        </p>
        <p>
          <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
        </p>
      </form>
    </div>
  <?php if ($comments->have()) : ?>

    <!--<h4><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h4>-->
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
  <?php endif; ?>
  <?php if ($this->allow('comment')) : ?>

    
  <?php else : ?>
    <h4><?php _e('评论已关闭'); ?></h4>
  <?php endif; ?>
</div>