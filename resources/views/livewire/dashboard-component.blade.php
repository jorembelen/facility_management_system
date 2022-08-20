<div>

    @if (count($surveyScores) > 0)
    <div class="col-lg-12 col-xl-12">
        <div class="card flex-fill w-100">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('survey.scores') }}"><h5 class="card-title mb-0">Survey Scores Monitoring Chart</h5></a>
                    <div class="chart chart-sm">
                        <div id="scores"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif


</div>

@push('score-js')

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
                name: 'Poor(1)',
                data:[
                ' {{ $scoreOne[0] }} ', ' {{ $scoreOne[1] }} ', ' {{ $scoreOne[2] }} ', ' {{ $scoreOne[3] }} ', ' {{ $scoreOne[4] }} ', ' {{ $scoreOne[5] }} ',
                ' {{ $scoreOne[6] }} ',' {{ $scoreOne[7] }} ', ' {{ $scoreOne[8] }} ', ' {{ $scoreOne[9] }} ', ' {{ $scoreOne[10] }} ', ' {{ $scoreOne[11] }} '
                ]
            }, {
                name: 'Needs Improvement(2)',
                data:[
                ' {{ $scoreTwo[0] }} ', ' {{ $scoreTwo[1] }} ', ' {{ $scoreTwo[2] }} ', ' {{ $scoreTwo[3] }} ', ' {{ $scoreTwo[4] }} ', ' {{ $scoreTwo[5] }} ',
                ' {{ $scoreTwo[6] }} ',' {{ $scoreTwo[7] }} ', ' {{ $scoreTwo[8] }} ', ' {{ $scoreTwo[9] }} ', ' {{ $scoreTwo[10] }} ', ' {{ $scoreTwo[11] }} '
                ]
            }, {
                name: 'Satisfactory(3)',
                data:[
                ' {{ $scoreThree[0] }} ', ' {{ $scoreThree[1] }} ', ' {{ $scoreThree[2] }} ', ' {{ $scoreThree[3] }} ', ' {{ $scoreThree[4] }} ', ' {{ $scoreThree[5] }} ',
                ' {{ $scoreThree[6] }} ',' {{ $scoreThree[7] }} ', ' {{ $scoreThree[8] }} ', ' {{ $scoreThree[9] }} ', ' {{ $scoreThree[10] }} ', ' {{ $scoreThree[11] }} '
                ]
            }, {
                name: 'Very Good(4)',
                data:[
                ' {{ $scoreFour[0] }} ', ' {{ $scoreFour[1] }} ', ' {{ $scoreFour[2] }} ', ' {{ $scoreFour[3] }} ', ' {{ $scoreFour[4] }} ', ' {{ $scoreFour[5] }} ',
                ' {{ $scoreFour[6] }} ',' {{ $scoreFour[7] }} ', ' {{ $scoreFour[8] }} ', ' {{ $scoreFour[9] }} ', ' {{ $scoreFour[10] }} ', ' {{ $scoreFour[11] }} '
                ]
            }, {
                name: 'Excellent(5)',
                data:[
                ' {{ $scoreFive[0] }} ', ' {{ $scoreFive[1] }} ', ' {{ $scoreFive[2] }} ', ' {{ $scoreFive[3] }} ', ' {{ $scoreFive[4] }} ', ' {{ $scoreFive[5] }} ',
                ' {{ $scoreFive[6] }} ',' {{ $scoreFive[7] }} ', ' {{ $scoreFive[8] }} ', ' {{ $scoreFive[9] }} ', ' {{ $scoreFive[10] }} ', ' {{ $scoreFive[11] }} '
                ]
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            yaxis: {
                title: {
                    text: "Survey Scores"
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
        document.querySelector("#scores"),
        options
        );
        chart.render();
    });
</script>
@endpush
