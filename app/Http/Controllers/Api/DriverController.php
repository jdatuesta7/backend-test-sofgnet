<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'ssd' => 'required|unique:drivers',
                'dob' => 'required|date',
                'address' => 'string|nullable',
                'city' => 'string|nullable',
                'zip' => 'string|nullable',
                'phone' => 'integer|nullable'
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $driver = new Driver();
            $driver->last_name = $request->last_name;
            $driver->first_name = $request->first_name;
            $driver->ssd = $request->ssd;
            $driver->dob = $request->dob;
            $driver->address = $request->address;
            $driver->city = $request->city;
            $driver->zip = $request->zip;
            $driver->phone = $request->phone;
            $driver->save();

            return Response($driver, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $drivers = Driver::where('active', DRIVER::PUBLISH)->get();
            return Response($drivers, Response::HTTP_OK);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            return Response($driver, Response::HTTP_OK);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'ssd' => ['required', Rule::unique('drivers', 'ssd')->ignore($id)],
                'dob' => 'required|date',
                'address' => 'string|nullable',
                'city' => 'string|nullable',
                'zip' => 'string|nullable',
                'phone' => 'integer|nullable'
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $driver = Driver::findOrFail($id);
            $driver->last_name = $request->last_name;
            $driver->first_name = $request->first_name;
            $driver->ssd = $request->ssd;
            $driver->dob = $request->dob;
            $driver->address = $request->address;
            $driver->city = $request->city;
            $driver->zip = $request->zip;
            $driver->phone = $request->phone;
            $driver->save();
            
            return Response($driver, Response::HTTP_OK);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $driver->active = Driver::REMOVE;
            $driver->save();
            return Response(["message" => "Conductor eliminado correctamente"],Response::HTTP_OK);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }
}
