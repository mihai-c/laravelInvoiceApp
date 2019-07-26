@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-tabs/dist/css/bootstrap-responsive-tabs.css') }}">

@endsection
@section('content')
    <div class="inner-block">
        <div class="cols-grids general-settings">
            <h2>{{ $title }}</h2>
            <div class="col-md-12 general-settings-content  tab-content tab-content-in">
                <div class="msg-jquery"></div>
                @include('errors.contenterrors')
                <div class="row">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs responsive-tabs">
                            <li class="{{ $tab==NULL ? 'active' : '' }}"><a href="#tab_1" data-toggle="tab"
                                                                            aria-expanded="false">Cont</a></li>
                            <li class="{{ $tab=='company' ? 'active' : '' }}"><a href="#tab_2" data-toggle="tab"
                                                                                 aria-expanded="false">Firma</a></li>
                            <li class="{{ $tab=='documente' ? 'active' : '' }}"><a href="#tab_3" data-toggle="tab"
                                                                                   aria-expanded="false">Documente</a>
                            </li>
                            <li class="{{ $tab=='vat' ? 'active' : '' }}"><a href="#tab_4" data-toggle="tab"
                                                                             aria-expanded="false">TVA</a></li>
                            <li class="{{ $tab=='cont' ? 'active' : '' }}"><a href="#tab_5" data-toggle="tab"
                                                                              aria-expanded="false">Conturi</a></li>
                            <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Comenzi Online</a>
                            </li>
                            <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">Setari</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane {{ $tab == NULL ? 'active' : '' }}" id="tab_1">
                                @include('forms.settings.account')
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane {{ $tab=='company' ? 'active' : '' }}" id="tab_2">
                                @include('forms.settings.company')
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane {{ $tab=='documente' ? 'active' : '' }}" id="tab_3">
                                @include('forms.settings.documente')
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane {{ $tab=='vat' ? 'active' : '' }}" id="tab_4">
                                @include('forms.settings.vat')
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane {{ $tab=='cont' ? 'active' : '' }}" id="tab_5">
                                @include('forms.settings.bank')
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
        <div id="small-dialog1" class="mfp-hide">
            <div class="pop_up">
                <div class="password-confirmation-form">
                    <h4><i class="fas fa-info-circle"></i> Confirma parola</h4>
                    <div class="col-md-12">
                        <div class="form-group
                        @if ($errors->has('cif'))
                                has-error
@endif">
                            <input type="password" name="password" class="form-control password" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="client-sendbtns">
                            <li>
                                <button type="submit" class="password-confirmation password-confirmation-btn">Confirma
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="small-dialog" class="mfp-hide">
                <div class="pop_up">
                    <div class="client_online-form-left delete-client-popup">
                        <h5><i class="fas fa-info-circle"></i> Sunteti sigur ca doriti stergerea acestui element?</h5>
                        <div class="clearfix"></div>
                        <div class="form-id">
                        </div>
                        <div class="col-md-12">
                            <ul class="client-deletebtns">
                                <li>
                                    <button type="submit" class="save confirm-delete" id="confirm-delete">Sunt de
                                        acord
                                    </button>
                                </li>
                                <li>
                                    <button type="submit" class="btn-delete" id="close-delete">Anuleaza</button>
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
        @endsection
        @section('scripts')
            <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap-tabs/dist/js/jquery.bootstrap-responsive-tabs.min.js') }}"></script>
            <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
            <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
        @endsection
        @section('js_scripts')
            <script type="text/javascript">
                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
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

                    $('input[type=checkbox].cont_default').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    }).on('ifToggled', function (event) {
                        var status;
                        var id = $(this).data('id');
                        if ($(this).is(':checked')) {
                            status = 'yes';
                        } else {
                            status = 'no';
                        }

                        $.ajax({
                            type: "POST",
                            url: "/settings/update-account",
                            data: {status: status, id: id},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    if (data.error === true) {
                                        alert(data.message);
                                    } else if (data.success === true) {
                                        $('.msg-jquery').append('<p class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.message + '</p>');
                                    }
                                },
                            error: function () {
                                alert("Eroare. Va rugam sa reincercati!");
                            }
                        });
                    });

                    $('.sterge').magnificPopup({
                        type: 'inline',
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                            open: function () {
                                var magnificPopup = $.magnificPopup.instance,
                                    cur = magnificPopup.st.el;
                                $('.form-id').attr('id', cur.attr('data-form'));
                            }
                        }
                    });

                    $('.confirm-delete').on('click', function (e) {
                        e.preventDefault();
                        var form_to_submit = $('.form-id').attr('id');
                        $('.' + form_to_submit).submit();
                    });
                    $('#close-delete').on("click", function () {
                        $.magnificPopup.close();
                    });

                    $('.select-tip').select2({
                        placeholder: "Tip document",
                        width: '100%'
                    });

                    $('input[type=radio].doc_default').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    }).on('ifChecked', function () {
                        var id = $(this).val(),
                            tip = $(this).data('tip');
                        $.ajax({
                            type: "POST",
                            url: "/settings/update-default-doc",
                            data: {id: id, tip: tip},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    $('.msg-jquery').append('<p class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Seria implicita pentru ' + tip.substr(0, 1).toUpperCase() + tip.substr(1) + ' a fost modificata!</p>');
                                },
                            error: function () {
                                alert("Eroare. Va rugam sa reincercati!");
                            }
                        });
                    });

                    $('.sterge-serie').on('click', function (event) {
                        event.preventDefault();

                        var row = $(this).data('row');
                        var id = $(this).data('id');
                        var serie = $(this).data('serie');
                        $.ajax({
                            type: "POST",
                            url: "/settings/delete-config-doc",
                            data: {id: id},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    $('table#doc-config tbody tr.row-' + row).remove();
                                    $('table#doc-config tbody tr').each(function (idx) {
                                        $(this).children().first().html(idx + 1);
                                    });
                                    $('.msg-jquery').append('<p class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Seria ' + serie + ' a fost stearsa!</p>');
                                },
                            error: function () {
                                alert("Eroare. Va rugam sa reincercati!");
                            }
                        });

                    });

                    $('input[type=radio].vat_default').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    }).on('ifChecked', function () {
                        var id = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "/settings/update-config-default-vat",
                            data: {id: id},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    $('.msg-jquery').append('<p class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Cota implicita a fost modificata!</p>');
                                },
                            error: function () {
                                alert("Eroare. Va rugam sa reincercati!");
                            }
                        });
                    });

                });
            </script>
@endsection