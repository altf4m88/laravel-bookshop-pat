<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Distributor;
use App\Models\Setting;
use App\Models\Supply;
use App\Models\Transaction;
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

    public function invoice()
    {
        $userRole = Auth::user()->akses;
        $invoices = Transaction::all();

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('invoices', $invoices)
        ->with('page', 'REPORT');
    }

    public function selectInvoice(Request $request)
    {
        $userRole = Auth::user()->akses;
        $invoice = Transaction::find($request->invoice_id);
        $book = Book::where('id_buku', $invoice->id_buku)->first();

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('action', 'SELECT')
        ->with('receipt', $invoice)
        ->with('book', $book)
        ->with('page', 'REPORT');
    }

    public function printTransaction(Request $request, $receipt){
        $receipt = Transaction::where('id_penjualan', $receipt)->first();
        $receipt->cashier = $receipt->user->nama;
        $book = Book::where('id_buku', $receipt->id_buku)->first();
        $profile = Setting::first();

        return view('kasir.printed_invoice') 
        ->with('receipt', $receipt)
        ->with('profile', $profile)
        ->with('book', $book);
    }

    public function transactions(Request $request)
    {
        $userRole = Auth::user()->akses;
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            $transaction['book'] = $transaction->Book;
        }

        return view('manager.report', compact('transactions'))
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function bookSupplyByDistributor(Request $request)
    {
        $distributors = Distributor::all();
        $userRole = Auth::user()->akses;


        return view('manager.report')
        ->with('distributors', $distributors)
        ->with('userRole', $userRole)
        ->with('action', 'SELECT_DISTRIBUTOR')
        ->with('page', 'REPORT');
    }

    public function filterByDistributor (Request $req)
    {
        $supplies =  Supply::all()->where('id_distributor', $req->distributor);
        $distributor = Distributor::find($req->distributor);
        $time = Carbon::now()->format('d-m-Y');
        $dataSupply = [];

        foreach($supplies as $supply){
            $supply['distributor'] = $supply->distributor;
            $supply['book'] = $supply->book;
            array_push($dataSupply , $supply);
        }

        $bookCount = 0;
        foreach($dataSupply as $book){
            $bookCount += $book['book']['stok'];
        }
        $userRole = Auth::user()->akses;

        return view('manager.report')
        ->with('supplies', $dataSupply)
        ->with('userRole', $userRole)
        ->with('distributor', $distributor)
        ->with('time', $time)
        ->with('bookCount', $bookCount)
        ->with('action', 'VIEW_DISTRIBUTOR')
        ->with('page', 'REPORT');
    }

    public function bookSupply(Request $request)
    {
        $supplies = Supply::orderBy('tanggal', 'desc')->get();
        $userRole = Auth::user()->akses;
        $dates = Supply::orderBy('tanggal', 'desc')->get()->pluck('tanggal');


        $dataSupply = [];
        foreach($supplies as $key => $supply){
            $supply['distributor'] = $supply->distributor;
            $supply['book'] = $supply->book;
            $dataSupply[$key] = $supply;
        }


        return view('manager.report')
        ->with('supplies', $dataSupply)
        ->with('userRole', $userRole)
        ->with('dates', $dates)
        ->with('page', 'REPORT');
    }

    public function supplyByDate (Request $req)
    {
        $supplies = Supply::where('tanggal', $req->date)->get();
        $dates = Supply::orderBy('tanggal', 'desc')->get()->pluck('tanggal');
        $userRole = Auth::user()->akses;
        $dataSupply = [];

        foreach($supplies as $key => $supply)
        {
            $supply['distributor'] = $supply->distributor;
            $supply['book'] = $supply->book;
            $dataSupply[$key] = $supply;
        }

        return view('manager.report')
        ->with('supplies', $dataSupply)
        ->with('dates', $dates)
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function booksData(Request $request)
    {
        $userRole = Auth::user()->akses;
        $books = Book::all();

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('page', 'REPORT');
    }
    

    public function booksWriter(Request $request)
    {
        $userRole = Auth::user()->akses;
        $writers =  Book::get()->pluck('penulis');

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('writers', $writers)
        ->with('action', 'SELECT_WRITER')
        ->with('page', 'REPORT');
    }

    public function booksByWriter(Request $request)
    {
        $userRole = Auth::user()->akses;
        $books = Book::where('penulis', $request->writer)->get();
        $writers =  Book::get()->pluck('penulis');


        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('currentWriter', $request->writer)
        ->with('writers', $writers)
        ->with('action', 'VIEW_WRITER')
        ->with('page', 'REPORT');
    }

    public function popularBooks(Request $request)
    {
        $userRole = Auth::user()->akses;
        $books = Book::with('transactions')->get();

        $booksWithTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) > 0){
                array_push($booksWithTransaction, $book);
            }
        }

        foreach($booksWithTransaction as $key => $book)
        {
            $totalSold = 0;
            foreach($book->transactions as $transaction){
                $totalSold += $transaction->jumlah_beli;
            }

            $booksWithTransaction[$key]['total_sold'] = $totalSold;
            $booksWithTransaction[$key]['total_transaction'] = count($book->transactions);
        }

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('books', $booksWithTransaction)
        ->with('page', 'REPORT');
    }

    public function unpopularBooks(Request $request)
    {
        $userRole = Auth::user()->akses;
        $books = Book::with('transactions')->get();

        $booksWithNoTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) === 0){
                array_push($booksWithNoTransaction, $book);
            }
        }

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('books', $booksWithNoTransaction)
        ->with('page', 'REPORT');
    }

    public function salesByDate(Request $request)
    {
        $userRole = Auth::user()->akses;

        return view('manager.report')
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');

    }

}
