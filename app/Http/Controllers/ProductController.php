<?php

namespace App\Http\Controllers;

use App\Facades\CSVImportFacade;
use App\Jobs\ProductJob;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv' => 'required|mimes:csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first());
        }

        if ($request->has('csv')) {

            CSVImportFacade::import($request->csv);

            return redirect()->route('dashboard')
                ->with('success', 'CSV Import added on queue. will update you once done.');

        }
    }
}
