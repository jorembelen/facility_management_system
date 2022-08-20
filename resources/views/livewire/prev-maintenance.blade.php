<div>
<div class="form-group">
    <label class="form-label">Select Category</label>
    <select  wire:model="selectedCategories" name="work_category" class="form-control" required>
        <option value="">Select ...</option>
        <option value="9">Fire Fighting System</option>
        <option value="10">Elevator</option>
    </select>
</div>
@if (!is_null($selectedCategories))
<div class="form-group">
    <label class="form-label">Select Building</label>
    <select wire:model="selectedBuilding" name="building_id[]" class="form-control select2">
        @foreach ($facilities as $data)
        <option value="{{ $data->id }}">{{ $data->street }}</option>
        {{-- <option value="{{ $data->facility_type_id }} {{ $data->id }} {{ $data->street }}">{{ $data->street }}</option> --}}
        @endforeach
    </select>
    <input type="hidden" name="buildingId" value="{{ $selectedBuilding }}">
</div>
@endif
@if (!is_null($selectedBuilding))
@php
    $building = \App\Models\Building::find($selectedBuilding);
    $locations = \App\Models\MaintenanceLocation::wherefacility_type_id($building->facility_type_id)->get();
@endphp
<div class="form-group">
    <label class="form-label">Select Location</label>
    <select wire:model="selectedLocation"  name="job_location" class="form-control">
        <option value="">None</option>
        @foreach ($locations as $location)
        <option value="{{ $location->location }}">{{ $location->location }}</option>
        @endforeach
    </select>
</div>
@endif


</div>

