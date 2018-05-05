<?php foreach($data as $d): ?>
    <?php if ($d['parent_id'] == 0): ?>
        <ul class="list-group">
            <li class="list-group-item node-treeview1" data-nodeid="0" style="color:undefined;background-color:undefined;">
                <span class="icon expand-icon glyphicon glyphicon-plus"></span>
                <span class="icon node-icon"><?php echo $this->getTranslate($d['id'], $lang); ?></span>
                <ul class="list-group">
                    <?php foreach($d['nodes'] as $childs): ?>
                        <li class="list-group-item node-treeview1" data-nodeid="0" style="color:undefined;background-color:undefined;">
                            <span class="icon expand-icon glyphicon glyphicon-plus"></span>
                            <span class="icon node-icon"><?php $this->getTranslate($d['id'], $lang); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    <?php endif; ?>
<?php endforeach; ?>