<?php

namespace App\Imports;

use App\Models\CategoryOption;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryOptionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryOption([
            'work_category_id'     => $row['work_category_id'],
            'name'     => $row['name'],
            'arabic'     => $row['arabic'],
        ]);
    }
}
