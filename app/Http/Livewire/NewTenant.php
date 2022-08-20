<?php

namespace App\Http\Livewire;
use LdapRecord\Container;

use Livewire\Component;

class NewTenant extends Component
{
    public $search;



    public function render()
    {
        $searchResults = [];
        $message = null;

        if(strlen($this->search) > 2) {
            $search = $this->search;
            $searchResults = \LdapRecord\Models\ActiveDirectory\User::where('samaccountname', '=', $search)->get();

            $results = $searchResults->count();
                if($results == 0) {
                $searchResults = \LdapRecord\Models\ActiveDirectory\User::where('employeeid', '=', $search)->get();
            }

            $results = $searchResults->count();
                if($results == 0) {
                $message = 'Sorry, No Data Found ...';
            }
        }

        return view('livewire.new-tenant', compact('searchResults', 'message'))->extends('layouts.master');
    }
}
