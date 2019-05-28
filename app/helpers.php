<?php
// A simple description of my function could come here
    function hasPermission($parameter)
    {

//        dd(\Illuminate\Support\Facades\Auth::user());
        if(!\Illuminate\Support\Facades\Auth::user()->can($parameter)){
            abort(503);
        }
    }