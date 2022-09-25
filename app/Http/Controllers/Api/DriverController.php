<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'ssd' => 'required|string|unique:drivers',
                'dob' => 'required|date',
                'address' => 'string|nullable',
                'city' => 'string|nullable',
                'zip' => 'string|nullable',
                'phone' => 'integer|nullable'
            ]);

            $driver = new Driver();
            $driver->last_name = $validated['last_name'];
            $driver->first_name = $validated['first_name'];
            $driver->ssd = $validated['ssd'];
            $driver->dob = $validated['dob'];
            $driver->address = $validated['address'];
            $driver->city = $validated['city'];
            $driver->zip = $validated['zip'];
            $driver->phone = $validated['phone'];
            $driver->save();

            return Response($driver, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $drivers = Driver::all();
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
            $validated = $request->validate([
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'ssd' => 'required|string|unique:drivers',
                'dob' => 'required|date',
                'address' => 'string|nullable',
                'city' => 'string|nullable',
                'zip' => 'string|nullable',
                'phone' => 'integer|nullable',
                'active' => 'boolean|nullable'
            ]);

            $driver = Driver::findOrFail($id);
            $driver->last_name = $validated['last_name'];
            $driver->first_name = $validated['first_name'];
            $driver->ssd = $validated['ssd'];
            $driver->dob = $validated['dob'];
            $driver->address = $validated['address'];
            $driver->city = $validated['city'];
            $driver->zip = $validated['zip'];
            $driver->phone = $validated['phone'];
            $driver->active = $validated['active'];
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
