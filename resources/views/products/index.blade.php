@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/data-table/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
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
                <div class="table-responsive">
                    <table id="product-list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cod produs</th>
                            <th>Denumire</th>
                            <th>Pret</th>
                            <th>U.M.</th>
                            <th>Moneda</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td><a href="{{ route('products.show',$product->id) }}">{{ $product->sku }}</a></td>
                                <td>{{ $product->product_name }} </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->product_um }}</td>
                                <td>{{ $product->currency }}</td>
                                <td><a href="#small-dialog1" class="delete-product"><i class="fas fa-trash-alt"> </i>
                                    </a>
                                    <form id="delete-product-form" action="{{route('products.destroy',$product->id)}}"
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
                            <th>Cod produs</th>
                            <th>Denumire</th>
                            <th>Pret</th>
                            <th>U.M.</th>
                            <th>Moneda</th>
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
                @include('forms.products.addnew')
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div id="small-dialog1" class="mfp-hide">
            <div class="pop_up">
                <div class="client_online-form-left delete-client-popup">
                    <h5><i class="fas fa-info-circle"></i> Sunteti sigur ca doriti stergerea acestei facturi?</h5>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <ul class="client-deletebtns">
                            <li>
                                <button type="submit" class="save" id="confirm-delete-product">Sunt de acord</button>
                            </li>
                            <li>
                                <button type="submit" class="btn-delete" id="close-delete-product">Anuleaza</button>
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
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
@endsection
@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#currency').select2({
                placeholder: "Moneda",
                width: '100%'
            });
            $("#product-list").DataTable({
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
                ],
            });

            $('.delete-product').magnificPopup({
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

            $('#confirm-delete-product').on('click', function (e) {
                e.preventDefault();
                $('#delete-product-form').submit();
            });

            $('#close-delete-product').on("click", function () {
                $.magnificPopup.close();
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
                mainClass: 'my-mfp-zoom-in',
                focus: '.select2-search__field',
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
        });
    </script>

@endsection