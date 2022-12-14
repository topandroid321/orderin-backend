<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::with(['user'])->where('status','!=','SUCCESS')
            ->orderBy('id','DESC');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('transaction.show', $item->id) . '">
                            <i class="fad fa-eye text-xs mr-2"></i> 
                            Show
                        </a>
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('transaction.edit', $item->id) . '">
                            <i class="fad fa-pencil text-xs mr-2"></i> 
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('transaction.destroy', $item->id) . '" method="POST">
                            <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            <i class="fad fa-trash text-xs mr-2"></i>     
                            Hapus
                            </button>
                                ' . method_field('delete') . csrf_field() . '
                            </form>';

                })
                ->editColumn('total_price', function ($item) {
                    return number_format($item->total_price);
                })
                ->editColumn('created_at', function($item){
                    return $item->created_at->toDateString();
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('transaction.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if (request()->ajax()) {
            $query = TransactionItems::with(['product'])->where('transaction_id', $transaction->id);

            return DataTables::of($query)
                ->editColumn('product.price', function ($item) {
                    return number_format($item->product->price);
                })
                ->make();
        }

        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transaction.edit',[
            'item' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->all();

        $transaction->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, TransactionItems $items)
    {
        $items->where('transaction_id',$transaction->id)->delete();
        $transaction->delete();
        notify()->error('Data Succesfuly Deleted','Delete Data');
        return redirect()->route('transaction.index');

    }
    public function print(Transaction $transaction, $id){
        $transaction = Transaction::with(['user'])->find($id);
        $items = TransactionItems::with(['product'])->where('transaction_id', $transaction->id)->get();
        $html = view('transaction.billpayment', [
            'transaction'=>$transaction,
        ],compact('items'));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper([0, 0, 226.77, 500],'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
    //function untuk menampilkan halaman report Transaksi
    public function transactionReport(){
        if (request()->ajax()) {
            $query1 = Transaction::with(['user'])->where('status','SUCCESS');

            return DataTables::of($query1)
                ->editColumn('total_price', function ($item) {
                    return number_format($item->total_price);
                })
                ->editColumn('created_at', function($item){
                    return $item->created_at->toDateString();
                })
                ->make();
        }
        return view('report.transaction');
    }

    // print all report transaction
    public function printReportAll(Transaction $transaction){
        
        $total = Transaction::with(['user'])->where('status','SUCCESS')
        ->sum('total_price');
        $transaction = Transaction::with(['user'])->where('status','SUCCESS')
        ->paginate();
        $html = view('report.printall', compact('transaction','total'));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4','potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Report All -'.Date('Y-m-d').'.pdf');
    }

    public function printByDate(Request $request,Transaction $transaction){
        $start = $request->input('start');
        $end = $request->input('end');
        $total = Transaction::with(['user'])->where('status','SUCCESS')
        ->whereBetween('created_at', [$start, $end])
        ->sum('total_price');
        $transaction = Transaction::with(['user'])->where('status','SUCCESS')
        ->whereBetween('created_at', [$start, $end])
        ->paginate();
        $html = view('report.printbydate', compact('transaction','total'));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4','potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Report All -'.Date('Y-m-d').'.pdf');
    }


    // index untuk user role koki
    public function indexKoki()
    {
        if (request()->ajax()) {
            $query = Transaction::with(['user'])->where('status','ONPROCESS');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('transaction.show', $item->id) . '">
                            <i class="fad fa-eye text-xs mr-2"></i> 
                            Show
                        </a>
                        ';

                })
                ->editColumn('total_price', function ($item) {
                    return number_format($item->total_price);
                })
                ->editColumn('created_at', function($item){
                    return $item->created_at->toDateString();
                })
                ->make();
        }
        return view('transaction.indexkoki');
    }

    // membuat function update status menjadi success, untuk role user
    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        DB::table('transactions')
        ->where('id', $id)
        ->update(['status' => $status]);
        return redirect()->route('transaction.indexKoki');
    }

    // mengambil data transaction untuk ditampilkan di menu pegawai/kasir
    public function transactionData(){
        if (request()->ajax()) {
            $query1 = Transaction::with(['user'])->where('status','SUCCESS');

            return DataTables::of($query1)
                ->editColumn('total_price', function ($item) {
                    return number_format($item->total_price);
                })
                ->editColumn('created_at', function($item){
                    return $item->created_at->toDateString();
                })
                ->make();
        }
        return view('report.datatransaction');
    }
}
