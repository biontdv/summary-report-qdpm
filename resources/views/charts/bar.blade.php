<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '{{$selectedProject->name}} Bar Diagram'
    },
    subtitle: {
        text: 'Pt. Immobi Solusi prima'
    },
    xAxis: {
        categories: [@foreach ($chartDesignKedua as $element) '{{$element->name_user_summary}}' ,@endforeach],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Task'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
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
        name: 'Open',
        data: [@foreach ($chartDesignKedua as $elementchart){{$elementchart->opened}},@endforeach],
        color :'#F25D5C'

    }, {
        name: 'Re-Open',
        data: [@foreach ($chartDesignKedua as $elementchart){{$elementchart->reOpened}},@endforeach],
        color : '#8085e9'

    }, {
        name: 'Suspended',
        data: [@foreach ($chartDesignKedua as $elementchart){{$elementchart->suspended}},@endforeach],
        color : '#90ed7d'

    }, {
        name: 'Completed',
        data: [@foreach ($chartDesignKedua as $elementchart){{$elementchart->completed}},@endforeach],
        color :'#f7a35c'

    }, {
        name: 'Done',
        data: [@foreach ($chartDesignKedua as $elementchart){{$elementchart->done}},@endforeach],
        color :'#7cb5ec'

    }]
});
		</script>