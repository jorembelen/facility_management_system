
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Column chart
        var options = {
            chart: {
                height: 350,
                type: "bar",
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: "rounded",
                    columnWidth: "55%",
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: "Open",
                data: [
                        '{{  $openChart[0] }}', '{{ $openChart[1] }}', '{{  $openChart[2] }}','{{  $openChart[3] }}','{{  $openChart[4] }}','{{  $openChart[5] }}', 
                        '{{  $openChart[6] }}', '{{  $openChart[7] }}','{{  $openChart[8] }}','{{  $openChart[9] }}','{{  $openChart[10] }}','{{  $openChart[11] }}'
                    ]
            }, {
                name: "Closed",
                data: [
                        '{{  $closedChart[0] }}', '{{ $closedChart[1] }}', '{{  $closedChart[2] }}','{{  $closedChart[3] }}','{{  $closedChart[4] }}','{{  $closedChart[5] }}', 
                        '{{  $closedChart[6] }}', '{{  $closedChart[7] }}','{{  $closedChart[8] }}','{{  $closedChart[9] }}','{{  $closedChart[10] }}','{{  $closedChart[11] }}'
                    ]
            }, {
                name: "Cancelled",
                data: [
                        '{{  $cancelledChart[0] }}', '{{ $cancelledChart[1] }}', '{{  $cancelledChart[2] }}','{{  $cancelledChart[3] }}','{{  $cancelledChart[4] }}','{{  $cancelledChart[5] }}', 
                        '{{  $cancelledChart[6] }}', '{{  $cancelledChart[7] }}','{{  $cancelledChart[8] }}','{{  $cancelledChart[9] }}','{{  $cancelledChart[10] }}','{{  $cancelledChart[11] }}'
                    ]
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            yaxis: {
                title: {
                    text: "no. of appointments"
                }
            },
            fill: {
                opacity: 2
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "total: " + val 
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-column"),
            options
        );
        chart.render();
    });
</script>
