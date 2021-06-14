<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function input()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('page', 'INPUT');
    }

    public function distributor()
    {
        $userRole = Auth::user()->akses;

        $distributors = Distributor::all();

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('distributors', $distributors)
        ->with('page', 'INPUT');
    }

    public function createDistributorForm()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('action', 'CREATE')
        ->with('page', 'INPUT');
    }

    public function updateDistributorForm($id)
    {
        $userRole = Auth::user()->akses;

        $distributor = Distributor::find($id);

        return view('admin.input')
        ->with('distributor', $distributor)
        ->with('userRole', $userRole)
        ->with('action', 'UPDATE')
        ->with('page', 'INPUT');
    }

    public function createDistributor(Request $request)
    {
        Distributor::create([
            'nama_distributor' => $request->nama,
            'alamat' => $request->alamat ?? '-',
            'telepon' => $request->telepon,
        ]);

        return redirect('admin/input/distributor');
    }

    public function updateDistributor(Request $request)
    {
        $distributor = Distributor::find($request->id_distributor);

        $distributor->update([
            'nama_distributor' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect('admin/input/distributor');
    }

    public function deleteDistributor($id)
    {
        $distributor = Distributor::find($id);

        $distributor->delete();
        return redirect('admin/input/distributor');
    }

    public function book()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('page', 'INPUT');
    }

    public function supply()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('page', 'INPUT');
    }

    public function report()
    {
        $userRole = Auth::user()->akses;

        return view('admin.report')
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }
}
