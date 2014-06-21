<div class="large-12 columns" role="content">
    <h3><a href='/statistics?month=<?php echo ($month-1>0)?$month-1:'12'?>&year=<?php echo ($month-1>0)?$year:$year-1?>'><</a> <?php echo date('F', mktime(0,0,0,$month,1,$year))?> <?php echo $year ?> <a href='/statistics?month=<?php echo ($month+1<=12)?$month+1:'01'?>&year=<?php echo ($month+1<=12)?$year:$year+1?>'>></a></h3>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto 20px"></div>
    <table class="large-6 large-offset-3">
        <thead>
            <tr>
                <th>Project</th>
                <th>Total time</th>
            </tr>
        <tbody id="taskList">
        <?php
        $total = 0;
        foreach ($list as $cat):
            $total += $cat['total'];?>
        <tr>
            <td><?php echo $cat['title']?></td>
            <td seconds="<?php echo $cat['total']?>">
                <?php $h = floor($cat['total']/3600); echo sprintf('%02d',$h)?>:<?php echo sprintf('%02d',floor(($cat['total'] -$h*3600)/60))?>:<?php echo sprintf('%02d',floor($cat['total'] % 60))?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
        <tr>
            <td><strong>Total:</strong></td>
            <td><?php $h = floor($total/3600); echo sprintf('%02d',$h)?>:<?php echo sprintf('%02d',floor(($total -$h*3600)/60))?>:<?php echo sprintf('%02d',floor($total % 60))?></td>
        </tr>
    </table>
</div>