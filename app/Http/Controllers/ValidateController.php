<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function expresion(Request $request)
    {
        $request->validate([
            // 'detalle' => 'required|regex:/^[0-9]+[-][0-9,A-Z,a-z,,á,é,í,ó,ú,ü]+[-][0-9]+[-][0-9]+[-][0-9,A-Z,a-z,,á,é,í,ó,ú,ü]*[-][0-9]{1,9}[.][0-9]{2}$/'
            'detalle' => 'required|regex:/^[0-9]+[-][0-9,A-Z,a-z, ,á,é,í,ó,ú,ü]+[-][0-9]+[-][0-9]+[-][0-9,A-Z,a-z,,á,é,í,ó,ú,ü]*[-][0-9]{1,9}[.][0-9]{2}$/'
        ]);
        echo   "todo ok";
    }
}
