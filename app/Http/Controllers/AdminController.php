<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    //
    public function index()
    {
        $defTotalUser = User::all()->count();
        $defAkunTerbaru = User::orderByDesc('id_user')->take(5)->get();
        $defTotalUserBaru = User::whereDate('created_at', Carbon::today())->count();
        $defAktivitasTerbaru = Activity::orderByDesc('id')->take(5)->get();
        $defTotalAktivitas = count(Activity::all());

        return view('admin.dashboard', compact(
            'defTotalUser',
            'defAkunTerbaru',
            'defTotalUserBaru',
            'defAktivitasTerbaru',
            'defTotalAktivitas',
        ));
    }
}
