<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\OccupantStoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return view('users.index', compact('user'));
    }

    public function tenants()
    {
        $user = User::whererole('tenant')->latest()->get();

        return view('users.tenants', compact('user'));
    }

    public function importIndex()
    {
        return view('users.import');
    }

    public function import(Request $request)
    {
        $validator = Excel::import(new UsersImport,request()->file('file'));

        Alert::success('Success', 'Users Imported Successfully!');

        return redirect(route('tenants.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User;
        $data = $request->validated();

        // return $data;
        $user->create($data);
        Alert::toast('User was successfully created!', 'success');

        return back();
    }

    public function tenantStore(OccupantStoreRequest $request)
    {
        $user = new User;

        $data = $request->except('role');
        $data['role'] = 'tenant';
        $data['password'] = 'Sadara2021';

        $user->create($data);
        Alert::toast('Tenant was successfully created!', 'success');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();

        if(trim($request->password) == '') {

            $data = $request->except('password');
            $user->update($data);
        }else{
            $data = $request->all();
            $user->update($data);
        }

        Alert::toast('User was successfully updated!', 'success');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->occupancy()->count()) {

        Alert::error('Failed', 'Sorry, this user has an existing records!');

        return redirect()->back();
    }

        $user->delete();

        Alert::success('Success', 'User was successfully deleted!');

        return back();
    }
}
