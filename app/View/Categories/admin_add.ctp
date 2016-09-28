<h1>添加类型</h1>
<form action="/admin/categories/add" id="PostAdminAddForm" method="post" accept-charset="utf-8">
    <div class="input text">
        <label>类型名称</label>
        <input name="data[Category][title]" type="text"/>
    </div>
    <div class="submit">
        <input  type="submit" value="确定"/>
    </div>
</form>
<br/>
<a href="/admin/categories/index">返回类型管理列表</a>