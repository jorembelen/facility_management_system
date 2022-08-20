<?php

namespace App\Traits;
use App\Models\Building;
use App\Models\BuildingRestoration;

trait BuildingTrait {

    public function buildingInfo()
    {
        $building = Building::find($this->id);
        if(isset($building)){
                // return $building->id;
            return    $building->id .' - ' .$building->rc_no .' ' . $building->ifc_no .' ' . $building->flat_no .' ' .$building->villa_no .' ' . $building->lot_no .' ' . $building->block_no .' ' . $building->street .' (' . $building->type->name .')';
        }
        return null;
    }

    public function buildingAddress()
    {
        $building = Building::find($this->id);
        if(isset($building)){
            return    $building->type->name .' - ' .$building->rc_no .' ' . $building->street;
        }
        return null;
    }

    public function buildingDetails()
    {
        $building = Building::find($this->id);
        if(isset($building)){
            return    'Building No. ' .$building->rc_no .' ' .$building->street .' Unit ' .$building->flat_no;
        }
        return null;
    }

    public function availabiltyDate()
    {
        $building = BuildingRestoration::wherebuilding_id($this->id)->first();
        if($building){
            return date('M-d-Y', strtotime($building->availability_date));
        }
    }

    public function restorationNotes()
    {
        $building = BuildingRestoration::wherebuilding_id($this->id)->first();
        if($building){
            return $building->notes;
        }
        return null;
    }

    public function restorationUpdatedCount()
    {
        $building = BuildingRestoration::wherebuilding_id($this->id)->first();
        if($building){
            return $building->update_count;
        }
        return 0;
    }

}
