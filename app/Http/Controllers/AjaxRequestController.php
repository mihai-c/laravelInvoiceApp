<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Libraries\CNP_Validator;
	use App\Libraries\Cif_Details;
	use Illuminate\Support\Facades\DB;
	use App\Gallery;
	use App\Product;
	use App\Client;

	class AjaxRequestController extends Controller
	{
		public function get_client_details(Request $request)
		{
			if ($request->isMethod('post')) {
				$json = ['error' => FALSE];
				$cif_cnp = $request->input('cif_cnp');
				if (is_numeric($cif_cnp) && strlen($cif_cnp) == 13) {
					if (CNP_Validator::cnp($cif_cnp)) {
						foreach (CNP_Validator::cnp_details($cif_cnp) as $key => $value) {
							$json[$key] = $value;
						}
					} else {
						$json['error'] = TRUE;
						$json['message'] = 'CNP-ul este invalid!';
					}
				} else {
					if (Cif_Details::valid_cif($cif_cnp)) {
						if (!is_int($cif_cnp)) {

							$cif_cnp = strtoupper($cif_cnp);

							if (strpos($cif_cnp, 'RO') === 0) {
								$cif_cnp = substr($cif_cnp, 2);
							}

							$cif_cnp = (int)trim($cif_cnp);
						}
						$cif_info = Cif_Details::get_details($cif_cnp);
						if ($cif_info) {
							foreach ($cif_info as $key => $value) {
								$json[$key] = $value;
							}
						} else {
							$json['error'] = TRUE;
							$json['message'] = 'CIF-ul este nespecificat!';
						}
					} else {
						$json['error'] = TRUE;
						$json['message'] = 'CIF-ul este invalid!';
					}
				}
				return response()->json($json);
			} else {

			}
		}

		public function update_account(Request $request)
		{
			$json = ['error' => FALSE];

			$account_id = $request->input('id');

			$status = $request->input('status') == 'yes' ? TRUE : FALSE;

			$json['status'] = $status;

			DB::table('config_cont')
				->where('id', $account_id)
				->update([
					'used' => $status
				]);
			$json['success'] = TRUE;
			$json['message'] = 'Cont actualizat!';

			return response()->json($json);
		}

		public function update_default_doc(Request $request)
		{
			$json = ['error' => FALSE];

			$doc_id = $request->input('id');
			$type = $request->input('tip');

			DB::table('config_docs')
				->where('tip_document', $type)
				->update([
					'default_document' => 0
				]);
			DB::table('config_docs')
				->where(['id' => $doc_id, 'tip_document' => $type])
				->update([
					'default_document' => 1
				]);

			$json['success'] = TRUE;

			return response()->json($json);
		}

		public function update_config_default_vat(Request $request)
		{
			$json = ['error' => FALSE];
			$id = $request->input('id');

			DB::table('config_vat')
				->where('default_vat', '=', 1)
				->update([
					'default_vat' => 0
				]);
			DB::table('config_vat')
				->where(['id' => $id])
				->update([
					'default_vat' => 1
				]);

			$json['success'] = TRUE;

			return response()->json($json);
		}

		public function delete_image_product(Request $request)
		{
			$id = $request->input('image_id');

			$image = Gallery::find($id);
			if ($image) {
				$path = public_path('media/products/' . $image->product_id);
				unlink($path . '/' . $image->file_name);
				unlink($path . '/thumbs/' . $image->file_name);
				Gallery::where('id', $id)->delete();

				$n_images = Gallery::where('product_id', $image->product_id)
					->count();

				return response()->json(['success' => true, 'message' => 'Image deleted!', 'images' => $n_images]);
			}

		}

		public function set_default_image_product(Request $request)
		{
			$id = $request->input('image_id');
			$image = Gallery::find($id);
			$update = Product::where('id', $image->product_id)
				->update([
					'default_img' => $image->file_name
				]);
			if ($update) {
				return response()->json(['success' => true, 'message' => 'Image set as default', 'new_img' => $image->file_name], 200);
			} else {
				return response()->json(['success' => false, 'message' => 'Error on set image', 400]);
			}

		}

		public function get_client(Request $request)
		{
			$client_id = $request->input('client_id');
			if (!is_null($client_id) or !empty($client_id)) {
				$json = ['error' => false];
				$details = Client::find($client_id);
				if ($details) {
					$details = $details->toArray();
					foreach ($details as $key => $value) {
						$json[$key] = $value != null ? $value : '';
					}
					return response()->json($json);
				}
				return response()->json(['error' => true], 400);
			}
			return response()->json(['error' => false], 200);

		}

		public function get_product_details(Request $request)
		{
			$id = $request->input('product_id');

			if (!is_null($id) or !empty($id)) {
				$json = ['error' => false];
				$product = Product::find($id);

				if ($product) {
					$product = $product->toArray();
					foreach ($product as $key => $value) {
						$json[$key] = $value != null ? $value : '';
					}
					return response()->json($json);
				}
			}
			return response()->json(['error' => false], 200);

		}
	}
