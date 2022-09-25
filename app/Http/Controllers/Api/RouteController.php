<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverVehicle;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends Controller
{
    public function index()
    {
        try {
            $routes = DriverVehicle::all();
            return Response($routes, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'string|required',
                'driver_id' => 'integer|required',
                'vehicle_id' => 'integer|required'
            ]);

            $route = DriverVehicle::create([
                'description' => $validated['description'],
                'driver_id' => $validated['driver_id'],
                'vehicle_id' => $validated['vehicle_id'],
            ]);

            return Response($route, Response::HTTP_CREATED);    
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $route = DriverVehicle::findOrFail($id);
            return Response($route, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'description' => 'string|required',
                'driver_id' => 'integer|required',
                'vehicle_id' => 'integer|required'
            ]);

            $route = DriverVehicle::findOrFail($id);
            $route->description = $validated['description'];
            $route->driver_id = $validated['driver_id'];
            $route->vehicle_id = $validated['vehicle_id'];
            $route->save();

            return Response($route, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $route = DriverVehicle::findOrFail($id);
            $route->active = DriverVehicle::REMOVE;
            $route->save();
            return Response(["message" => "Ruta eliminada correctamente"], Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }
}
