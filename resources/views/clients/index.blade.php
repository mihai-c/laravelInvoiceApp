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
                <a href="#small-dialog" class="hvr-icon-float-away pull-right popup-with-zoom-anim">Adauga</a>
            </h2>
            <div class="col-md-12 page-main">
                @include('errors.contenterrors')
				<?php //dd($errors->all());?>
                {{-- @foreach($errors->all() as $items)
                     {{ $items }}
                     @endforeach--}}
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
                                    <input type="checkbox" name="col_id" id="col_id" class="cols" value="0"
                                           data-column="0"> ID
                                </label>
                                <label>
                                    <input type="checkbox" name="col_name" id="col_name" class="cols" value="1"
                                           data-column="1" checked> Denumire
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" name="col_cif" id="col_cif" class="cols" value="2"
                                           data-column="2" checked> CIF/CNP
                                </label>
                                <label>
                                    <input type="checkbox" name="col_reg" id="col_reg" class="cols" value="3"
                                           data-column="3"> Nr. Reg.Com
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="col_city" id="col_city" value="4"
                                           data-column="4" checked> Localitate
                                </label>
                                <label>
                                    <input type="checkbox" class="cols" name="col_judet" id="col_judet" value="5"
                                           data-column="5"> Judet
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="col_iban" id="col_iban" value="6"
                                           data-column="6"> Iban
                                </label>
                                <label>
                                    <input type="checkbox" class="cols" name="col_phone" id="col_phone" value="7"
                                           data-column="7" checked> Telefon
                                </label>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <label>
                                    <input type="checkbox" class="cols" name="col_contact" id="col_contact" value="8"
                                           data-column="8"> Contact
                                </label>
                                <label>
                                    <input type="checkbox" class="cols" name="col_sold" id="col_sold" value="9"
                                           data-column="9"> Sold
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
                            <th>Denumire</th>
                            <th>CIF/CNP</th>
                            <th>Nr.Reg.Com</th>
                            <th>Localitate</th>
                            <th>Judet</th>
                            <th>IBAN</th>
                            <th>Telefon</th>
                            <th>Persoana de contact</th>
                            <th>Sold</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $index => $client)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td><a href="/clients/{{ $client->id }}">{{ $client->company }}</a></td>
                                <td>{{ $client->attr_fiscal }} {{ $client->cif }}</td>
                                <td>{{ $client->reg }}</td>
                                <td>{{ $client->city }}</td>
                                <td>{{ $client->judet }}</td>
                                <td>{{ $client->iban }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->contact_person }}</td>
                                <td></td>
                                <td><a href="#small-dialog1" class="delete-client"><i class="fas fa-trash-alt"> </i>
                                    </a>
                                    <form id="delete-client-form" action="{{route('clients.destroy',$client->id)}}"
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
                            <th>Denumire</th>
                            <th>CIF/CNP</th>
                            <th>Nr.Reg.Com</th>
                            <th>Localitate</th>
                            <th>Judet</th>
                            <th>IBAN</th>
                            <th>Telefon</th>
                            <th>Persoana de contact</th>
                            <th>Sold</th>
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
        <div id="small-dialog" class="mfp-hide">
            <div class="pop_up">
                @include('forms.clients.addnew')
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
            $('input#tva').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red'
            });
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
                        targets: [0, 3, 5, 6, 8, 9],
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

            $('#cif-cnp-info').click(function (e) {
                e.preventDefault();
                var cif_cnp = $('.cif-cnp').val();
                if (!cif_cnp) {
                    alert('Campul CIF/CNP este obligatoriu!');
                } else {
                    if (cif_cnp.length < 6) {
                        alert('Campul CIF/CNP trebuie sa contina minim 6 caractere!');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: site_url + "/get-client-details",
                            data: {cif_cnp: cif_cnp},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    if (data.error === true) {
                                        alert(data.message);
                                    } else {
                                        var city = data.adresa;
                                        var n = city.lastIndexOf(',');
                                        var result = city.substring(n + 1);
                                        $('#cif-cnp').val(data.cif);
                                        $('#denumire').val(data.denumire);
                                        $('#reg').val(data.numar_reg_com);
                                        $('#phone').val(data.telefon);
                                        $('#address').val(data.adresa);
                                        $('#judet').val(data.judet);
                                        $('#city').val(result);
                                        $('#zip').val(data.cod_postal);

                                        if (data.tva) {
                                            $('#tva').iCheck('check');
                                        } else {
                                            $('#tva').iCheck('uncheck');
                                        }
                                    }
                                },
                            error: function () {
                                alert("Eroare! Va rugam sa incercati din nou!");
                            }
                        });
                    }
                }
            });
        });
    </script>

@endsection