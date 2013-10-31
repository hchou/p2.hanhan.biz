<h1>Posts from Users You are Following</h1>

<?php foreach($posts as $post): ?>

<article>
    <br>
    <h4><?=$post['first_name'] ?> <?=$post['last_name']?> posted:</h4>

    <p><?=$post['content'] ?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>
    
    <!-- If logged in user is an administrator, show a delete link -->
    <?php if ($user->role < 2): ?>
        <td><a href='/posts/delete/<?=$post['post_id'] ?>'>Delete</a></td>
    <?php endif; ?>

    <br><br>
</article>

<?php endforeach; ?>