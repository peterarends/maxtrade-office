<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Resources\Property as PropertyResource;
use App\Http\Resources\PropertyCategory;

class PropertiesController extends Controller
{
    public function index($id = null)
    {
        /** Get Properties */
        if ($id != null) {
            $properties = Property::where(['user_id' => $id])->orderBy('category', 'asc')->get();

            /** Return collection of Properties as resource */
            return PropertyResource::collection($properties);
        }
    }

    public function store(Request $request)
    {
        $property = $request->isMethod('put') ? Property::findOrFail($request->property_id) : null;

        if (!empty($property)) {
            $property->value = $request->input('value');

            if ($property->save()) {
                return json_encode(["result" => "success"]);
            }
        }
    }

    public function categories()
    {
        /** Get Categories */
        $categories = Property::groupBy('category')->select('category')->get();

        /** Return collection of Categories as resource */
        return PropertyCategory::collection($categories);
    }
}