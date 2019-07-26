@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datetime/dist/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/autocomplete/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="inner-block add-invoice">
        <div class="cols-grids">
            <h2>{{ $title }}
                <a href="{{ route('invoices.create') }}" class="hvr-icon-float-away pull-right popup-with-zoom-anim">Adauga</a>
            </h2>
            <div class="col-md-12 page-main">
                @include('errors.contenterrors')
				<?php //dd($errors->all());?>
                <form method="post" action="{{ route('invoices.create') }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <h3>Informatii Client</h3>
                            <div class="form-group">
                                <label for="client-select">Alege client</label>
                                <select name="client_select" id="client-select" class="form-control text-box-noradius">
                                    <option value="">Alege</option>
                                    @foreach(Clients::get_list() as $client)
                                        <option value="{{ $client->id }}">{{$client->company}}
                                            - {{$client->cif}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group
                                @if ($errors->has('client_name'))
                                            has-error
    @endif ">
                                        <label for="client-name">Client</label>
                                        <input class="form-control text-box-noradius client_name" type="text"
                                               value="{{ old('client_name') }}" name="client_name"
                                               id="client-name" placeholder="Client"/>
                                        @if ($errors->has('client_name'))
                                            <span class="help-block">{{ $errors->first('client_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group
                                @if ($errors->has('client_cif'))
                                            has-error
    @endif ">
                                        <label for="client-name">CIF/CNP</label>
                                        <input class="form-control text-box-noradius client-cif" type="text"
                                               value="{{ old('client_cif') }}" name="client_cif"
                                               id="client-cif" placeholder="CIF/CNP"/>
                                        @if ($errors->has('client_cif'))
                                            <span class="help-block">{{ $errors->first('client_cif') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group
                                @if ($errors->has('client_reg'))
                                            has-error
    @endif ">
                                        <label for="client-reg">Nr.Reg.Com</label>
                                        <input class="form-control text-box-noradius client-reg" type="text"
                                               value="{{ old('client_reg') }}" name="client_reg"
                                               id="client-reg" placeholder="Jxx/xxx/xxxx"/>
                                        @if ($errors->has('client_reg'))
                                            <span class="help-block">{{ $errors->first('client_reg') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group
                                    @if ($errors->has('client_address'))
                                            has-error
    @endif ">
                                        <label for="client-address">Adresa</label>
                                        <input class="form-control text-box-noradius client-address" type="text"
                                               value="{{ old('client_address') }}" name="client_address"
                                               id="client-address" placeholder="Jxx/xxx/xxxx"/>
                                        @if ($errors->has('client_address'))
                                            <span class="help-block">{{ $errors->first('client_address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group
                                    @if ($errors->has('client_iban'))
                                            has-error
    @endif ">
                                        <label for="client-iban">Iban</label>
                                        <input class="form-control text-box-noradius client-iban" type="text"
                                               value="{{ old('client_iban') }}" name="client_iban"
                                               id="client-iban" placeholder="Contul Iban"/>
                                        @if ($errors->has('client_iban'))
                                            <span class="help-block">{{ $errors->first('client_iban') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group
                                    @if ($errors->has('client_banca'))
                                            has-error
    @endif ">
                                        <label for="client-banca">Banca</label>
                                        <input class="form-control text-box-noradius client-banca" type="text"
                                               value="{{ old('client_banca') }}" name="client_banca"
                                               id="client-banca" placeholder="Banca"/>
                                        @if ($errors->has('client_banca'))
                                            <span class="help-block">{{ $errors->first('client_banca') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <h4>Informatii Factura</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group
                                    @if ($errors->has('invoice_date'))
                                            has-error
    @endif ">
                                        <label for="invoice-date">Data emiterii</label>
                                        <input class="form-control text-box-noradius invoice-date" type="text"
                                               value="{{ old('invoice_date') }}" name="invoice_date"
                                               id="invoice-date" placeholder="Data emiterii"/>
                                        @if ($errors->has('invoice_date'))
                                            <span class="help-block">{{ $errors->first('invoice_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group
                                    @if ($errors->has('invoice_term'))
                                            has-error
                                    @endif ">
                                        <label for="invoice-term">Data scadentei</label>
                                        <input class="form-control text-box-noradius invoice-term" type="text"
                                               value="{{ old('invoice_term') }}" name="invoice_term"
                                               id="invoice-term" placeholder="Data Scadentei"/>
                                        @if ($errors->has('invoice_term'))
                                            <span class="help-block">{{ $errors->first('invoice_term') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group
                                    @if ($errors->has('invoice_number'))
                                            has-error
                                    @endif ">
                                        <label for="invoice-number">Serie/Numar factura</label>
                                        <select name="invoice_number" class="form-control text-box-noradius">
											<?php echo Settings::get_invoice_number(); ?>
                                        </select>
                                        @if ($errors->has('invoice_number'))
                                            <span class="help-block">{{ $errors->first('invoice_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table" id="create-invoice" width="100%" cellspacing="0"
                                       style="border: none;">
                                    <thead>
                                    <tr>
                                        <th>Nr.crt</th>
                                        <th class="product-info">Denumire produs/serviciu</th>
                                        <th class="product-um" align="center">U.M.</th>
                                        <th class="product-qty" align="center">Cantitate</th>
                                        <th class="product-price" align="right">Pret</th>
                                        <th class="product-value" align="right">Valoare</th>
                                        <th class="product-opt"></th>
                                    </tr>
                                    <tr>
                                        <th align="center">
                                            <small>0</small>
                                        </th>
                                        <th align="center">
                                            <small>1</small>
                                        </th>
                                        <th align="center">
                                            <small>2</small>
                                        </th>
                                        <th align="center">
                                            <small>3</small>
                                        </th>
                                        <th align="center">
                                            <small>4</small>
                                        </th>
                                        <th align="center">
                                            <small>5 (3x4)</small>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot id="product-info">
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-group">
                                                <input name="product_name"
                                                       class="form-control text-box-noradius product-name-input"
                                                       id="product-name-input" type="text"/>
                                                <input name="product_id"
                                                       class="form-control text-box-noradius product-id-input"
                                                       id="product-id-input" type="hidden"/>
                                            </div>
                                        </td>
                                        <td>
                                            <input name="product_um"
                                                   class="form-control text-box-noradius product-um-input"
                                                   style="max-width: 80px; min-width: 60px;" id="product-um-input"
                                                   type="text">
                                        </td>
                                        <td>
                                            <input name="product_qty"
                                                   class="form-control text-box-noradius product-qty-input"
                                                   style="max-width: 80px; min-width: 60px;" id="product-qty-input"
                                                   type="text">
                                        </td>
                                        <td>
                                            <input name="product_price"
                                                   class="price-input text-box-noradius pull-left product-price-input"
                                                   style="max-width: 80px; min-width: 70px;" id="product-price-input"
                                                   type="text">
                                            <select name="currency" class="text-box-noradius pull-right currency"
                                                    id="product-currency">
                                                <option value="RON">RON</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                            </select>
                                        </td>
                                        <td class="add-product-button" colspan="2" align="right">
                                            <input name="product_id" class="form-control" id="product_id" type="hidden">
                                            <input name="product_name" class="form-control" id="product_name"
                                                   type="hidden">
                                            <input name="product_sku" class="form-control" id="product_sku"
                                                   type="hidden">
                                            <button type="button" class="btn save-btn " id="add-product">Adauga</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><span class="pull-right"><strong>Total:</strong></span></td>
                                        <td><strong class="pull-right"> &nbsp;RON </strong>
                                            <div class="grand-total pull-right" id="grand-total"
                                                 style="font-weight: bold"><input name="grand_total" value=""
                                                                                  readonly="" class="total-value"
                                                                                  type="text"></div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    {{--popup grid--}}
    <div id="popup">
        <div id="small-dialog6" class="mfp-hide">
            <div class="pop_up">
                <h5><i class="fas fa-info-circle"></i> Va ruga sa corectati erorile!</h5>
                <div class="messages">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('vendor/datetime/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/datetime/dist/locales/bootstrap-datepicker.ro.min.js') }}"></script>
    <script src="{{ asset('vendor/autocomplete/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/Inputmask/js/inputmask.js') }}"></script>
    <script src="{{ asset('vendor/Inputmask/js/inputmask.extensions.js') }}"></script>
    <script src="{{ asset('vendor/Inputmask/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('vendor/Inputmask/js/inputmask.numeric.extensions.js') }}"></script>
@endsection
@section('js_scripts')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            /*invoice var total general, nr.crt */
            var total = 0,
                nr_crt = 0;
            /* Input mask numbers */
            $('input[type="text"]#product-qty-input').inputmask({
                'alias': 'decimal',
                'groupSeparator': ' ',
                'autoGroup': true,
                'digits': 3,
                'digitsOptional': true,
                'placeholder': '0.00'
            });
            $('#product-price-input').inputmask({
                'alias': 'decimal',
                'groupSeparator': ' ',
                'autoGroup': true,
                'digits': 4,
                'digitsOptional': true,
                'placeholder': '0.00'
            });

            /* date picker */
            $('#invoice-date, #invoice-term').datepicker({
                format: 'dd.mm.yyyy',
                orientation: 'bottom',
                todayBtn: true,
                language: 'ro',
                todayHighlight: true,
                zIndexOffset: 110,
                autoclose: true
            });

            /*CSRF Token */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* Ajax request get client details on select */
            $('#client-select').select2().on('select2:select', function () {
                var client_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "/get-client-details",
                    data: {client_id: client_id},
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        if (data.error == false) {
                            $('#client-name').val(data.company);
                            $('#client-cif').val(data.attr_fiscal + data.cif);
                            $('#client-reg').val(data.reg);
                            $('#client-address').val(data.address);
                            $('#client-iban').val(data.iban);
                            $('#client-banca').val(data.banca);
                        }
                    },
                    error: function () {
                        alert('Clientul nu exista in baza de date!');
                    }
                });
            });
            /* eof get client details*/

            /* Autocomplet list of products */
            var availableProducts = [
                    @foreach($products as $product)
                {
                    label: "{{ $product->sku }} - {{ $product->product_name}}",
                    value: "{{ $product->id}}",
                },
                @endforeach
            ];
            $("#product-name-input").autocomplete({
                source: availableProducts,
                focus: function (event, ui) {
                    $("#product-name-input").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#product-name-input").val(ui.item.label);
                    return false;
                },
                change: function (event, ui) {
                    if (ui.item.value !== null) {
                        /* Complete fields on select from autocomplete */
                        $.ajax({
                            type: "POST",
                            url: "/get-product-details",
                            data: {product_id: ui.item.value},
                            dataType: "json",
                            cache: false,
                            success: function (data) {
                                if (data.error == false) {
                                    $('#product-id-input').val(data.id);
                                    $('#product-um-input').val(data.product_um);
                                    $('#product-price-input').val(data.price);
                                    $('#product-currency-input').val(data.currency);
                                }
                            },
                            error: function () {
                                alert('Please try again later!');
                            }
                        });
                    }
                }
            });
            /* EOF autocomplete trigger */

            /* Add product on button click*/
            $('#add-product').on('click', function (e) {
                e.preventDefault();
                var popup = false;

                var product_id = $('.product-id-input').val(),
                    product_name = $('.product-name-input').val(),
                    product_qty = $('.product-qty-input').val(),
                    product_um = $('.product-um-input').val(),
                    product_price = $('.product-price-input').val();
                /*remove spaces*/
                product_qty_input = product_qty.replace(/\s/g, '');
                product_price_input = product_price.replace(/\s/g, '');
                if (product_name.length === 0) {
                    popup = true;
                    $('.messages').append('<span class="error-popup text-danger">Denumirea produsului/serviciului este obligatorie</span>');
                }
                if (product_um.length === 0) {
                    popup = true;
                    $('.messages').append('<span class="error-popup text-danger">Unitatea de masura este obligatorie!</span>');
                }
                if (product_qty.length === 0) {
                    popup = true;
                    $('.messages').append('<span class="error-popup text-danger">Cantitatea este obligatorie!</span>');
                }
                if (product_price.length === 0) {
                    popup = true;
                    $('.messages').append('<span class="error-popup text-danger">Pretul este obligatoriu!</span>');
                }

                if (popup == true) {
                    $.magnificPopup.open({
                        items: {
                            src: '#small-dialog6', // can be a HTML string, jQuery object, or CSS selector
                            type: 'inline',
                            fixedContentPos: false,
                            fixedBgPos: true,
                            overflowY: 'auto',
                            closeBtnInside: true,
                            preloader: false,
                            midClick: true,
                            removalDelay: 300,
                            mainClass: 'my-mfp-zoom-in'
                        }
                    });
                    $.magnificPopup.instance.close = function () {
                        $('.messages').empty();
                        $.magnificPopup.proto.close.call(this);
                    };
                } else {
                    var product_value = product_price_input * product_qty_input,
                        product_value = round(product_value, 2);
                    console.log(product_value);
                    total += product_value;
                    nr_crt++;
                    var row = '<tr class="rowItem-' + nr_crt + '"><td>' + nr_crt + '</td><td class="cell-product-name">'
                        + product_name +
                        '</td><td class="cell-product-um">'
                        + product_um +
                        '</td><td class="cell-product-qty">'
                        + product_qty + '' +
                        '</td><td class="cell-product-price">'
                        + product_price + '' +
                        '</td><td class="cell-product-value">'
                        + product_value.toFixed(2) +
                        '</td><td class="cell-product-opt">' +
                        '<ul>' +
                        '   <li class="dropdown opt-action">' +
                        '       <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' +
                        '           <i class="fa fa-angle-down lnr"></i><i class="fa fa-angle-up lnr"></i>' +
                        '           <div class="clearfix"></div></a>' +
                        '<ul class="dropdown-menu drp-mnu"> <li>' +
                        '<a id="edit-row" data-itemId="' + nr_crt + '">Edit</a></li>' +
                        '<li><a id="discount-row" data-itemId="' + nr_crt + '">Discount</a></li>' +
                        '<li><a id="delete-row" data-itemId="' + nr_crt + '">Delete</a></li></ul></li></ul>' +
                        '<input type="hidden" id="product_name_' + nr_crt + '" name="item_name[]" value="' + product_name.replace(/"/g, '&quot;') + '" /><input id="product_um_' + nr_crt + '" type="hidden" name="item_um[]" value="' + product_um + '" /><input type="hidden" name="item_qty[]" id="product_qty_' + nr_crt + '" value="' + product_qty_input + '" /><input type="hidden" name="item_price[]" id="product_price_' + nr_crt + '" value="' + product_price_input + '" /></td></tr>';
                    $('table#create-invoice tbody').append(row);

                    $('table#create-invoice tfoot #grand-total input').val(round(total, 2));
                    $('table#create-invoice tbody tr').each(function (idx) {
                        $(this).children().first().html(idx + 1);
                    });
                    $('#submit-button').html('<button class="btn btn-success" type="submit" id="submit-form"><i class="fa fa-floppy-o"></i> Salveaza</button>');
                    $('tfoot#product-info tr').first().find('input').val("");
                }
            });
            /* EOF add product on click*/

            /* Delete product from invoice*/
            $('body').on('click', '#delete-row', function () {
                var id = $(this).data('itemid'),
                    product_price = $('#product_price_' + id).val(),
                    product_qty = $('#product_qty_' + id).val(),
                    value = product_price * product_qty.replace(/\s/g, ''),
                    value = round(value, 2);
                total -= value;

                $('table#create-invoice tr.rowItem-' + id).remove();
                $('table#create-invoice tbody tr').each(function (idx) {
                    $(this).children().first().html(idx + 1);
                });
                $('table#create-invoice tfoot #grand-total input').val(round(total, 2));
            });
            /* EOF delete product*/

            /* round number */
            function round(value, exp) {
                if (typeof exp === 'undefined' || +exp === 0)
                    return Math.round(value);

                value = +value;
                exp = +exp;

                if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
                    return NaN;

                // Shift
                value = value.toString().split('e');
                value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

                // Shift back
                value = value.toString().split('e');
                return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
            }

            /* EOF Round numbers*/
        });
    </script>

@endsection