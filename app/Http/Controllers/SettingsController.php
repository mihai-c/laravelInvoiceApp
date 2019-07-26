<?php

	namespace App\Http\Controllers;

	use App\Setting;
	use Illuminate\Http\Request;
	use App\User;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use App\Rules\PasswordCheck;
	use Illuminate\Support\Facades\Hash;
	use App\Rules\IBAN_Checker;
	use App\Rules\CIF_Validator;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Validation\Rule;

	class SettingsController extends Controller
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
		public function index(Request $request)
		{
			if ($request->session()->has('tab')) {
				$tab = $request->session()->get('tab');
			} else {
				$tab = NULL;
			}
			$user = User::find(Auth::user()->id);
			$conturi = DB::table('config_cont')->get();
			$docs = DB::table('config_docs')->get();
			$vat = DB::table('config_vat')->get();

			$data = ['title' => 'Setari generale',
				'page' => 'settings',
				'subpage' => 'general',
				'tab' => $tab,
				'user' => $user,
				'conturi' => $conturi,
				'documents' => $docs,
				'vats' => $vat];
			return view('settings.index', $data);
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
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Setting $setting
		 * @return \Illuminate\Http\Response
		 */
		public function show(Setting $setting)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Setting $setting
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Setting $setting)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Setting $setting
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Setting $setting)
		{

			$validator = Validator::make($request->all(), [
				'name' => 'required|min:6|max:191',
				'email' => 'required|email|max:191',
				'password' => ['required', 'max:191', new PasswordCheck],
				'newpassword' => 'sometimes|nullable|min:6|max:191',
				'repass' => 'required_with:newpassword|same:newpassword'
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));
			if ($validator->fails()) {
				return redirect('settings')
					->withInput()
					->withErrors($validator);
			}

			$data = [
				'name' => $request->input('name')
			];

			if ($request->has('newpassword')) {
				$data['password'] = Hash::make($request->input('newpassword'));
			}

			$accountUpdate = User::where('id', Auth::user()->id)
				->update($data);

			if ($accountUpdate) {
				return redirect('settings')->with('success', 'Contul a fost actualizat cu success');
			}
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Setting $setting
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Setting $setting, Request $request)
		{
			if ($request->input('type') == 'account') {
				DB::table('config_cont')
					->where('id', '=', $setting->id)
					->delete();
				return redirect('settings')->with(['success' => 'Contul bancar a fost sters', 'tab' => 'cont']);
			}
			if ($request->input('type') == 'document') {
				DB::table('config_docs')
					->where('id', '=', $setting->id)
					->delete();
				return redirect('settings')->with(['success' => 'Seria a fost stearsa', 'tab' => 'documente']);
			}

			if ($request->input('type') == 'vat') {
				DB::table('config_vat')
					->where('id', '=', $setting->id)
					->delete();
				return redirect('settings')->with(['success' => 'Cota a fost stearsa', 'tab' => 'vat']);
			}

		}

		public function update_company(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'company' => 'required|min:6|max:200',
				'cif' => ['required', 'max:50', new CIF_Validator],
				'reg' => 'required|max:200',
				'address' => 'required|min:6|max:200',
				'city' => 'required|max:200',
				'judet' => 'required|max:200',
				'iban' => ['sometimes', 'nullable', 'max:200', new IBAN_Checker],
				'banca' => 'sometimes|nullable|max:200',
				'email' => 'sometimes|nullable|email|max:200',
				'capital' => 'sometimes|nullable|regex:/^\d*(\.\d{2})?$/',
				'web' => 'sometimes|nullable|max:200',
				'logo' => 'sometimes|nullable|image|mimes:jpg,jpeg,gif,svg,png|max:1024|dimensions:max_width=500,max_height=500',
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				return $this->index('company')
					->withErrors($validator);
			}

			$input = $request->except('_token', 'logo');

			foreach ($input as $key => $value) {
				Setting::where('config_key', $key)
					->update(['config_value' => $value]);
			}

			if ($request->hasfile('logo')) {
				$file = $request->file('logo');
				$filename = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $request->company)) . '.' . $file->getClientOriginalExtension();
				$filename = preg_replace('/[_]{2,}/', "_", $filename);
				$file->move('media/company/', $filename);
				Setting::where('config_key', 'logo')
					->update(['config_value' => $filename]);
			}

			return redirect('/settings')
				->with(['success' => 'Setari firma actualizate cu succes!', 'tab' => 'company']);
		}

		public function add_accounts(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'iban_cont' => ['required', 'max:30', new IBAN_Checker, function ($attribute, $value, $fail) {
					$exists = DB::table('config_cont')
						->where(['iban' => $value])
						->count();
					if ($exists >= 1) {
						return $fail('Acest iban exista deja in baza de date!');
					}
				}],
				'banca_cont' => 'required|max:150',
				'currency' => 'required|max:3',
				'swift' => 'sometimes|nullable|max:10'
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				return redirect('settings')
					->withInput()
					->withErrors($validator)
					->with('tab', 'cont');
			}

			DB::table('config_cont')->insert([
				'iban' => $request->input('iban_cont'),
				'banca' => $request->input('banca_cont'),
				'moneda' => $request->input('currency'),
				'swift' => $request->input('swift'),
			]);

			return redirect('/settings')
				->with(['success' => 'Conturi actualizate cu succes!', 'tab' => 'cont']);
		}

		public function add_documents(Request $request)
		{
			$type = $request->input('tip_doc');
			$validator = Validator::make($request->all(), [
				'tip_doc' => 'required',
				'serie' => ['required', 'max:10', function ($attribute, $value, $fail) use ($type) {
					$exists = DB::table('config_docs')
						->where(['tip_document' => $type, 'serie_document' => $value])
						->count();
					if ($exists >= 1) {
						return $fail('Aceasta serie exista deja in baza de date!');
					}
				}],
				'numar_document' => 'required|numeric',
				'descriere' => 'sometimes|nullable|max:100'
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				return redirect('settings')
					->withErrors($validator)
					->withInput()
					->with('tab', 'documente');
			}

			DB::table('config_docs')->insert([
				'tip_document' => $request->input('tip_doc'),
				'serie_document' => $request->input('serie'),
				'numar_document' => $request->input('numar_document'),
				'descriere' => $request->input('descriere'),
				'created_at' => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now()
			]);

			return redirect('/settings')
				->with(['success' => 'Setari adaugate!', 'tab' => 'documente']);
		}

		public function add_vat(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'vat_name' => 'required|max:100',
				'vat_procent' => 'required|regex:/^\d*(\.\d{2})?$/'
			], $this->validation_settings('messages'))
				->setAttributeNames($this->validation_settings('attributes'));

			if ($validator->fails()) {
				return redirect('settings')
					->withErrors($validator)
					->withInput()
					->with('tab', 'vat');
			}

			DB::table('config_vat')->updateOrInsert([
				'vat_name' => $request->input('vat_name')
			], [
				'vat_name' => $request->input('vat_name'),
				'vat_procent' => $request->input('vat_procent'),
				'created_at' => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now()
			]);

			return redirect('/settings')
				->with(['success' => 'Cota TVA adaugata cu succes!', 'tab' => 'vat']);
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
				'same' => ' :attribute  nu este aceeasi cu :other!',
				'numeric' => ' :attribute trebuie sa contina caractere numerice!'
			];

			$attributes = [
				'name' => 'Numele',
				'password' => 'Parola',
				'newpassword' => 'Parola noua',
				'repass' => 'Confirmarea parolei',
				'company' => 'Denumirea Companiei',
				'cif' => 'CUI -ul',
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
				'logo' => 'Logo',
				'iban_cont' => 'IBAN-ul',
				'banca_cont' => 'Banca',
				'currency' => 'Moneda',
				'swift' => 'SWIFT',
				'serie' => 'Seria',
				'numar_document' => 'Numarul de inceput',
				'descriere' => 'Descrierea',
				'vat_name' => 'Denumire cota',
				'vat_procent' => 'Procent'
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
