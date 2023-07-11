{{-- Bootstrap core JS --}}
{{-- <script src="{{ url('assets/plugin/bootstrap-5.1.1-dist/js/bootstrap.min.js') }}"></script> --}}

{{-- Core JS Files --}}
<script src="{{ url('assets/plugin/material_pro/jquery/dist/jquery.min.js') }}"></script>
{{-- Bootstrap tether Core JavaScript --}}
<script src="{{ url('assets/plugin/material_pro/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/js/material_pro/app-style-switcher.js') }}"></script>
{{-- Wave Effects --}}
<script src="{{ url('assets/js/material_pro/waves.js') }}"></script>
{{-- Menu sidebar --}}
<script src="{{ url('assets/js/material_pro/sidebarmenu.js') }}"></script>
{{-- chartist chart --}}
<script src="{{ url('assets/plugin/material_pro/chartist-js/dist/chartist.min.js') }}"></script>
<script src="{{ url('assets/plugin/material_pro/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
{{-- c3 JavaScript --}}
<script src="{{ url('assets/plugin/material_pro/d3/d3.min.js') }}"></script>
<script src="{{ url('assets/plugin/material_pro/c3-master/c3.min.js') }}"></script>
{{-- Custom JavaScript --}}
<script src="{{ url('assets/js/material_pro/pages/dashboards/dashboard1.js') }}"></script>
<script src="{{ url('assets/js/material_pro/custom.js') }}"></script>

{{-- Github buttons --}}
<script async defer src="https://buttons.github.io/buttons.js"></script>

{{-- Custom JS --}}
<script src="{{ url('assets/js/main.js') }}"></script>

{{-- Highchart --}}
<script src="{{ url('assets/code/highcharts.js') }}"></script>
<script src="{{ url('assets/code/highcharts-more.js') }}"></script>
<script src="{{ url('assets/code/modules/data.js') }}"></script>
<script src="{{ url('assets/code/modules/solid-gauge.js') }}"></script>
{{-- <script src="{{ url('assets/code/modules/exporting.js') }}"></script> --}}
<script src="{{ url('assets/code/modules/export-data.js') }}"></script>
<script src="{{ url('assets/code/modules/accessibility.js') }}"></script>


{{-- Toast --}}
<script>
    toast = document.getElementById('liveToast');

    function toast_show() {
        if (toast) {
            toast.classList.toggle('showing');
            setTimeout(() => {
                toast.classList.toggle('hide');
                toast.classList.toggle('show');
                toast.classList.remove('showing');
            }, 500);
        }
    }

    if (toast) {
        setTimeout(() => {
            function toast_hide() {
                toast.classList.toggle('showing');
                setTimeout(() => {
                    toast.classList.toggle('hide');
                    toast.classList.remove('show', 'showing');
                }, 500);
            }

            toast_hide();
        }, 5000);
    }

</script>
{{--  --}}

@if (isset($count_data_user))

{{-- Highchart --}}
<script>

    var highchart = document.getElementById('highchart');

    if (highchart) {
        function renderIcons() {

            // Move icon
            if (!this.series[0].icon) {
                this.series[0].icon = this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
                    .attr({
                        stroke: '#303030',
                        'stroke-linecap': 'round',
                        'stroke-linejoin': 'round',
                        'stroke-width': 2,
                        zIndex: 10
                    })
                    .add(this.series[2].group);
            }
            this.series[0].icon.translate(
                this.chartWidth / 2 - 10,
                this.plotHeight / 2 - this.series[0].points[0].shapeArgs.innerR -
                    (this.series[0].points[0].shapeArgs.r - this.series[0].points[0].shapeArgs.innerR) / 2
            );

            // Exercise icon
            if (!this.series[1].icon) {
                this.series[1].icon = this.renderer.path(
                    ['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8,
                        'M', 8, -8, 'L', 16, 0, 8, 8]
                )
                    .attr({
                        stroke: '#ffffff',
                        'stroke-linecap': 'round',
                        'stroke-linejoin': 'round',
                        'stroke-width': 2,
                        zIndex: 10
                    })
                    .add(this.series[2].group);
            }
            this.series[1].icon.translate(
                this.chartWidth / 2 - 10,
                this.plotHeight / 2 - this.series[1].points[0].shapeArgs.innerR -
                    (this.series[1].points[0].shapeArgs.r - this.series[1].points[0].shapeArgs.innerR) / 2
            );
        }

        Highcharts.chart('highchart', {

            chart: {
                type: 'solidgauge',
                height: '100%',
                // events: {
                //     render: renderIcons
                // }
            },

            title: {
                text: '',
                style: {
                    fontSize: '24px'
                }
            },

            tooltip: {
                borderWidth: 0,
                backgroundColor: 'none',
                shadow: false,
                style: {
                    fontSize: '0'
                },
                valueSuffix: '%',
                pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}</span>',
                positioner: function (labelWidth) {
                    return {
                        x: (this.chart.chartWidth - labelWidth) / 2,
                        y: (this.chart.plotHeight / 5) + 15
                    };
                }
            },

            pane: {
                startAngle: 0,
                endAngle: 360,
                background: [{ // Track for Move
                    outerRadius: '112%',
                    innerRadius: '88%',
                    backgroundColor: Highcharts.color(Highcharts.getOptions().colors[0])
                        .setOpacity(0.3)
                        .get(),
                    borderWidth: 0
                }]
            },

            yAxis: {
                min: 0,
                max: {{ $count_data_user }},
                lineWidth: 0,
                tickPositions: []
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        enabled: false
                    },
                    linecap: 'round',
                    stickyTracking: false,
                    rounded: true
                }
            },

            series: [{
                name: 'Move',
                data: [{
                    color: Highcharts.getOptions().colors[0],
                    radius: '112%',
                    innerRadius: '88%',
                    y: {{ $count_data_user_min }}
                }]
            }]
        });
    }
</script>
{{--  --}}

@endif

{{-- Dasboard Admin --}}

<script type="text/javascript">
    Highcharts.chart('dashboard_admin-a', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
</script>

{{--  --}}

{{-- Change Button add new detail payroll --}}
<script>
    var button_payroll = document.getElementById('payroll_add');
    var submit_payroll = document.getElementById('payroll_submit');
    var form = document.getElementById('form');

    if (button_payroll) {
        function add_payroll_details() {
            button_payroll.setAttribute('name', 'add');
            button_payroll.setAttribute('value', '1');
        }
    }

    if (submit_payroll) {
        function submit_payroll_details() {
            form.setAttribute('action', {!! "'".url('payroll')."'" !!});
            submit_payroll.setAttribute('name', 'submit');
        }

        function update_payroll_details() {
            submit_payroll.setAttribute('name', 'submit');
        }
    }
</script>
{{--  --}}
