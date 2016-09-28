<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">文章详情 <small> --- <a href="/homes/listByCategory/<?php echo $article['Article']['category_id']; ?>">文章列表</a></small></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="col-lg-12">
    <div class="well">
        <h3>
            <?php echo $article['Article']['title']; ?> &nbsp;&nbsp;&nbsp;
            <small><?php echo $article['Article']['created'];?></small>
        </h3>
        <p><?php echo $article['Article']['content'];?></p>
    </div>
</div>
<style>#AdLayer {position:absolute;width:20px;display:none;height:59px;top:0px;right:26px;}</style>
<DIV id=AdLayer><A href="#top"><IMG src="/img/top.gif"></A></DIV>
<script src="/js/lanrentuku.js"></script>