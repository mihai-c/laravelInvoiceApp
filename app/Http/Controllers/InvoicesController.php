<?php

	namespace App\Http\Controllers;

	use App\Invoice;
	use App\Product;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class InvoicesController extends Controller
	{


		public function __construct()
		{
			$this->middleware('auth');
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$invoice = Invoice::where('user_id', Auth::user()->id)->get();

			$data = [
				'title' => 'Lista facturi',
				'page' => 'lista',
				'subpage' => 'lista-invoices',
				'invoices' => $invoice
			];
			return view('invoices.index', $data);
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			$products = Product::all();
			$data = [
				'title' => 'Adauga factura',
				'page' => 'emite',
				'subpage' => 'invoices',
				'products' => $products
			];
			return view('invoices.create', $data);
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Invoice $invoice
		 * @return \Illuminate\Http\Response
		 */
		public function show(Invoice $invoice)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Invoice $invoice
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Invoice $invoice)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Invoice $invoice
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Invoice $invoice)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Invoice $invoice
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Invoice $invoice)
		{
			//
		}
	}
