<div class="ui main text container" style="min-height:100%;">
    <h1 class="ui header">Blog du site</h1>
    <!-- <form method="post" action="" class="ui form"> -->
        <?= $this->Form->create(null, ['class'=>['ui','form'],'url'=>['action'=>'publishBlog']]) ?>
        <div class="field">
            <label>Votre nouveau billet de blog</label>
            <textarea name="message"></textarea>
            <button type="submit" class="ui blue labeled submit icon button">
                <i class="icon edit"></i> Add Reply
            </button>
        </div>
        <?= $this->Form->end() ?>
    <!-- </form> -->

    <div class="ui cards">
        <?php
        foreach ($posts as $post) {
        ?>
            <div class="card">
                <div class="content">
                    <div class="header"><?= $post->get('author')->get('fullname') ?></div>
                    <div class="meta"><?= $post->get('date_add') ?></div>
                    <div class="description">
                        <?= $post->get('message') ?>
                    </div>
                    <div class="ui comments">
                        <h3 class="ui dividing header">Comments</h3>
                        <?php foreach($post->get('comments') as $comment) {?>
                        <div class="comment">
                            <div class="content">
                                <a class="author"><?= $comment->get('author')->get('fullname') ?></a>
                                <div class="metadata">
                                    <span class="date"><?= $comment->get('date_comment') ?></span>
                                </div>
                                <div class="text">
                                    <?= $comment->get('comment') ?>
                                </div>
                                <!-- <div class="actions">
                                    <a class="reply">Reply</a>
                                </div> -->
                            </div>
                        </div>
                        <?php } ?>
                        <form class="ui reply form">
                            
                            <div class="field">
                                <textarea></textarea>
                            </div>
                            <div class="ui blue labeled submit icon button">
                                <i class="icon edit"></i> Add Reply
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>