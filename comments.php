<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $singleCommentOptions)
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
      <?php $comments->gravatar(50, $singleCommentOptions->defaultAvatar);    //头像 只输出 img 没有其它标签 
      ?>
      <div class="comment-info">
        <div>
          <cite class="fn"><?php $singleCommentOptions->beforeAuthor();
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
            
          <span>
            <?php $options = Typecho_Widget::widget('Widget_Options');
            if ($options->iphome == '0') {
              echo (getiphome($comments->ip));
            } ?>
          </span>

        </div>
        <div class="comment-reply">
          <?php $comments->reply($singleCommentOptions->replyWord); ?>
        </div>
      </div>

    </div>
    
    <div class="comment-content alert alert-secondary">
      <?php $con=$comments->content; echo getparseBiaoQing($con); //输出评论内容，包含 <p></p> 标签 
      ?>
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
<div id="comments">
  <?php $this->comments()->to($comments); ?>

  <?php if ($this->allow('comment')) : ?>
  <div class="container">
    <div id="<?php $this->respondId(); ?>">
      <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
      </div>

      <h4 id="response"><?php _e('添加新评论'); ?></h4>
      <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
        <?php if ($this->user->hasLogin()) : ?>
          <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
          </p>
        <?php else : ?>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" id="basic-addon1" for="author"><?php _e('昵称*'); ?></label>
            </div>

            <input placeholder="" type="text" name="author" id="author" class="form-control" value="<?php $this->remember('author'); ?>" required />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" id="basic-addon1" for="mail" <?php if ($this->options->commentsRequireMail) : ?> <?php endif; ?>><?php _e('Email'); ?></label>
            </div>
            <input placeholder="" type="email" name="mail" id="mail" class="form-control" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" id="basic-addon1" for="url" <?php if ($this->options->commentsRequireURL) : ?> <?php endif; ?>><?php _e('网站'); ?></label>
            </div>
            <input placeholder="" type="url" name="url" id="url" class="form-control" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
          </div>

        <?php endif; ?>
        <div class="form-group">
          <textarea placeholder="说点什么吧..." name="text" id="textarea" class="form-control" rows="4"><?php $this->remember('text'); ?></textarea>
          <p class="item-submit">
            <a class="bq-button btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">owo</a>
            <button type="submit" id="submit" class="btn btn-primary"><?php _e('提交评论'); ?></button>
              <div class="collapse" id="collapseExample">
                <div class="card card-body bq-list">
                  <?php echo parseBiaoQing(); ?>
                </div>
              </div>
        </div>

        </p>
      </form>
    </div>
  </div>
  <?php else : ?>

  <?php endif; ?>

  <?php if ($comments->have()) : ?>
    <p><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></>
      <?php $comments->listComments(); ?>
      <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
</div>