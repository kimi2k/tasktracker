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
