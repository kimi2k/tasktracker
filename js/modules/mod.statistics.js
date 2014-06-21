$(function () {

    categories = []
    data = [];
    $("#taskList tr").each(function(x){

        categories[x] = $(this).find('td').eq(0).html();
        data[x] = parseInt($(this).find('td').eq(1).attr('seconds')/60);
    });


    $(function () {
        $('#container').highcharts({

            chart: {
                type: 'column',

            },
            title: {
                text: 'Employment by projects'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Time (min)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0">Worked: <b>{point.y:.1f} min</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    showInLegend: false
                }
            },
            series: [{
                name: ' ',
                data: data

            }]
        });
    });

});