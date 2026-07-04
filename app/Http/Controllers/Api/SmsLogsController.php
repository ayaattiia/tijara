<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SmsLogs;
use Illuminate\Http\Request;

class SmsLogsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(SmsLogs::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = SmsLogs::create($data);
        return response()->json($item, 201);
    }

    public function show($sms_logs)
    {
        $item = SmsLogs::findOrFail($sms_logs);
        return response()->json($item);
    }

    public function update(Request $request, $sms_logs)
    {
        $item = SmsLogs::findOrFail($sms_logs);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($sms_logs)
    {
        $item = SmsLogs::findOrFail($sms_logs);
        $item->delete();
        return response()->json(null, 204);
    }
}
