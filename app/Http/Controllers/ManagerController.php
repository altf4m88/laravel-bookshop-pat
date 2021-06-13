<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ManagerController extends Controller
{
    public function report()
    {
        $userRole = Auth::user()->akses;
        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function setting()
    {
        $userRole = Auth::user()->akses;
        $profile = Setting::first();

        return view('manager.setting')
        ->with('userRole', $userRole)
        ->with('profile', $profile)
        ->with('page', 'SETTING');
    }

    public function user()
    {
        $userRole = Auth::user()->akses;
        return view('manager.user')
        ->with('userRole', $userRole)
        ->with('page', 'USER');
    }

    public function createUser(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'access' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.min' => 'Nama lengkap minimal 3 karakter',
            'address.required' => 'Alamat wajib diisi',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'access' => 'Akses wajib diisi',
        ];

        if($request->password != $request->confirmation){
            return redirect()->back()->with('failed', 'Konfirmasi password tidak sesuai');
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->nama = ucwords(strtolower($request->name));
        $user->alamat = $request->address;
        $user->telepon = $request->phone;
        $user->status = $request->status;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->akses =  $request->access;

        $execute = $user->save();

        if($execute){
            Session::flash('success', 'Data berhasil disimpan');
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            Session::flash('failed', 'Data gagal disimpan');
            return redirect()->back()->with('failed', 'Data gagal disimpan');
        }
    }

    public function updateProfile(Request $request)
    {
        $setting = Setting::find($request['id-setting']);

        $fileName = '';
        if($request->file('file'))
        {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/images', $file->getClientOriginalName());
        } else {
            $fileName = $setting->logo;
        }

        $setting->nama_perusahaan = $request->name;
        $setting->alamat = $request->address;
        $setting->no_tlpn = $request->phone;
        $setting->web = $request->web;
        $setting->logo = $fileName;
        $setting->no_hp = $request->handphone;
        $setting->email = $request->email;
        $setting->updated_at = Carbon::now();

        $execute = $setting->save();

        if($execute){
            Session::flash('success', 'Data berhasil disimpan');
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            Session::flash('failed', 'Data gagal disimpan');
            return redirect()->back()->with('failed', 'Data gagal disimpan');
        }
    }
}
