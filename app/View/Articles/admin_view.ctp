<h1>文章查看</h1>
<div class="input text">
    <label>文章标题</label>
    <?php echo $article['Article']['title']; ?>
</div>
<div class="input text">
    <label>类型</label>
    <?php echo $article['Category']['title']; ?>
</div>
<div class="input textarea">
    <label>文章内容</label>
    <?php echo $article['Article']['content']; ?>
</div>

<br/>
<a href="/admin/articles/index">返回文章管理列表</a>