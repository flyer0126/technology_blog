<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="搜索...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="/homes/index" <?php echo $this->request->url=="homes/index" ?"class='active'":""; ?>>
                    <i class="fa fa-dashboard fa-fw"></i> 主页
                </a>
            </li>
            <?php
            if(!empty($categories)){
                foreach($categories as $cItem){
            ?>
            <li>
                <a href="/homes/listByCategory/<?php echo $cItem['Category']['id']; ?>"
                    <?php echo (isset($category['Category']['title']) && $category['Category']['title']==$cItem['Category']['title']) ?"class='active'":""; ?>>
                    <i class="fa fa-table fa-fw"></i> <?php echo $cItem['Category']['title']; ?></span>
                </a>
            </li>
            <?php }} ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>