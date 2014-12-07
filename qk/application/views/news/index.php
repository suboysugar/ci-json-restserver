<p><a href="/qk/news/create">创建</a></p>

<?php foreach ($news as $news_item): ?>

    <h2><?php echo $news_item['title'] ?></h2>
    <div id="main">
        <?php echo $news_item['text'] ?>
    </div>
    <p><a href="view/<?php echo $news_item['id'] ?>">查看</a></p>
    <p><a href="update/<?php echo $news_item['id'] ?>">更新</a></p>
    <p><a href="delete/<?php echo $news_item['id'] ?>">删除</a></p>

<?php endforeach ?>
