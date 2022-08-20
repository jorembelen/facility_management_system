<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $badge, $mobile, $designation, $empId, $query;
    public $table = true;

    public function render()
    {
        $employees = Employee::query()
            ->latest()
            ->get();

        return view('livewire.admin.employees', compact('employees'))->extends('layouts.master');
    }

    public function create()
    {
        $this->dispatchBrowserEvent('show-createEmp-form');
        $this->table = true;
    }

    public function close()
    {
        $this->table = false;
        $this->dispatchBrowserEvent('hide-form');
        $this->resetInput();
        $this->resetValidation();
    }

    public function resetInput()
    {
        $this->name = null;
        $this->mobile = null;
        $this->badge = null;
        $this->designation = null;
    }

    public function editShow(Employee $employee)
    {
        $this->dispatchBrowserEvent('show-EditStaff-form');
        $this->name = $employee->name;
        $this->mobile = $employee->mobile;
        $this->badge = $employee->badge;
        $this->designation = $employee->designation;
        $this->empId = $employee->id;
        $this->table = true;
    }

    public function update(Employee $employee)
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'designation' => 'required|max:50',
            'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:employees,badge,' .$this->empId,
        ]);

        DB::beginTransaction();
        if($employee) {
            $employee->update($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => $this->name .' was successfully updated.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->close();
        }else{
            DB::rollBack();
        }
    }

    public function deleteConfirm(Employee $employee)
    {
        $this->dispatchBrowserEvent('show-deleteStaff-form');
        $this->empId = $employee->id;
        $this->name = $employee->name;
        $this->table = true;
    }

    public function delete(Employee $employee)
    {
            DB::beginTransaction();
            if($employee) {
                $employee->delete();
                DB::commit();
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => $employee->name .' was successfully deleted.',
                    'text' => '',
                ]);
                $this->dispatchBrowserEvent('hide-form');
                $this->close();
            }else{
                DB::rollBack();
            }
    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'designation' => 'required|max:50',
            'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:employees,badge',
        ]);

        $user = new Employee();

        DB::beginTransaction();
        if($data) {
            $user->create($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => $this->name .' was successfully created.',
                'text' => '',
            ]);
            $this->close();
        }else{
            DB::rollBack();
        }
    }
}
