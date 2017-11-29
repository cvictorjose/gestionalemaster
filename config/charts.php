<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default settings for charts.
    |--------------------------------------------------------------------------
    */

    'default' => [
        'type' => 'line', // The default chart type.
        'library' => 'material', // The default chart library.
        'element_label' => 'Element', // The default chart element label.
        'empty_dataset_label' => 'No Data Set',
        'empty_dataset_value' => 0,
        'title' => 'ICAR ', // Default chart title.
        'height' => 400, // 0 Means it will take 100% of the division height.
        'width' => 0, // 0 Means it will take 100% of the division width.
        'responsive' => false, // Not recommended since all libraries have diferent sizes.
        'background_color' => 'inherit', // The chart division background color.
        'colors' => [], // Default chart colors if using no template is set.
        'one_color' => false, // Only use the first color in all values.
        'template' => 'material', // The default chart color template.
        'legend' => true, // Whether to enable the chart legend (where applicable).
        'x_axis_title' => false, // The title of the x-axis
        'y_axis_title' => null, // The title of the y-axis (When set to null will use element_label value).
        'loader' => [
            'active' => true, // Determines the if loader is active by default.
            'duration' => 300, // In milliseconds.
            'color' => '#000000', // Determines the default loader color.
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | All the color templates available for the charts.
    |--------------------------------------------------------------------------
    */
    'templates' => [
        'material' => [
            '#2196F3', '#F44336', '#FFC107',
        ],
        'red-material' => [
            '#B71C1C', '#F44336', '#E57373',
        ],
        'indigo-material' => [
            '#1A237E', '#3F51B5', '#7986CB',
        ],
        'blue-material' => [
            '#0D47A1', '#2196F3', '#64B5F6',
        ],
        'teal-material' => [
            '#004D40', '#009688', '#4DB6AC',
        ],
        'green-material' => [
            '#1B5E20', '#4CAF50', '#81C784',
        ],
        'yellow-material' => [
            '#F57F17', '#FFEB3B', '#FFF176',
        ],
        'orange-material' => [
            '#E65100', '#FF9800', '#FFB74D',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Assets required by the libraries.
    |--------------------------------------------------------------------------
    */

    'assets' => [
        'global' => [
            'scripts' => ['chart/jquery.min.js',],
        ],

        'canvas-gauges' => [
            'scripts' => [
                'https://cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.2/all/gauge.min.js',
            ],
        ],

        /*'chartist' => [
            'scripts' => ['chart/chartist/chartist.min.js',],
            'styles' =>  ['chart/chartist/chartist.min.css',
            ],
        ],

        'chartjs' => [
            'scripts' => [
                'chart/Chart.min.js',
            ],
        ],

        'fusioncharts' => [
            'scripts' => [
                'chart/fusioncharts/fusioncharts.js',
                'chart/fusioncharts/fusioncharts.theme.fint.js',
            ],
        ],*/

        'google' => [
            'scripts' => [
                'https://www.google.com/jsapi',
                'chart/google/loader.js',
                "google.charts.load('current', {'packages':['corechart', 'gauge', 'geochart', 'bar', 'line']})",
            ],
        ],

        /*'highcharts' => [
            'styles' => [
                // The following CSS is not added due to color compatibility errors.
                // 'https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/css/highcharts.css',
            ],
            'scripts' => [
                'chart/highcharts/highcharts.js',
                'chart/highcharts/offline-exporting.js',
                'chart/highcharts/map.js',
                'chart/highcharts/data.js',
                'chart/highcharts/world.js',
            ],
        ],*/

        'justgage' => [
            'scripts' => [
                'chart/justgage/raphael.min.js',
                'chart/justgage/justgage.min.js',
            ],
        ],

       /* 'morris' => [
            'styles' => [
                'chart/morris/morris.css',
            ],
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.6/raphael.min.js',
                'chart/morris/morris.min.js',
            ],
        ],*/

        'plottablejs' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/plottable.js/2.8.0/plottable.min.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/plottable.js/2.2.0/plottable.css',
            ],
        ],

        'progressbarjs' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js',
            ],
        ],

        'c3' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css',
            ],
        ],

        'echarts' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/echarts/3.6.2/echarts.min.js',
            ],
        ],
		'html2pdf' => [
            'scripts' => [
				'html2pdf/vendor/jspdf.min.js',
				'html2pdf/vendor/html2canvas.min.js',
                'html2pdf/src/html2pdf.js',
            ],
        ],
        /*'amcharts' => [
            'scripts' => [
                'https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/amcharts.js',
                'https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/serial.js',
                'https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/plugins/export/export.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/themes/light.js',
            ],
            'styles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.2/plugins/export/export.css',
            ],
        ],*/
    ],
];
