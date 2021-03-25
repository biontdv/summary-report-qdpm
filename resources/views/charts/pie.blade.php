<div id="pie" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


<script type="text/javascript">
var colors = ['','#F25D5C','#90ed7d','', '#8085e9', '#7cb5ec','', '#f7a35c'];
Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '{{$selectedProject->name}} Pie Diagram'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true,
        }
    },
    series: [{
        name: 'Total',
        // colorByPoint: true,
        data: [@foreach ($yourFirstChart as $element)
        {name : '{{$element->task_status}}', 
        y:{{$element->total_status}},
        color : colors['{{$element->task_status_id}}'],
        },
        @endforeach]
    }]
});
        </script>
