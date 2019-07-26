@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/data-table/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endsection

@section('content')
    <div class="inner-block">
        <div class="cols-grids">
            <h2>{{ $title }}
                <a href="{{ URL::previous() }}" class="hvr-icon-float-away pull-right popup-with-zoom-anim">Inapoi</a>
            </h2>
            <div class="col-md-12 page-main product">
                @include('errors.contenterrors')
				<?php //dd($errors->all());?>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                        <div class="product-info">
                            <div class="product-profile">
                                <div class="product-pic">
                                    @if(!is_null($product->default_img))
                                        <img src="/media/products/{{ $product->id }}/{{ $product->default_img }}"
                                             class="img-responsive" style="max-height: 200px;"/>
                                    @else
                                        <img src="/media/products/noimg.png" class="img-responsive"
                                             style="max-height: 200px;"/>
                                    @endif
                                </div>
                                <div class="product-name">
                                    <h5><a href="#">{{ $product->product_name }}</a></h5>
                                    <h6><a>Vanzari: x {{ $product->product_um }}</a></h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="product-bottom">
                                <nav class="nav-sidebar">
                                    <ul class="nav tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab"><i class="fas fa-info"></i>
                                                Informatii Standard</a></li>
                                        <li class=""><a href="#tab2" data-toggle="tab"><i
                                                        class="fas fa-info-circle"></i> Informatii Avansate</a></li>
                                        <li class=""><a href="#tab3" data-toggle="tab"><i class="fas fa-images"></i>
                                                Galerie</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12  tab-content tab-content-in user-marorm">
                        <div class="tab-pane active text-style" id="tab1">
                            <form method="post" action="{{ route('products.update',$product->id) }}"
                                  id="product-form-edit">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <h4><i class="fas fa-info-circle"></i> Informatii produs</h4>
                                <div class="form-group
                                    @if ($errors->has('sku'))
                                        has-error
                                    @endif ">
                                    <input class="form-control text-box-noradius sku" type="text"
                                           value="{{ $product->sku }}" name="sku" id="sku" placeholder="Cod Produs*"/>
                                    @if ($errors->has('sku'))
                                        <span class="help-block">{{ $errors->first('sku') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                    @if ($errors->has('name'))
                                        has-error
                                    @endif ">
                                    <input class="form-control text-box-noradius" type="text"
                                           value="{{ $product->product_name }}" name="name"
                                           placeholder="Denumire Produs*"/>
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                    @if ($errors->has('description'))
                                        has-error
                                    @endif ">
                                    <textarea class="form-control text-box-noradius" name="description" id="description"
                                              placeholder="Descriere">{{ $product->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                @if ($errors->has('um'))
                                        has-error
@endif ">
                                    <input class="form-control text-box-noradius" type="text"
                                           value="{{ $product->product_um }}" name="um" id="um" required
                                           placeholder="UM*">
                                    @if ($errors->has('um'))
                                        <span class="help-block">{{ $errors->first('um') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                    @if ($errors->has('price'))
                                        has-error
                                    @endif ">
                                    <input class="form-control text-box-noradius" type="text"
                                           value="{{ $product->price }}" name="price" id="price" required
                                           placeholder="Pret*">
                                    @if ($errors->has('price'))
                                        <span class="help-block">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                    @if ($errors->has('currency'))
                                        has-error
                                    @endif ">
                                    <select class="form-control text-box-noradius" name="currency" id="currency"
                                            required>
                                        <option value="RON" {{ $product->currency=='RON' ? 'selected' : '' }}>RON
                                        </option>
                                        <option value="USD" {{ $product->currency=='USD' ? 'selected' : '' }}>USD
                                        </option>
                                        <option value="EUR" {{ $product->currency=='EUR' ? 'selected' : '' }}>EUR
                                        </option>
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="help-block">{{ $errors->first('currency') }}</span>
                                    @endif
                                </div>
                                <div class="form-group
                                    @if ($errors->has('weight'))
                                        has-error
                                    @endif ">
                                    <input class="form-control text-box-noradius" type="text"
                                           value="{{ $product->weight }}" name="weight" id="weight"
                                           placeholder="Greutate in KG (ex:0.500)">
                                    @if ($errors->has('weight'))
                                        <span class="help-block">{{ $errors->first('weight') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <ul class="client-sendbtns">
                                        <li>
                                            <button type="submit" class="save-btn">Salveaza</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="tab-pane text-style" id="tab2">
                            test2
                        </div>
                        <div class="tab-pane text-style" id="tab3">
                            <h4><i class="fas fa-image"></i> Galerie</h4>
                            <div class="images">
                                @foreach($product->images as $image)
                                    <div class="image">
                                        <a href="/media/products/{{ $product->id }}/{{ $image->file_name }}"
                                           data-fancybox="gallery">
                                            <img src="/media/products/{{ $product->id }}/thumbs/{{ $image->file_name }}"
                                                 class="img-responsive"/>
                                        </a>
                                        <span>@if($image->file_name == $product->default_img)
                                                <a class="default-img" title="Default image"><i
                                                            class="fas fa-check"></i></a>
                                            @else
                                                <a class="set-default-img" href="#" data-image="{{ $image->id }}"
                                                   title="Set default image"><i class="fas fa-check"></i></a>
                                            @endif
                                            <a href="#" data-image="{{ $image->id }}" class="delete" title="Delete"><i
                                                        class="fas fa-trash-alt"></i></a> </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                            <form method="post" action="{{ url('products/addimages') }}" enctype="multipart/form-data"
                                  class="dropzone"
                                  id="productDropzone">
                                {{ csrf_field() }}
                                <div class="fallback">
                                    <input name="file" type="file" multiple/>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--pop-up-grid-->



@endsection
@section('scripts')
    {{--<script src="{{ asset('vendor/data-table/datatables.js') }}"></script>--}}

    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    {{--<script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>--}}
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
@section('js_scripts')
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function ($) {
            $('#currency').select2({
                placeholder: "Moneda",
                width: '100%'
            });
            $('[data-fancybox]').fancybox();

            var max_files = 6 - {{ count($product->images) }};
            var myDropzone = new Dropzone("#productDropzone", {
                maxFiles: max_files,
                maxFilesize: 2,
                uploadMultiple: false,
                acceptedFiles: '.jpg,.jpeg,.png,.gif',
                timeout: 10000,

            });

            $('a.delete').on('click', function (e) {
                e.preventDefault();
                var thisparent = $(this).closest('.image');
                if (confirm('Sunteti sigur ca doriti stergerea acestei imagini?') == true) {
                    var image = $(this).data('image');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "/delete-image-product",
                        data: {image_id: image},
                        dataType: "json",
                        cache: false,
                        success:
                            function (data) {
                                if (data.success == true) {
                                    $(thisparent).remove();
                                    max_files = 6 - data.images;
                                    myDropzone.options.maxFiles = max_files;
                                }
                            },
                        error: function () {
                            alert('Please try again later!');
                        }
                    });
                }
            });

            $('a.set-default-img').on('click', function (ev) {
                ev.preventDefault();
                var image = $(this).data('image'),
                    thisdiv = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/set-default-image-product",
                    data: {image_id: image},
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        if (data.success == true) {
                            $('.product-pic img').attr('src', '/media/products/{{ $product->id }}/' + data.new_img);
                            $('a.default-img').addClass('set-default-img').removeClass('default-img');
                            thisdiv.removeClass('set-default-img');
                            thisdiv.removeAttr('href');
                            thisdiv.addClass('default-img');
                        }
                    },
                    error: function () {
                        alert('Please try again later');
                    }
                });
            })
        });
    </script>

@endsection