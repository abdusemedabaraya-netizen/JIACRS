<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user:id,name')->latest()->paginate(20);

        return view('audit-logs.index', compact('logs'));
    }
}