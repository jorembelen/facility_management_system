

@if (auth()->user()->role == 'assigner')

<div class="row">
    <div class="col-6 col-xl-6 d-none d-xl-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Facilities Status</h5>
            </div>
            <div class="card-body d-flex">

                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Building Type</th>
                            <th class="text-right">Vacant</th>
                            <th class="text-right">Occupied</th>
                            <th class="text-right">Under Restoration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <a href="{{ route('index-type', 2) }}">2 BR</a></td>
                            @if ($vacantTwoBedroom[0] == 0)
                            <td class="text-right">{{ $vacantTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 2) }}">{{ $vacantTwoBedroom[0] }}</a></td>
                            @endif
                            @if ($occupiedTwoBedroom[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 2) }}">{{ $occupiedTwoBedroom[0] }}</a></td>
                            @endif
                            @if ($restorationTwoBedroom[0] == 0)
                            <td class="text-right text-danger">{{ $restorationTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 2) }}">{{ $restorationTwoBedroom[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 3) }}">3 BR</a></td>
                            @if ($vacantThreeBedroom[0] == 0)
                            <td class="text-right">{{ $vacantThreeBedroom[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 3) }}">{{ $vacantThreeBedroom[0] }}</a></td>
                            @endif
                            @if ($occupiedThreeBedroom[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedThreeBedroom[0] }}"</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 3) }}">{{ $occupiedThreeBedroom[0] }}</a></td>
                            @endif
                            @if ($restorationThreeBedroom[0] == 0)
                            <td class="text-right text-danger">{{ $restorationThreeBedroom[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 3) }}">{{ $restorationThreeBedroom[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 4) }}">4 BR Attached</a></td>
                            @if ($vacantFourBedroomAttached[0] == 0)
                            <td class="text-right">{{ $vacantFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 4) }}">{{ $vacantFourBedroomAttached[0] }}</a></td>
                            @endif
                            @if ($occupiedFourBedroomAttached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 4) }}">{{ $occupiedFourBedroomAttached[0] }}</a></td>
                            @endif
                            @if ($restorationFourBedroomAttached[0] == 0)
                            <td class="text-right text-danger">{{ $restorationFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 4) }}">{{ $restorationFourBedroomAttached[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 44) }}">4 BR Detached</a></td>
                            @if ($vacantFourBedroomDetached[0] == 0)
                            <td class="text-right">{{ $vacantFourBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 44) }}">{{ $vacantFourBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($occupiedFourBedroomDetached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFourBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 44) }}">{{ $occupiedFourBedroomDetached[0] }}</a></td>
                            @endif
                           @if ($restorationFourBedroomDetached[0] == 0)
                           <td class="text-right text-danger">{{ $restorationFourBedroomDetached[0] }}</td>
                           @else
                           <td class="text-right text-danger"><a href="{{ route('restoration-type', 44) }}">{{ $restorationFourBedroomDetached[0] }}</a></td>
                           @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 5) }}">5 BR</a></td>
                            @if ($vacantFiveBedroomDetached[0] == 0)
                            <td class="text-right">{{ $vacantFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 5) }}">{{ $vacantFiveBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($occupiedFiveBedroomDetached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 5) }}">{{ $occupiedFiveBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($restorationFiveBedroomDetached[0] == 0)
                            <td class="text-right text-danger">{{ $restorationFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 5) }}">{{ $restorationFiveBedroomDetached[0] }}</a></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-6">
        <div class="card flex-fill w-100">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Total Facilites: {{ $totalFacilities[0] }}</h5>
                </div>
                <div class="card-body">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td><i class="fas fa-square-full text-primary"></i> <a href="{{ route('facilities.vacant') }}">Vacant</a></td>
                            <td class="text-right">{{ $vacant[0] }}</td>
                            <td class="text-right text-success">{{ number_format($vacant[0] / $totalFacilities[0] * 100, 2) }}%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-square-full text-warning"></i> <a href="{{ route('facilities.occupied') }}">Occupied</a></td>
                            <td class="text-right">{{ $occupied[0] }}</td>
                            <td class="text-right text-success">{{ number_format($occupied[0] / $totalFacilities[0] * 100, 2) }}%</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-square-full text-danger"></i> <a href="{{ route('restoration') }}">Restoration</a></td>
                            <td class="text-right">{{ $restoration[0] }}</td>
                            <td class="text-right text-success">{{ number_format($restoration[0] / $totalFacilities[0] * 100, 2) }}%</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif
