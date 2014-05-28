<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($title) ? $title : ''; ?></title>
    <link rel="stylesheet" href="../css/normalize.css"/>
    <link rel="stylesheet" href="../css/foundation.min.css"/>
    <link rel="stylesheet" href="/install/css/app.css"/>
</head>
<body>


<div class="row">
    <div class="large-12 columns">
        <h1><?php echo isset($title) ? $title : ''; ?>
            <?/*<small>This is my blog. It's awesome.</small>*/?>
        </h1>
        <hr/>
    </div>
</div>


<div class="row">
    <div class="large-9 columns" role="content">
        <?php echo isset($body_content) ? $body_content : ''; ?>
    </div>
    <aside class="large-3 columns panel">
        <h5>Progress:</h5>
        <ul class="side-nav">
            <li class="<?php echo ($step>=0)?'active':''?>">Welcome</li>
            <li class="<?php echo ($step>=1)?'active':''?>">Step1</li>
            <li class="<?php echo ($step>=2)?'active':''?>">Step2</li>
            <li class="<?php echo ($step>=3)?'active':''?>">Finish</li>

        </ul>
    </aside>
</div>


<footer class="row">
    <div class="large-12 columns">
        <hr/>
        <div class="row">
            <div class="large-6 columns">
                <p>© 2014 TaskTracker </p>
            </div>
            <div class="large-6 columns">

            </div>
        </div>
    </div>
</footer>


</body>
</html>