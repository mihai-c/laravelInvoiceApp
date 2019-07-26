<?php

	namespace App\Http\Controllers;

	use App\Client;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use App\Rules\IBAN_Checker;
	use App\Libraries\Settings;

	class ClientsController extends Controller
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
			$clients = Client::where('user_id', Auth::user()->id)->get();
			$max_id = Client::max('id');
			$data = [
				'title' => 'Lista clienti',
				'page' => 'nomenclator',
				'subpage' => 'lista-clienti',
				'clients' => $clients,
				'max_id' => $max_id
			];
			return view('clients.index', $data);
			//
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
			/*$this->validate($request,[
				'cif'       => 'unique:clients,cif|max:50',
				'name'      => 'required|min:6|max:150',
				'address'   => 'required|min:6|max:250',
				'reg'       => 'max:100',
				'judet'     => 'required|min:3|max:150',
				'city'      => 'required|min:3|max:150',
				'zip'       => 'max:50',
				'country'   => 'max:100',
				'iban'      => 'max:100',
				'banca'     => 'required_with:iban|max:100',
				'contact'   => 'max:150',
				'telefon'   => 'max:50',
				'email'     => 'sometimes|nullable|email|max:100',
			]);*/

			Validator::make($request->all(), [
				'cif' => 'required|unique:clients,cif|max:50',
				'name' => ['required', 'min:6', 'max:150'],
				'address' => 'required|min:6|max:250',
				'reg' => 'max:100',
				'judet' => 'required|min:3|max:150',
				'city' => 'required|min:3|max:150',
				'zip' => 'max:50',
				'country' => 'max:100',
				'iban' => ['max:100', new IBAN_Checker],
				'banca' => 'required_with:iban|max:100',
				'contact' => 'max:150',
				'phone' => 'max:50',
				'email' => 'sometimes|nullable|email|max:100',
			], $this->validation_settings('messages'))->setAttributeNames($this->validation_settings('attributes'))->validate();

			$attr_fiscal = $request->input('platitor_tva') ? 'RO' : NULL;

			$client = Client::create([
				'code' => Settings::get_value('client_code'),
				'company' => $request->input('name'),
				'cif' => $request->input('cif'),
				'attr_fiscal' => $attr_fiscal,
				'reg' => $request->input('reg'),
				'address' => $request->input('address'),
				'judet' => $request->input('judet'),
				'city' => $request->input('address'),
				'zip' => $request->input('zip'),
				'contact_person' => $request->input('contact'),
				'phone' => $request->input('phone'),
				'email' => $request->input('email'),
				'country' => $request->input('country'),
				'iban' => $request->input('iban'),
				'banca' => $request->input('banca'),
				'user_id' => Auth::user()->id
			]);

			if ($client) {
				return redirect('clients')->with('success', 'Client adaugat cu success!');
			} else {
				return redirect('clients')->with('err', 'Error. Please try again later!');
			}
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Client $client
		 * @return \Illuminate\Http\Response
		 */
		public function show(Client $client)
		{
			$client = Client::find($client->id);

			$data = [
				'title' => $client->company,
				'page' => 'clients',
				'subpage' => 'lista-clienti',
				'client' => $client
			];

			return view('clients.show', $data);
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Client $client
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Client $client)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Client $client
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Client $client)
		{
			$validator = Validator::make($request->all(), [
				'cif' => 'required|unique:clients,cif,' . $client->id . '|max:50',
				'name' => ['required', 'min:6', 'max:150'],
				'address' => 'required|min:6|max:250',
				'reg' => 'max:100',
				'logo' => 'sometimes|nullable|image|mimes:jpg,png,svg,gif,jpeg|max:2048|dimensions:max_width=500,max_height=500',
				'judet' => 'required|min:3|max:150',
				'city' => 'required|min:3|max:150',
				'zip' => 'max:50',
				'country' => 'max:100',
				'iban' => ['max:100', new IBAN_Checker],
				'banca' => 'required_with:iban|max:100',
				'contact' => 'max:150',
				'phone' => 'max:50',
				'email' => 'sometimes|nullable|email|max:100',
			], $this->validation_settings('messages'))->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				return redirect('clients/' . $client->id)
					->withInput()
					->withErrors($validator);
			}

			if ($request->hasfile('logo')) {
				$file = $request->file('logo');
				$filename = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $request->name)) . '.' . $file->getClientOriginalExtension();
				$filename = preg_replace('/[_]{2,}/', "_", $filename);
				$file->move('media/clients/', $filename);
			} else {
				$filename = NULL;
			};

			$attr_fiscal = $request->input('platitor_tva') ? 'RO' : NULL;

			$clientUpdate = Client::where('id', $client->id)
				->update([
					'company' => $request->input('name'),
					'cif' => $request->input('cif'),
					'attr_fiscal' => $attr_fiscal,
					'logo' => $filename,
					'reg' => $request->input('reg'),
					'address' => $request->input('address'),
					'judet' => $request->input('judet'),
					'city' => $request->input('address'),
					'zip' => $request->input('zip'),
					'contact_person' => $request->input('contact'),
					'phone' => $request->input('phone'),
					'email' => $request->input('email'),
					'country' => $request->input('country'),
					'iban' => $request->input('iban'),
					'banca' => $request->input('banca'),
				]);

			if ($clientUpdate) {
				return redirect()->route('clients.show', $client->id)->with('success', 'Client adaugat cu success!');
			} else {
				return redirect('clients')->with('err', 'Error. Please try again later!');
			}
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Client $client
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Client $client)
		{
			$client = Client::find($client->id);
			if ($client->delete()) {
				return redirect()->route('clients.index')->with('success', 'Clientul ' . $client->company . ' a fost sters!');
			}

			return redirect()->route('clients.index')->with('err', 'Error. Please try again later!');
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
				'dimensions' => ' Campul :attribute are dimensiuni invalide!'
			];

			$attributes = [
				'name' => 'Denumirea',
				'cif' => 'CIF/CNP -ul',
				'address' => 'Adresa',
				'reg' => 'Nr. Reg. Com',
				'judet' => 'Judetul',
				'city' => 'Orasul',
				'zip' => 'Codul postal',
				'country' => 'Tara',
				'iban' => 'IBAN',
				'banca' => 'Banca',
				'contact' => 'Persoana  de contact',
				'phone' => 'Telefonul',
				'email' => 'CIF/CNP -ul',
				'logo' => 'Logo'
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
