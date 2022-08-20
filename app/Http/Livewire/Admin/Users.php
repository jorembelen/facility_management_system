<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $badge, $username, $email, $mobile, $userId, $userName, $role, $password, $password_confirmation, $query;
    public $updatePassword = false;
    public $table = true;
    protected $queryString = ['query'];

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        if(auth()->user()->role === 'super_admin'){
            $users = User::search($this->query)
            ->latest()
            ->paginate(10);
        }else{
            $users = User::search($this->query)
            ->whereNotIn('role', ['super_admin'])
            ->latest()
            ->paginate(10);
        }


        return view('livewire.admin.users', compact('users'))->extends('layouts.master');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 1]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'User status was successfully activated.',
            'text' => '',
        ]);
        return;
    }

    public function deactivate(User $user)
    {
        $user->update(['status' => 0]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'User status was successfully deactivated.',
            'text' => '',
        ]);
        return;
    }

    public function create()
    {
        $this->table = true;
        $this->dispatchBrowserEvent('show-createStaff-form');
    }

    public function close()
    {
        $this->table = false;
        $this->dispatchBrowserEvent('hide-form');
        $this->updatePassword = false;
        $this->resetInput();
        $this->resetValidation();
    }

    public function updatePass()
    {
        $this->updatePassword = !$this->updatePassword;
    }

    public function resetInput()
    {
        $this->username = null;
        $this->name = null;
        $this->email = null;
        $this->mobile = null;
        $this->badge = null;
        $this->role = null;
        $this->password = null;
        $this->password_confirmation = null;
    }

    public function editShow(User $user)
    {
        $this->dispatchBrowserEvent('show-EditStaff-form');
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->badge = $user->badge;
        $this->role = $user->role;
        $this->userId = $user->id;
        $this->table = true;
    }

    public function update(User $user)
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'role' => 'required',
            'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'required|max:50|unique:users,badge,' .$this->userId,
            'username' => 'required|max:50|unique:users,username,' .$this->userId,
            'email' => 'required||max:50|unique:users,email,' .$this->userId,
            'password' => 'nullable|confirmed|min:6',
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
            $this->updatePassword = false;
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
                $this->table = false;
                $this->dispatchBrowserEvent('refreshComponent', ['componentTable' => '#responsive']);
            }else{
                DB::rollBack();
            }
        }
    }

    public function submit()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'role' => 'required',
            'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'badge' => 'nullable|max:50|unique:users,badge',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|unique:users,email|max:50',
        ]);
        $data['password'] = 'password';

        $user = new User();

        DB::beginTransaction();
        if($data) {
            $user->create($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Staff was successfully created.',
                'text' => '',
            ]);
            $this->close();
             $this->table = false;
        $this->dispatchBrowserEvent('refreshComponent', ['componentTable' => '#responsive']);
        }else{
            DB::rollBack();
        }
    }

}
