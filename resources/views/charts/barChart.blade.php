<div id="bar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <script type="text/javascript">
        var colors = ['','#F25D5C','#90ed7d','', '#8085e9', '#7cb5ec','', '#f7a35c'];
        Highcharts.chart('bar', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{$selectedProject->name}}'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [@foreach ($yourFirstChart as $element)
                    '{{$element->task_status}}'
                ,@endforeach],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
           series: [{
            showInLegend: false,  
            name: 'Total',             
            data: [@foreach ($yourFirstChart as $element)
                {name : '{{$element->task_status}}', 
                y:{{$element->total_status}},
                color : colors['{{$element->task_status_id}}'],
            },
        @endforeach]
    }]
        });
    </script>
    