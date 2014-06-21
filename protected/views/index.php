<script id="tasklist_tpl" type="text/x-handlebars-template">
    <tr id="task_{{id}}" class="task {{classes}}" task="{{id}}" time="{{taskTime}}" limit="{{limit}}">
        <td>{{id}}</td>
        <td>{{name}}</td>
        <td>{{caption}}</td>
        <td>{{created}}</td>
        <td class="limit">{{timeLimit}}</td>
        <td class="timer">{{timer}}</td>
        <td style='width:88px'>
        <img src="/img/play.png"  class="start" title="start" alt="start"/>
        <img src="/img/pause.png" class="pause" title="pause" alt="pause" />
        <img src="/img/finish_flag.png" class="finish" title="finish" alt="finish" />
        <img src="/img/delete.png" class='delete' id="{{id}}" title="delete" alt="delete" />
        <img src="/img/reload.png" class='revert' id="{{id}}" title="revert" alt="revert" />
        </td>
    </tr>
</script>
<div class="large-9 columns" role="content">
    <article>
        <table class="large-12 columns">
            <thead>
                <tr>
                    <th>№</th>
                    <th class="large-3">Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Time limit</th>
                    <th>Spent time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tasklist">

            </tbody>
        </table>
    </article>
</div>

<? //sidebar start ?>
<aside class="large-3 columns">
    <div class="panel">
        <h5>Worked:
            <span class="right total_timer"><span>00</span>:<span>00</span>:<span>00</span></span></h5>
    </div>
    <div class="panel">
        <h5>Task filter</h5>
        <form action="" method="GET" id="taskFilter">
            <input type="text" name="date" value="<?php echo isset($_GET['date'])?$_GET['date']:date('Y.m.d')?>" id="filter_date"/>
            <?php if (isset($categories) && !empty($categories)):?>
                <label>Categories:</label>
                <div class="category_filter small">
                    <?php foreach ($categories as $cat):?>
                        <div> <input type="checkbox" value="<?php echo $cat['id']?>" name="categories[]" <?php echo (isset($_REQUEST['categories']) && in_array($cat['id'],$_REQUEST['categories']))?"checked=checked":""?>> <?php echo $cat['title']?></div>
                    <?php endforeach; ?>
                </div>
            <? endif; ?>
            <a href="javascript:void(0)" id="more_categories">Show all</a>
            <a href="javascript:void(0)" id="hide_categories">Hide</a>
            <button class="button [tiny small large]">Find</button>
        </form>

</aside>
<? //sidebar end ?>