@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-tabs/dist/css/bootstrap-responsive-tabs.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/data-table/datatables.css') }}">
@endsection

@section('content')
    <div class="inner-block">
        <div class="client">
            <h2>{{ $title }}</h2>
            <div class="col-md-12 client-content  tab-content tab-content-in">
                @include('errors.contenterrors')
                <div class="row">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs responsive-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Profil</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Facturi</a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Proforme</a></li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Avize</a></li>
                            <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Incasari</a></li>
                            <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Comenzi Online</a>
                            </li>
                            <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">Setari</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="client-content-border">
                                    <h4><i class="fas fa-info-circle"></i> Informatii client</h4>
                                    <div class="col-md-3">
                                        <div class="client-pic">
                                            @if(!is_null($client->logo))
                                                <img src="/media/clients/{{ $client->logo }}" class="img-responsive"/>
                                            @else
                                                <img src="/media/images/no-user.png" class="img-responsive"/>
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="client-edit"><a href="#small-dialog"
                                                                    class="hvr-icon-float-away  popup-with-zoom-anim"><i
                                                        class="fas fa-pencil-alt"></i> Editeaza</a> | <a
                                                    href="#small-dialog1" class="hvr-icon-float-away  delete-client"><i
                                                        class="fas fa-trash-alt"></i> Sterge</a>
                                            <form id="delete-client-form"
                                                  action="{{route('clients.destroy',$client->id)}}" class="form-hidden"
                                                  method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="client-info">
                                            <tr>
                                                <td>Denumire</td>
                                                <td>:</td>
                                                <td>{{ $client->company }}</td>
                                            </tr>
                                            <tr>
                                                <td>CIF/CNP</td>
                                                <td>:</td>
                                                <td>{{ $client->attr_fiscal }}{{ $client->cif }}</td>
                                            </tr>
                                            <tr>
                                                <td>Reg. Com.</td>
                                                <td>:</td>
                                                <td>{{ $client->reg }}</td>
                                            </tr>
                                            <tr>
                                                <td>Adresa</td>
                                                <td>:</td>
                                                <td>{{ $client->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Judet</td>
                                                <td>:</td>
                                                <td>{{ $client->judet }}</td>
                                            </tr>
                                            <tr>
                                                <td>Cod Postal</td>
                                                <td>:</td>
                                                <td>{{ $client->zip }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tara</td>
                                                <td>:</td>
                                                <td>{{ $client->country }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-5">
                                        <table class="client-info">
                                            <tr>
                                                <td>Cod Client</td>
                                                <td>:</td>
                                                <td>{{ $client->code }}{{ str_pad($client->id,5,0,STR_PAD_LEFT) }}</td>
                                            </tr>
                                            <tr>
                                                <td>IBAN</td>
                                                <td>:</td>
                                                <td>{{ $client->iban }}</td>
                                            </tr>
                                            <tr>
                                                <td>Banca</td>
                                                <td>:</td>
                                                <td>{{ $client->banca }}</td>
                                            </tr>
                                            <tr>
                                                <td>Persoana contact</td>
                                                <td>:</td>
                                                <td>{{ $client->contact_person }}</td>
                                            </tr>
                                            <tr>
                                                <td>Telefon</td>
                                                <td>:</td>
                                                <td>{{ $client->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>{{ $client->email }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><i class="fab fa-autoprefixer"></i> Optiuni avansate</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="table-responsive">
                                    <table id="invoice-client-list" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nr. Factura</th>
                                            <th>Data</th>
                                            <th>Scadenta</th>
                                            <th>Valoare</th>
                                            <th>Incasat</th>
                                            <th>Rest de Incasat</th>
                                        </tr>
                                        <tbody>
                                        @foreach($client->invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->invoice_serial }}-{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->invoice_date }}</td>
                                                <td>{{ $invoice->payment_date }}</td>
                                                <td>{{ $invoice->invoice_total }}</td>
                                                <td>NULL</td>
                                                <td>NULL</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen
                                book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software
                                like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!--pop-up-grid-->
    <div id="popup">
        <div id="small-dialog" class="mfp-hide">
            <div class="pop_up">
                @include('forms.clients.edit')
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div id="small-dialog1" class="mfp-hide">
            <div class="pop_up">
                <div class="client_online-form-left delete-client-popup">
                    <h5><i class="fas fa-info-circle"></i> Sunteti sigur ca doriti stergerea acestui client?</h5>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <ul class="client-deletebtns">
                            <li>
                                <button type="submit" class="save" id="confirm-delete-client">Sunt de acord</button>
                            </li>
                            <li>
                                <button type="submit" class="btn-delete" id="close-delete-client">Anuleaza</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--pop-up-grid-->
@endsection
@section('scripts')
    <script src="{{ asset('vendor/data-table/datatables.js') }}"></script>
    <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-tabs/dist/js/jquery.bootstrap-responsive-tabs.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
@endsection
@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red'
            });

            $('.responsive-tabs').responsiveTabs({
                accordionOn: ['xs', 'sm'] // xs, sm, md, lg
            });
            $('.popup-with-zoom-anim').magnificPopup({
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

            $('.delete-client').magnificPopup({
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
            $('#confirm-delete-client').on('click', function (e) {
                e.preventDefault();
                $('#delete-client-form').submit();
            });
            $('#close-delete-client').on("click", function () {
                $.magnificPopup.close();
            });

            $("[type=file]").on("change", function () {
                // Name of file and placeholder
                var file = this.files[0].name;
                var dflt = $(this).attr("placeholder");
                if ($(this).val() != "") {
                    $(this).next().text(file);
                } else {
                    $(this).next().text(dflt);
                }
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
            $('#invoice-client-list').DataTable({
                colReorder: true,
                //responsive: true,
                stateSave: true,
                lengthMenu: [
                    [20, 50, 100, -1],
                    ['20', '50', '100', 'Arata tot'],
                ],
                dom: "Bfrtip",
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
                ]
            });
        });
    </script>
@endsection