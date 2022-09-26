<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverVehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        try {
            $routes = DriverVehicle::where('active', DriverVehicle::PUBLISH)->get();
            return Response($routes, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'string|required',
                'driver_id' => 'integer|required',
                'vehicle_id' => 'integer|required'
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $route = DriverVehicle::create([
                'description' => $request->description,
                'driver_id' => $request->driver_id,
                'vehicle_id' => $request->vehicle_id,
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
            $validator = Validator::make($request->all(), [
                'description' => 'string|required',
                'driver_id' => 'integer|required',
                'vehicle_id' => 'integer|required'
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $route = DriverVehicle::findOrFail($id);
            $route->description = $request->description;
            $route->driver_id = $request->driver_id;
            $route->vehicle_id = $request->vehicle_id;
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
