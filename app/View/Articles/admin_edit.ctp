<h1>编辑文章</h1>
<form action="/admin/articles/edit/<?php echo $article['Article']['id']; ?>" method="post" accept-charset="utf-8">
    <div class="input text">
        <label>文章标题</label>
        <input name="data[Article][title]" type="text" value="<?php echo $article['Article']['title']; ?>"/>
    </div>
    <div class="input text">
        <label>类型</label>
        <select name="data[Article][category_id]">
            <?php
            foreach($categories as $category){
                echo "<option value='{$category['Category']['id']}'";
                echo ($article['Article']['category_id'] == $category['Category']['id']) ? "selected" : '';
                echo ">{$category['Category']['title']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="input textarea">
        <label>文章内容</label>
        <textarea id="ArticleContent" name="data[Article][content]" rows="6" cols="30"><?php echo $article['Article']['content']; ?></textarea>
    </div>
    <div class="submit">
        <input  type="submit" value="确定"/>
    </div>
</form>
<br/>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'ArticleContent' );
</script>
<a href="/admin/articles/index">返回文章管理列表</a>