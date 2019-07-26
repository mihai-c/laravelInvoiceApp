@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/data-table/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/skins/all.css') }}">
@endsection

@section('content')
    <div class="inner-block">
        <div class="cols-grids">
            <h2>{{ $title }}
                <a href="{{ route('invoices.create') }}" class="hvr-icon-float-away pull-right popup-with-zoom-anim">Adauga</a>
            </h2>
            <div class="col-md-12 page-main">
                @include('errors.contenterrors')
				<?php //dd($errors->all());?>
                <div class="row">
                    <div class="dropdown dropdown-column pull-right">
                        <a href="#" title="" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog icon_8"></i> Coloane
                            <i class="fa fa-chevron-down icon_8"></i>
                            <div class="ripple-wrapper"></div>
                        </a>
                        <ul class="dropdown-menu float-right">
                            <li>
                                <label>
                                    <input type="checkbox" name="invoice_col_id" id="invoice_col_id" class="cols"
                                           value="0" data-column="0"> ID
                                </label>
                                <label>
                                    <input type="checkbox" name="invoice_col_name" id="invoice_col_name" class="cols"
                                           value="1" data-column="1" checked> Nr. factura
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" name="invoice_col_client" id="invoice_col_client"
                                           class="cols" value="2" data-column="2" checked> Client
                                </label>
                                <label>
                                    <input type="checkbox" name="invoice_col_amount" id="invoice_col_amount"
                                           class="cols" value="3" data-column="3" checked> Valoare
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="invoice_col_collected"
                                           id="invoice_col_collected" value="4" data-column="4"> Incasat
                                </label>
                                <label>
                                    <input type="checkbox" class="cols" name="invoice_col_rest" id="invoice_col_rest"
                                           value="5" data-column="5" checked> Rest de incasat
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="invoice_col_date" id="invoice_col_date"
                                           value="6" data-column="6" checked> Data emiterii
                                </label>
                                <label>
                                    <input type="checkbox" class="cols" name="invoice_col_term" id="invoice_col_term"
                                           value="7" data-column="7"> Data Scadentei
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="invoice_col_status"
                                           id="invoice_col_status" value="8" data-column="8"> Status
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="client-list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nr. factura</th>
                            <th>Client</th>
                            <th>Valoare</th>
                            <th>Incasat</th>
                            <th>Rest de incasat</th>
                            <th>Data emiterii</th>
                            <th>Data Scadentei</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $index => $invoice)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td><a href="{{ route('invoices.show',$invoice->id) }}">{{ $invoice->invoice_serial }}
                                        -{{ $invoice->invoice_number }}</a></td>
                                <td>{{ $invoice->client_name }} <br>
                                    <small>{{ $invoice->client_cif }}</small>
                                </td>
                                <td>{{ $invoice->invoice_total }}</td>
                                <td>NULL</td>
                                <td>NUll</td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->payment_date }}</td>
                                <td>{{ $invoice->status }}</td>
                                <td><a href="#small-dialog1" class="delete-invoice"><i class="fas fa-trash-alt"> </i>
                                    </a>
                                    <form id="delete-invoice-form" action="{{route('invoices.destroy',$invoice->id)}}"
                                          class="form-hidden" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nr. factura</th>
                            <th>Client</th>
                            <th>Valoare</th>
                            <th>Incasat</th>
                            <th>Rest de incasat</th>
                            <th>Data emiterii</th>
                            <th>Data Scadentei</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--pop-up-grid-->
    <div id="popup">
        <div class="clearfix"></div>
        <div id="small-dialog1" class="mfp-hide">
            <div class="pop_up">
                <div class="client_online-form-left delete-client-popup">
                    <h5><i class="fas fa-info-circle"></i> Sunteti sigur ca doriti stergerea acestei facturi?</h5>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <ul class="client-deletebtns">
                            <li>
                                <button type="submit" class="save" id="confirm-delete-invoice">Sunt de acord</button>
                            </li>
                            <li>
                                <button type="submit" class="btn-delete" id="close-delete-invoice">Anuleaza</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--pop-up-grid-->


@endsection
@section('scripts')
    <script src="{{ asset('vendor/data-table/datatables.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
@endsection
@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            if (sessionStorage.length > 0) {
                for (var i = 0, len = sessionStorage.length; i < len; i++) {
                    var key = sessionStorage.key(i);
                    $('#' + key).iCheck('check');
                }
            }
            var site_url = $(location).attr('protocol') + '//' + $(location).attr('hostname');
            $('input.cols').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red'
            }).on('ifToggled', function () {
                var val = $(this).data('column');
                var column = table.column(val);
                var name = $(this).attr('name');
                if (sessionStorage.getItem(name)) {
                    sessionStorage.removeItem(name);
                } else {
                    sessionStorage.setItem(name, 'true');
                }
                // Toggle the visibility
                column.visible(!column.visible());
            });
            var table = $("#client-list").DataTable({
                colReorder: true,
                //responsive: true,
                stateSave: true,
                lengthMenu: [
                    [20, 50, 100, -1],
                    ['20', '50', '100', 'Arata tot'],
                ],
                dom: "Bfrtip",
                columnDefs: [
                    {
                        targets: [0, 4, 7, 8],
                        "visible": false,
                        "searchable": false
                    }
                ],
                buttons: [
                    {
                        extend: "pageLength",
                        className: "btn-sm"
                    },
                    {
                        extend: "copy",
                        className: "btn-sm",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "csv",
                        className: "btn-sm",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm",
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function (doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn-sm",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "print",
                        className: "btn-sm",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
            });

            $('.delete-invoice').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
            $('#confirm-delete-invoice').on('click', function (e) {
                e.preventDefault();
                $('#delete-invoice-form').submit();
            });
            $('#close-delete-invoice').on("click", function () {
                $.magnificPopup.close();
            });
                @if(!empty($errors->all())){
                $.magnificPopup.open({
                    items: {
                        src: '#small-dialog', // can be a HTML string, jQuery object, or CSS selector
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
            }
            @endif
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

@endsection