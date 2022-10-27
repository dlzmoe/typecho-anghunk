<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
define('__TYPECHO_GRAVATAR_PREFIX__', 'https://cravatar.cn/avatar/');
function threadedComments($comments, $singleCommentOptions)
{

  $commentClass = '';
  if ($comments->authorId) {
    if ($comments->authorId == $comments->ownerId) {
      $commentClass .= ' comment-by-author';
    } else {
      $commentClass .= ' comment-by-user';
    }
  }

  $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
?>
  <li id="<?php $comments->theId(); ?>" class="comment-body<?php
                                                            if ($comments->_levels > 0) {
                                                              echo ' comment-child';
                                                              $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
                                                            } else {
                                                              echo ' comment-parent';
                                                            }
                                                            $comments->alt(' comment-odd', ' comment-even');
                                                            echo $commentClass;
                                                            //以上部份 不用理会，是判断一些奇偶数评论和作者类的，下面的才是需要修改的，根据需要修改吧， php部份不需要 修改，只需要修改 HTML 部分，下面是我现在用的
                                                            ?>">
    <div class="comment-img">
      <?php $comments->gravatar(100, $singleCommentOptions->defaultAvatar);    //头像 只输出 img 没有其它标签 
      ?>
      <div class="comment-info">
        <cite class="fn">
          <?php $singleCommentOptions->beforeAuthor();
          $comments->author();
          $singleCommentOptions->afterAuthor(); //输出评论者 
          ?>
        </cite>
        <em> · </em>
        <span class="comment-meta">
          <?php $singleCommentOptions->beforeDate();
          $comments->date($singleCommentOptions->dateFormat);
          $singleCommentOptions->afterDate();  //输出评论日期 
          ?>
        </span>
      </div>

    </div>

    <div class="comment-content">
      <?php $parentMail = get_comment_at($comments->coid) ?>
      <?php echo $parentMail; ?>
      <?php $con = $comments->content;
      echo getparseBiaoQing($con); ?>
    </div>

    <div class="comment-reply">
      <span>
        <?php $options = Typecho_Widget::widget('Widget_Options');
        if ($options->iphome == '0') {
          echo (getiphome($comments->ip));
        } ?>
      </span>
      <?php $comments->reply($singleCommentOptions->replyWord); ?>
    </div>

    <?php if ($comments->children) { ?>
      <div class="comment-children">
        <?php $comments->threadedComments($singleCommentOptions); //评论嵌套
        ?>
      </div>
    <?php } ?>

  </li>
<?php
}
?>
<div class="container">

  <div id="comments">
    <?php $this->comments()->to($comments); ?>

    <?php if ($this->allow('comment')) : ?>
      <div>
        <div id="<?php $this->respondId(); ?>">
          <div class="cancel-comment-reply">
            <?php $comments->cancelReply(); ?>
          </div>

          <h4 id="response">
            <?php _e('添加新评论'); ?>
          </h4>
          <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if ($this->user->hasLogin()) : ?>
              <p>
                <?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>">
                  <?php $this->user->screenName(); ?>
                </a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">
                  <?php _e('退出'); ?> &raquo;
                </a>
              </p>
            <?php else : ?>

              <div class="input-group-wrap">
                <p class="input-group">
                  <input autocomplete="off" type="text" name="author" id="author" class="input" value="<?php $this->remember('author'); ?>" required />
                  <label for="author" class="required user-label">
                    <?php _e('昵称*'); ?>
                  </label>
                </p>
                <p class="input-group">
                  <input autocomplete="off" type="email" name="mail" id="mail" class="input" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required <?php endif; ?> />
                  <label for="mail" <?php if ($this->options->commentsRequireMail) : ?> class="required user-label" <?php endif; ?>>
                    <?php _e('Email*'); ?>
                  </label>
                </p>
                <p class="input-group">
                  <input autocomplete="off" type="url" name="url" id="url" class="input" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required <?php endif; ?> />
                  <label for="url" class="required user-label">
                    <?php _e('url'); ?>
                  </label>
                </p>
              </div>

            <?php endif; ?>
            <div class="form-group">
              <div class="">
                <textarea placeholder="说点什么？" name="text" id="textarea" class="input textarea" rows="4"><?php $this->remember('text'); ?></textarea>
              </div>

              <p class="item-submit">
                <a class="bq-button btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">OωO</a>

                <button type="submit" id="submit" class="bq-button btn btn-primary">
                  <?php _e('提交'); ?>
                </button>


              <div class="collapse" id="collapseExample">
                <div class="card card-body bq-list">
                  <?php echo parseBiaoQing(); ?>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    <?php else : ?>

    <?php endif; ?>

    <?php if ($comments->have()) : ?>
      <p style="color:#19130b;font-size:18px;">
        <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?>
      </p>
      <?php $comments->listComments(); ?>
      <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
  </div>

</div>
