<script type="text/javascript">
    chart = google.charts.setOnLoadCallback(drawChart)

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [
                'Element',
                @for ($i = 0; $i < count($model->datasets); $i++)
                    "{{ $model->datasets[$i]['label'] }}",
                @endfor
            ],
            @for($l = 0; $l < count($model->labels); $l++)
                [
                    "{{ $model->labels[$l] }}",
                    @for ($i = 0; $i < count($model->datasets); $i++)
                        {{ $model->datasets[$i]['values'][$l] }},
                    @endfor
                ],
            @endfor

        ])

        var options = {
            @include('charts::_partials.dimension.js')
            fontSize: 12,
            @include('charts::google.titles')
            @include('charts::google.colors')
            legend: {position: '', textStyle: {fontSize: 8}},
            vAxis: {
                viewWindowMode:'explicit',
                viewWindow: {
                    max:4,
                    min:-4
                }
            },


        };

        var chart = new google.visualization.LineChart(document.getElementById("{{ $model->id }}"))
		// Wait for the chart to finish drawing before calling the getImageURI() method.
		google.visualization.events.addListener(chart, 'ready', function () {
			document.getElementById("{{ $model->id }}").innerHTML = '<img src="' + chart.getImageURI() + '">';
		});
		
        chart.draw(data, options)
    }
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
