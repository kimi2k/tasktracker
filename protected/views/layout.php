<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($title) ? $title : ''; ?></title>
    <link rel="stylesheet" href="/css/normalize.css"/>
    <link rel="stylesheet" href="/css/foundation.min.css"/>
    <link rel="stylesheet" href="/css/app.css"/>
</head>
<body>

<? /* header start */?>
<div class="row">
    <div class="large-12 columns">
        <div class="nav-bar right">
            <ul class="button-group">
                <li><a href="/" class="button">Home</a></li>
            </ul>
        </div>
        <h1>TaskTracker <small>Planning it's simple</small></h1>
        <hr/>
    </div>
</div>
<? /* header end */?>




<div class="row">
    <? // content start ?>
    <div class="large-9 columns" role="content">
        <?php echo isset($body_content) ? $body_content : ''; ?>
    </div>
    <? // content end ?>
    <? //sidebar start ?>
    <aside class="large-3 columns">
<!--        <h5>Today: --><?//=date('d.m.Y')?><!--</h5>-->
        <div class="panel">
            <h5>Worked:
           <span class="right">00:00:00</span></h5>
        </div>
        <div class="panel">
            <h5>Task filter</h5>
            <form action="" method="GET" id="taskFilter">
                <input type="text" value="<?=date('d.m.Y')?>"/>
                <label>Categories:</label>
                <div class="category_filter small">
                    <div> <input type="checkbox"> Name1</div>
                    <div> <input type="checkbox"> Name2</div>
                    <div> <input type="checkbox"> Name2</div>
                    <div> <input type="checkbox"> Name2</div>
                </div>
                <a href="javascript:void(0)" id="more_categories">Show all</a>
                <a href="javascript:void(0)" id="hide_categories">Hide</a>
                <button class="button [tiny small large]">Find</button>
            </form>


        </div>
       <?/* <h5>Categories</h5>
        <ul class="side-nav">
            <li><a href="#">News</a></li>
            <li><a href="#">Code</a></li>
            <li><a href="#">Design</a></li>
            <li><a href="#">Fun</a></li>
            <li><a href="#">Weasels</a></li>
        </ul> */?>


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
<!--                    <li><a href="#">Link 2</a></li>-->
<!--                    <li><a href="#">Link 3</a></li>-->
<!--                    <li><a href="#">Link 4</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.ba-tinypubsub.min.js"></script>
<script type="text/javascript" src="/js/jquery.ba-outside-events.js"></script>
<script type="text/javascript" src="/js/handlebars.js"></script>
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