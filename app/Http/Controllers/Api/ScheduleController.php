<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverVehicle;
use App\Models\Schedule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'route_id' => 'required|integer',
                'week_num' => 'required|integer',
                'from' => 'required|date',
                'to' => 'required|date',
            ]);

            if ($validator->fails()) {
                return Response(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $schedule = new Schedule();
            $schedule->route_id = $request->route_id;
            $schedule->week_num = $request->week_num;
            $schedule->from = $request->from;
            $schedule->to = $request->to;
            $schedule->save();

            return Response($schedule, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }

    public function showRouteSchedules($route)
    {
        try {
            $schedules = Schedule::where('route_id', $route)->get();
            return Response($schedules, Response::HTTP_OK);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }
}
