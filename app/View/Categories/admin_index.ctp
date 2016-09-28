<h1>类型管理列表</h1>
<br/><a href="/admin/categories/add">添加类型</a><br/>
<table>
    <tr>
        <th>Id</th>
        <th>标题</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($results as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['title'],
            array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
        <td>
            <?php echo $this->Html->link('编辑',
            array('controller' => 'categories', 'action' => 'edit', $category['Category']['id'])); ?>
            <?php echo $this->Html->link(
            '删除',
            array('controller' => 'categories', 'action' => 'delete', $category['Category']['id']),
            array(),
            "您确定要删除‘{$category['Category']['title']}’类型吗?"
            );?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
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
<br/>
<a href="/admin/users/home">返回管理主页</a>