<?php

namespace App\Http\Livewire\Assigner;

use App\Models\ApplicationLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh' => '$refresh'];

    public $name, $badge, $username, $email, $mobile, $userId, $userName, $query, $tenants, $tenant;
    public $table = true;

    public function mount()
    {
        $this->tenants = User::whereHas('building', function($q){
                $q->whereupgraded(0);
        })
        ->whererole('tenant')
        ->whereupgraded(0)
        ->get();
    }

    public function render()
    {
        $staff = User::searchStaff($this->query)
        ->whererole('staff')
        ->orWhere('upgraded', 1)
        ->latest()
        ->get();

        return view('livewire.assigner.staff-list', compact('staff'))->extends('layouts.master');
    }

    public function create()
    {
        $this->dispatchBrowserEvent('show-createStaff-form');
        $this->table = true;
    }

    public function editShow(User $user)
    {
        $this->dispatchBrowserEvent('show-EditStaff-form');
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->badge = $user->badge;
        $this->userId = $user->id;
        $this->table = true;
    }

    public function update(User $user)
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:users,badge,' .$this->userId,
            'username' => 'required|max:50|unique:users,username,' .$this->userId,
            'email' => 'required||max:50|unique:users,email,' .$this->userId,
        ]);

        DB::beginTransaction();
        if($user) {
            $user->update($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => $user->name .' was successfully updated.',
                'text' => '',
            ]);
            $this->close();
        }else{
            DB::rollBack();
        }
    }

    public function deleteConfirm(User $user)
    {
        $this->dispatchBrowserEvent('show-deleteStaff-form');
        $this->userId = $user->badge;
        $this->userName = $user->name;
        $this->table = true;
    }

    public function delete(User $user)
    {
        if($user->occupancy){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => $user->name .' was already assigned.',
                'text' => '',
            ]);
            $this->close();
        }else{
            DB::beginTransaction();
            if($user) {
                $user->delete();
                DB::commit();
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => $user->name .' was successfully deleted.',
                    'text' => '',
                ]);
                $this->close();
            }else{
                DB::rollBack();
            }
        }
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->resetInput();
        $this->resetValidation();
        $this->table = false;
    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:users,badge',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|unique:users,email|max:50',
        ]);
        $data['role'] = 'staff';
        $data['password'] = 'password';

        $user = new User();

        DB::beginTransaction();
        if($data) {
            $user->create($data);
            ApplicationLog::create([
                'log_info' => $this->name .' was added as staff by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Staff was successfully created.',
                'text' => '',
            ]);
            $this->close();
        }else{
            DB::rollBack();
        }
    }

    public function resetInput()
    {
        $this->username = null;
        $this->name = null;
        $this->email = null;
        $this->mobile = null;
        $this->badge = null;
        $this->tenant = null;
    }

    public function upgrade()
    {
        $this->dispatchBrowserEvent('show-tenantUpgrade-form');
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->table = true;
    }


    public function submitUpgrade()
    {
        $this->validate([
            'tenant' => 'required',
        ]);
        $user = User::find($this->tenant);
        DB::beginTransaction();
        if($user) {
            $user->update(['upgraded' => 1]);
            ApplicationLog::create([
                'log_info' => $user->name .' was upgraded by ' .auth()->user()->name,
            ]);
            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => $user->name .' was successfully upgraded.',
                'text' => '',
            ]);

            $this->close();
            return redirect()->route('facilities.vacant');
        }else{
            DB::rollBack();
        }
    }

}
