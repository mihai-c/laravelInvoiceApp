<?php

	namespace App\Http\Controllers;

	use App\Product;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use App\Gallery;
	use Image;

	class ProductsController extends Controller
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
			$products = Product::get();

			$data = [
				'title' => 'Lista produse',
				'page' => 'nomenclator',
				'subpage' => 'lista-produse',
				'products' => $products
			];
			return view('products.index', $data);
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
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			Validator::make($request->all(), [
				'sku' => 'required|unique:products,sku|max:50',
				'name' => ['required', 'min:6', 'max:150'],
				'price' => 'required|regex:/^\d*(\.\d{2})?$/',
				'um' => 'required|max:5',
				'currency' => 'required|max:3',
				'weight' => 'sometimes|nullable|regex:/^\d*(\.\d{2,3})?$/'
			], $this->validation_settings('messages'))->setAttributeNames($this->validation_settings('attributes'))->validate();

			$product = Product::create([
				'sku' => $request->input('sku'),
				'product_name' => $request->input('name'),
				'price' => $request->input('price'),
				'weight' => $request->input('weight'),
				'currency' => $request->input('currency'),
				'description' => $request->input('description'),
				'product_um' => $request->input('um')
			]);

			if ($product) {
				return redirect('products')->with('success', 'Produs adaugat cu success!');
			} else {
				return redirect('products')->with('err', 'Error. Please try again later!');
			}

		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Product $product
		 * @return \Illuminate\Http\Response
		 */
		public function show(Product $product)
		{
			$product = Product::find($product->id);

			$data = [
				'title' => $product->product_name,
				'page' => 'nomenclator',
				'subpage' => 'lista-produse',
				'product' => $product
			];
			return view('products.show', $data);

		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Product $product
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Product $product)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Product $product
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Product $product)
		{
			$validator = Validator::make($request->all(), [
				'sku' => 'required|unique:products,sku,' . $product->id . '|max:50',
				'name' => ['required', 'min:3', 'max:150'],
				'price' => 'required|regex:/^\d*(\.\d{2})?$/',
				'um' => 'required|max:5',
				'currency' => 'required|max:3',
				'weight' => 'sometimes|nullable|regex:/^\d*(\.\d{2,3})?$/'
			], $this->validation_settings('messages'))->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				redirect()->route('products.show', $product->id)
					->withInput()
					->withErrors($validator);
			}
			$productUpdate = Product::where('id', $product->id)
				->update([
					'sku' => $request->input('sku'),
					'product_name' => $request->input('name'),
					'price' => $request->input('price'),
					'weight' => $request->input('weight'),
					'currency' => $request->input('currency'),
					'description' => $request->input('description'),
					'product_um' => $request->input('um')
				]);

			if ($productUpdate) {
				return redirect()->route('products.show', $product->id)
					->with('success', 'Produs actualizat cu succes!');
			} else {
				return redirect('products')
					->with('err', 'Error. Please try again later!');
			}
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Product $product
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Product $product)
		{
			//
		}

		public function add_images(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'file' => 'image|mimes:jpg,jpeg,gif,svg,png|max:2048|dimensions:max_width=2500,max_height=2500'
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));
			if ($validator->fails()) {
				return response()->json(['errors' => true, 'message' => 'Imaginea trebuie sa fie de tip jpg,gif,svg,png cu o dimensiune maxima de 2M si inaltimea/latimea max. 2500px'], 200);
			}

			$file = $request->file('file');
			$path = public_path('media/products/' . $request->input('product_id'));
			if (!is_dir($path)) {
				mkdir($path);
				mkdir($path . '/thumbs');
			}
			$filename = Carbon::now()->timestamp . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
			$file->move($path, $filename);
			$image_resize = Image::make($path . '/' . $filename);
			$image_resize->fit(100, 100, function ($constraint) {
				$constraint->upsize();
			});
			$image_resize->save($path . '/thumbs/' . $filename);

			$image = Gallery::create([
				'product_id' => $request->input('product_id'),
				'file_name' => $filename
			]);

			$default_img = Product::find($request->input('product_id'));
			if (is_null($default_img->default_img)) {
				Product::where('id', $request->input('product_id'))
					->update(['default_img' => $filename]);
			}
			if ($image) {
				return response()->json(['success' => true], 200);
			} else {
				return response()->json(['errors' => true, 'message' => 'Please try again later'], 200);
			}
		}

		public function delete_images(Request $request)
		{
			$filename = $request->input('filename');
			Gallery::where('file_name', $filename)->delete();
			$path = public_path() . '/images/' . $filename;
			if (file_exists($path)) {
				unlink($path);
			}
			return $filename;
		}


		public function validation_settings($type = NULL)
		{
			$messages = [
				'required' => ' :attribute este un camp obligatoriu! ',
				'min' => ' :attribute trebuie sa contina minim :min caractere!',
				'max' => [
					'numeric' => ' Campul :attribute nu poate fi mai mare decat :max.',
					'file' => ' Campul :attribute nu poate fi mai mare de :max kilobiti.',
					'string' => ' Campul :attribute nu poate contine mai mult de :max caractere.',
					'array' => ' Campul :attribute nu poate avea mai mult de :max elemente.',
				],
				'unique' => ' :attribute exista deja in baza noastra de date!',
				'required_with' => ' Campul :attribute este obligatoriu la completarea campului :values !',
				'image' => ' Campul :attribute trebuie sa fie o imagine!',
				'mimes' => ' Campul :attribute trebuie sa fie de tipul :values',
				'dimensions' => ' Campul :attribute are dimensiuni invalide!',
				'regex' => ' Campul :attribute trebuie sa contina un numar zecimal!'
			];

			$attributes = [
				'name' => 'Denumire Produs',
				'sku' => 'Cod produs',
				'price' => 'Pret',
				'um' => 'U.M.',
				'currency' => 'Moneda',
				'weight' => 'Greutate',
				'description' => 'Descriere',
				'image' => 'Imaginea'
			];

			switch ($type) {
				case 'attributes':
					return $attributes;
					break;
				case 'messages':
					return $messages;
					break;
				default:
					return NULL;
			}

		}
	}
