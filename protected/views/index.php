<script id="tasklist_tpl" type="text/x-handlebars-template">
    <tr id="task_{{id}}" class="task {{classes}}" task="{{id}}" >
        <td>{{id}}</td>
        <td>{{name}}</td>
        <td>{{caption}}</td>
        <td>{{created}}</td>
        <td>{{timeLimit}}</td>
        <td>00:00:00</td>
        <td>
        <img src="/img/play.png"  class="start" />
        <img src="/img/pause.png" class="pause" />
        <img src="/img/finish_flag.png" class="finish" />
        <img src="/img/delete.png" class='delete' id="{{id}}"/>
        </td>
    </tr>
</script>

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
