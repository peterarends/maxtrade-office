<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\Property as PropertyResorce;

class PropertiesController extends Controller
{
    public function index()
    {
        /** Get Properties */
        $properties = Property::orderBy('category', 'asc')->get();

        /** Return collection of Properties as resource */
        return PropertyResorce::collection($properties);
    }

    public function store(Request $request)
    {
        $property = $request->isMethod('put') ? Property::findOrFail($request->property_id) : null;

        if (!empty($property)){
            $property->value = $request->input('value');
    
            if ($property->save()){
                return new PropertyResorce($property);
            }    
        }
    }
}
