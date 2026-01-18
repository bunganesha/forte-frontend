<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class LogTableController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $reports = Report::with('classifications')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        if (auth()->user()->hasRole('admin')) {
            return view('admin.reports', compact('reports'));
        } else {
            return view('operator.reports', compact('reports'));
        }
    }
}
