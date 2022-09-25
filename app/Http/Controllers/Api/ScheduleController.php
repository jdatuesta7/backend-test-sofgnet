<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Exception;
use Illuminate\Http\Request;
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
            $validated = $request->validate([
                'route_id' => 'required|integer',
                'week_num' => 'required|integer',
                'from' => 'required|date',
                'to' => 'required|date',
            ]);

            $schedule = new Schedule();
            $schedule->route_id = $validated['route_id'];
            $schedule->week_num = $validated['week_num'];
            $schedule->from = $validated['from'];
            $schedule->to = $validated['to'];
            $schedule->save();

            return Response($schedule, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], 500);
        }
    }
}
