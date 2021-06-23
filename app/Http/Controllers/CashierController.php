<?php

namespace App\Http\Controllers;

use App\Exports\Sales;
use App\Exports\UnpopularBooks;
use App\Models\Book;
use App\Models\Setting;
use App\Models\TempTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Maatwebsite\Excel\Facades\Excel;

class CashierController extends Controller
{
    public function transaction(){
        $userRole = Auth::user()->akses;
        $books = Book::all();

        return view('kasir.transaction')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('page', 'TRANSACTION');
    }

    public function viewTransaction(Request $request, $bookId)
    {
        $book = Book::where('id_buku', $bookId)->first();
        $userRole = Auth::user()->akses;

        return view('kasir.create_transaction')
        ->with('userRole', $userRole)
        ->with('page', 'TRANSACTION')
        ->with('book', $book);
    }

    public function createTempTransaction(Request $request, $bookId)
    {
        $book = Book::where('id_buku', $bookId)->first();
        $userRole = Auth::user()->akses;

        if ($request->jumlah_beli > $book->stok) {
            return redirect()->route('view-transaction', $bookId)->with('toast_error', 'Jumlah buku yang dibeli melebihi stok buku!');
        }

        TempTransaction::create([
            'id_buku' => $request->id_buku,
            'jumlah_beli' => $request->jumlah_beli,
            'total_harga' => $request->total_harga,
        ]);

        $tmp_trans = TempTransaction::where('id_buku', $bookId)->first();

        return view('kasir.create_transaction')
        ->with('userRole', $userRole)
        ->with('page', 'TRANSACTION')
        ->with('tmp_trans', $tmp_trans)
        ->with('book', $book);
    }

    public function createTransaction(Request $request, $bookId)
    {
        $faker = Faker::create('id_ID');

        $user = Auth::id();
        $userRole = Auth::user()->akses;
        $book = Book::where('id_buku', $bookId)->first();
        $dateNow = Carbon::now('Asia/Jakarta');

        $invoice = Transaction::create([
            'id_penjualan' => $faker->unique()->numerify('FK#######'),
            'id_buku' => $request->id_buku,
            'id_kasir' => $user,
            'jumlah_beli' => $request->total_beli,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
            'total_harga' => intval($request->total_harga_transaksi),
            'tanggal' => $dateNow,
        ]);

        TempTransaction::truncate();

        $minusStok = $book->stok - $request->total_beli;

        Book::where('id_buku', $bookId)->update([
            'stok' => $minusStok,
        ]);

        return view('kasir.create_transaction')
            ->with('book', $book)
            ->with('toast_success', 'Berhasil menambahkan data!')
            ->with('receipt', $invoice->first())
            ->with('userRole', $userRole)
            ->with('page', 'TRANSACTION');
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

    public function report(){
        $userRole = Auth::user()->akses;

        return view('kasir.report')
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function transactions()
    {
        $transactions = Transaction::all();
        $userRole = Auth::user()->akses;

        foreach ($transactions as $transaction) {
            $transaction['book'] = $transaction->Book;
        }

        return view('kasir.report', compact('transactions'))
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function invoice()
    {
        $userRole = Auth::user()->akses;
        $invoices = Transaction::all();

        return view('kasir.report')
        ->with('invoices', $invoices)
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function selectInvoice(Request $request)
    {
        $userRole = Auth::user()->akses;
        $invoice = Transaction::find($request->invoice_id);
        $book = Book::where('id_buku', $invoice->id_buku)->first();

        return view('kasir.report')
        ->with('userRole', $userRole)
        ->with('action', 'SELECT')
        ->with('receipt', $invoice)
        ->with('book', $book)
        ->with('page', 'REPORT');
    }

    public function exportSales(){
        return Excel::download(new Sales, 'penjualan.xlsx');
    }
}
