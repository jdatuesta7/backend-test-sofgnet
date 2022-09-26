<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        try {
            $vehicles = Vehicle::where('active', VEHICLE::PUBLISH)->get();
            return Response($vehicles, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
                'year' => 'required|integer',
                'make' => 'required|string',
                'capacity' => 'required|integer' 
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $vehicle = new Vehicle();
            $vehicle->description = $request->description;
            $vehicle->year = $request->year;
            $vehicle->make = $request->make;
            $vehicle->capacity = $request->capacity;
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
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
                'year' => 'required|integer',
                'make' => 'required|string',
                'capacity' => 'required|integer' 
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $vehicle = Vehicle::findOrFail($id);
            $vehicle->description = $request->description;
            $vehicle->year = $request->year;
            $vehicle->make = $request->make;
            $vehicle->capacity = $request->capacity;
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
