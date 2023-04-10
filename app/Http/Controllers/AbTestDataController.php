<?php

namespace App\Http\Controllers;

use App\Models\AbTestData;
use http\Env\Request;

class AbTestDataController
{
    public function get_testdata() {
        $testdata_id = AbTestData::all();
        return view('AbTestView')->with([
            'Item' => $testdata_id
        ]);

    }
}
