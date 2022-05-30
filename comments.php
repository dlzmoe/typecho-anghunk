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
        <div class="comment-by-author">
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
            ?></span>

        </div>
        <div class="comment-reply">
          <?php $comments->reply($singleCommentOptions->replyWord); ?>
        </div>
      </div>

    </div>
    <div class="comment-content alert alert-secondary">
      <?php $comments->content(); //输出评论内容，包含 <p></p> 标签 
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
    <hr>
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
          <div class="item">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">昵称</span>
              </div>
              <input autocomplete="off" type="text" class="form-control" name="author" id="author" placeholder="">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">邮箱</span>
              </div>
              <input autocomplete="off" type="email" class="form-control" name="mail" id="mail" placeholder="">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">网站</span>
              </div>
              <input autocomplete="off" type="url" class="form-control" name="url" id="url" placeholder="https://">
            </div>
          </div>
        <?php endif; ?>
        <div class="form-group">
          <textarea placeholder="说点什么吧..." name="text" id="textarea" class="form-control" id="exampleFormControlTextarea1" rows="4"><?php $this->remember('text'); ?></textarea>
        </div>
        <p class="item-submit">
          <button type="submit" class="btn btn-primary"><?php _e('提交评论'); ?></button>
        </p>
      </form>
    </div>
  <?php else : ?>

  <?php endif; ?>

  <?php if ($comments->have()) : ?>
    <p><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></>
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
  <?php endif; ?>
</div>