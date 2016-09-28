<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">主页</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">积少成多</div>
            <div class="panel-body">
                <p>不积跬步，无以至千里；不积小流，无以成江河。</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">喜欢文章</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                    <?php
                    if(!empty($articles)){
                        foreach($articles as $article){
                    ?>
                    <tr>
                        <td><?php echo "<a href='/homes/view/{$article['Article']['id']}'>{$article['Article']['title']}</a>"; ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php if($article['Article']['islove']){ ?>
                            <a href="/homes/loveArticle/<?php echo $article['Article']['id'];?>/0"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-heart"></i></button></a>
                            <?php }else{ ?>
                            <a href="/homes/loveArticle/<?php echo $article['Article']['id'];?>/1"><button type="button" class="btn btn-default btn-circle"><i class="fa fa-check"></i></button></a>
                            <?php } ?>
                        </td>
                        <td><small><?php echo $article['Article']['created']; ?></small></td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>
                <p style="text-align: right;">
                    <?php
                $this->Paginator->options(array('url'=>array_merge(array(
                    //'rlt'=>((!empty($rlt)) ? $rlt : '')
                    ),$this->passedArgs)));
                    echo $this->Paginator->counter(array(
                    'format' => __('共有 %count% 条记录，当前第 %page%/%pages% 页')
                    ));
                    //分页显示
                    echo $this->Paginator->first('【 首页 】')." ";
                    echo $this->Paginator->prev('【 上一页 】',array())." ";
                    echo $this->Paginator->numbers()." ";
                    echo $this->Paginator->next('【 下一页 】',array())." ";
                    echo $this->Paginator->last('【 尾页 】',array());
                    ?>
                </p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
