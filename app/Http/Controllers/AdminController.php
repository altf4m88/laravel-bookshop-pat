<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Supply;
use App\Models\Distributor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Maatwebsite\Excel\Facades\Excel;

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
        $books = Book::orderBy('updated_at', 'desc')->get();

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('page', 'INPUT');
    }

    public function createBookForm()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('action', 'CREATE')
        ->with('page', 'INPUT');
    }

    public function updateBookForm($id)
    {
        $userRole = Auth::user()->akses;

        $book = Book::find($id);

        return view('admin.input')
        ->with('book', $book)
        ->with('userRole', $userRole)
        ->with('action', 'UPDATE')
        ->with('page', 'INPUT');
    }

    public function createBook(Request $request){
        $faker = Faker::create('id_ID');

        Book::create([
            'id_buku' => $faker->unique()->numerify('BK#######'),
            'judul' => $request->judul,
            'noisbn' => $request->noisbn,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'stok' => Book::DEFAULT_STOCK,
            'harga_pokok' => $request->harga_pokok,
            'harga_jual' => $request->harga_jual,
            'ppn' => Book::TAX,
            'diskon' => $request->diskon,
        ]);

        return redirect('admin/input/book');
    }

    public function updateBook(Request $request){
        $book = Book::find($request->id_buku);
        
        $book->update([
            'judul' => $request->judul,
            'noisbn' => $request->noisbn,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'harga_pokok' => $request->harga_pokok,
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->diskon,
        ]);

        return redirect('admin/input/book');

    }

    public function deleteBook($id){
        $book = Book::find($id);
        
        $book->delete();

        return redirect('admin/input/book');
    }

    public function allBooks()
    {
        $userRole = Auth::user()->akses;
        $books = Book::all();

        return view('admin.report')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('page', 'REPORT');
    }

    public function booksByWriterForm(Request $request)
    {
        $userRole = Auth::user()->akses;
        $writers =  Book::get()->pluck('penulis');

        return view('admin.report')
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


        return view('admin.report')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('currentWriter', $request->writer)
        ->with('writers', $writers)
        ->with('action', 'VIEW_WRITER')
        ->with('page', 'REPORT');
    }

    public function supply()
    {
        $userRole = Auth::user()->akses;
        $books = Book::all();
        $distributors = Distributor::all();

        return view('admin.input')
        ->with('userRole', $userRole)
        ->with('books', $books)
        ->with('distributors', $distributors)
        ->with('page', 'INPUT');
    }

    public function inputSupply(Request $request)
    {
        $userRole = Auth::user()->akses;
        $book = Book::findOrFail($request->book_id);

        $supply = new Supply;

        $supply->id_distributor = $request->distributor_id;
        $supply->id_buku = $request->book_id;
        $supply->jumlah = $request->jumlah;
        $supply->tanggal = $request->tanggal;

        $supply->save();

        $plusStok = $book->stok + $request->jumlah;

        $book->update([
            'stok' => $plusStok,
        ]);

        $book->save();

        return redirect()
        ->route('books-supply')
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

    public function getSupply()
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


        return view('admin.report')
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

        return view('admin.report')
        ->with('supplies', $dataSupply)
        ->with('dates', $dates)
        ->with('userRole', $userRole)
        ->with('page', 'REPORT');
    }

    public function filterByDistributorPage()
    {
        $distributors = Distributor::all();
        $userRole = Auth::user()->akses;


        return view('admin.report')
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

        return view('admin.report')
        ->with('supplies', $dataSupply)
        ->with('userRole', $userRole)
        ->with('distributor', $distributor)
        ->with('time', $time)
        ->with('bookCount', $bookCount)
        ->with('action', 'VIEW_DISTRIBUTOR')
        ->with('page', 'REPORT');
    }

    public function popularBooks()
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

        return view('admin.report')
        ->with('userRole', $userRole)
        ->with('books', $booksWithTransaction)
        ->with('page', 'REPORT');
    }
    public function unpopularBooks()
    {
        $userRole = Auth::user()->akses;
        $books = Book::with('transactions')->get();

        $booksWithNoTransaction = [];
        foreach($books as $book){
            if(count($book->transactions) === 0){
                array_push($booksWithNoTransaction, $book);
            }
        }

        //WE DONT NEED THIS WASTED LOOP
        // foreach($booksWithNoTransaction as $key => $book)
        // {
        //     $totalSold = 0;
        //     foreach($book->transactions as $transaction){
        //         $totalSold += $transaction->jumlah_beli;
        //     }

        //     $booksWithNoTransaction[$key]['total_sold'] = $totalSold;
        //     $booksWithNoTransaction[$key]['total_transaction'] = count($book->transactions);
        // }

        return view('admin.report')
        ->with('userRole', $userRole)
        ->with('books', $booksWithNoTransaction)
        ->with('page', 'REPORT');
    }
}
