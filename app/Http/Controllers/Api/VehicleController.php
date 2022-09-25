<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    public function index()
    {
        try {
            $vehicles = Vehicle::all();
            return Response($vehicles, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
                'year' => 'required|integer',
                'make' => 'required|string',
                'capacity' => 'required|integer' 
            ]);

            $vehicle = new Vehicle();
            $vehicle->description = $validated['description'];
            $vehicle->year = $validated['year'];
            $vehicle->make = $validated['make'];
            $vehicle->capacity = $validated['capacity'];
            $vehicle->save();

            return Response($vehicle, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            return Response($vehicle, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
                'year' => 'required|integer',
                'make' => 'required|string',
                'capacity' => 'required|integer',
            ]);

            $vehicle = Vehicle::findOrFail($id);
            $vehicle->description = $validated['description'];
            $vehicle->year = $validated['year'];
            $vehicle->make = $validated['make'];
            $vehicle->capacity = $validated['capacity'];
            $vehicle->save();

            return Response($vehicle, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->active = Vehicle::REMOVE;
            $vehicle->save();
            return Response(["message" => "Vehiculo eliminado correctamente"], Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }
}
