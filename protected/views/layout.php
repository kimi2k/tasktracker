<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($title) ? $title : ''; ?></title>
    <link rel="stylesheet" href="/css/normalize.css"/>
    <link rel="stylesheet" href="/css/foundation.min.css"/>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="/js/vendor/modernizr.js"></script>

</head>
<body>

<? /* header start */?>
<div class="row">
    <div class="large-12 columns">
        <div class="nav-bar right">
            <ul class="button-group top-nav">
                <li><a href="/" class="button">Home</a></li>
                <li><a href="#" data-reveal-id="addTask" class="button">Add task</a></li>
                <li><a href="#" data-reveal-id="addCategory" class="button">Add category</a></li>
                <li><a href="/statistics" class="button">Statistics</a></li>

            </ul>
        </div>
        <h1>TaskTracker <small>Planning it's simple</small></h1>
        <hr/>
    </div>
</div>
<? /* header end */?>

<? //add task modal ?>
<div id="addTask" class="reveal-modal " data-reveal>
    <form>
        <div class="row">
        <h4>New task</h4>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Task title
                    <input type="text" placeholder="" name="title"/>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Task description
                    <textarea placeholder="" rows="5" name="description"></textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <label>Time limit
                    <input type="text" placeholder="hh:mm:ss" value="" name="time_limit" />
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Category
                    <select name="category">
                        <option value="0">Not Selected</option>
                        <?php foreach($categories as $cat) {?>
                        <option value="<?php echo $cat['id']?>"><?php echo $cat['title']?></option>
                        <? }?>
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
              <button type="button">Add</button>
            </div>
        </div>

    </form>
</div>
<? //end add task modal ?>

<? //add category modal ?>
<div id="addCategory" class="reveal-modal " data-reveal>
    <form>
        <div class="row">
            <h4>New Category</h4>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Category title
                    <input type="text" placeholder="" name="title"/>
                </label>
                <label>Category description
                    <input type="text" placeholder="" name="description"/>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <button type="button">Add</button>
            </div>
        </div>

    </form>
</div>
<? //end add category modal ?>


<div class="row">
    <? // content start ?>
    <div class="large-9 columns" role="content">
        <?php echo isset($body_content) ? $body_content : ''; ?>
    </div>
    <? // content end ?>
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
                    <div> <input type="checkbox" value="<?php echo $cat['id']?>"> <?php echo $cat['title']?></div>
                    <?php endforeach; ?>
                </div>
                <? endif; ?>
                <a href="javascript:void(0)" id="more_categories">Show all</a>
                <a href="javascript:void(0)" id="hide_categories">Hide</a>
                <button class="button [tiny small large]">Find</button>
            </form>

    </aside>
    <? //sidebar end ?>

</div>

<footer class="row">
    <div class="large-12 columns">
        <hr/>
        <div class="row">
            <div class="large-6 columns">
                <p>© 2014</p>
            </div>
            <div class="large-6 columns">
                <ul class="inline-list right">
                    <li><a href="/">Home</a></li>
                    <li><a href="#" data-reveal-id="addTask">Add task</a></li>
                    <li><a href="#" data-reveal-id="addCategory"> Add category</a></li>

                    <li><a href="/statistics" >Statistics</a></li>

<!--                    <li><a href="#">Link 2</a></li>-->
<!--                    <li><a href="#">Link 3</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="/js/vendor/jquery.js"></script>
<script type="text/javascript" src="/js/vendor/phpjs.js"></script>
<script type="text/javascript" src="/js/vendor/foundation.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery.ba-tinypubsub.min.js"></script>
<script type="text/javascript" src="/js/vendor/jquery.ba-outside-events.js"></script>
<script type="text/javascript" src="/js/vendor/handlebars.js"></script>
<script type="text/javascript" src="/js/timer.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
<? //modules
if (isset($jsModules) && !empty($jsModules)) {
    foreach($jsModules as $module) {
        ?>
        <script type="text/javascript" src="/js/modules/<?php echo $module?>.js"></script>
        <?
    }
}
?>
<script type="text/javascript" src="/js/init.js"></script>

</body>
</html>