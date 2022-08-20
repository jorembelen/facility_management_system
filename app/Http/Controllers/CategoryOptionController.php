<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryOption;
use App\Imports\CategoryOptionImport;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class CategoryOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = CategoryOption::latest()->get();

        return view('category-options.index', compact('options'));
    }

    public function importIndex()
    {
        return view('category-options.import');
    }

    public function import(Request $request)
    {
        $validator = Excel::import(new CategoryOptionImport,request()->file('file'));
        
        Alert::success('Success', 'Category Options Imported Successfully!');
           
        return redirect(route('category-options.index'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryOption  $categoryOption
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryOption $categoryOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryOption  $categoryOption
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryOption $categoryOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryOption  $categoryOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryOption $categoryOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryOption  $categoryOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryOption $categoryOption)
    {
        //
    }
}
