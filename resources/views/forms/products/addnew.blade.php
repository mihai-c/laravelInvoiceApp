<div class="client_online-form-left">
    <form method="post" action="{{ route('products.store') }}" id="product-form-add">
        {{ csrf_field() }}
        <h4><i class="fas fa-info-circle"></i> Informatii produs</h4>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group
                @if ($errors->has('sku'))
                    has-error
                @endif ">
                <input class="form-control text-box-noradius sku" type="text" value="{{ old('sku') }}" name="sku"
                       id="sku" placeholder="Cod Produs*"/>
                @if ($errors->has('sku'))
                    <span class="help-block">{{ $errors->first('sku') }}</span>
                @endif
            </div>
            <div class="form-group
                @if ($errors->has('name'))
                    has-error
                @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ old('name') }}" name="name"
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
                          placeholder="Descriere">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group
                @if ($errors->has('um'))
                    has-error
                @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ old('um') }}" name="um" id="um"
                       required placeholder="UM*">
                @if ($errors->has('um'))
                    <span class="help-block">{{ $errors->first('um') }}</span>
                @endif
            </div>
            <div class="form-group
                @if ($errors->has('price'))
                    has-error
                @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ old('price') }}" name="price"
                       id="price" required placeholder="Pret*">
                @if ($errors->has('price'))
                    <span class="help-block">{{ $errors->first('price') }}</span>
                @endif
            </div>
            <div class="form-group
                @if ($errors->has('currency'))
                    has-error
                @endif ">
                <select class="form-control text-box-noradius" name="currency" id="currency" required>
                    <option value="RON" {{ old('currency')=='RON' ? 'selected' : '' }}>RON</option>
                    <option value="USD" {{ old('currency')=='USD' ? 'selected' : '' }}>USD</option>
                    <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR</option>
                </select>
                @if ($errors->has('currency'))
                    <span class="help-block">{{ $errors->first('currency') }}</span>
                @endif
            </div>
            <div class="form-group
                @if ($errors->has('weight'))
                    has-error
                @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ old('weight') }}" name="weight"
                       id="weight" placeholder="Greutate in KG (ex:0.500)">
                @if ($errors->has('weight'))
                    <span class="help-block">{{ $errors->first('weight') }}</span>
                @endif
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <ul class="client-sendbtns">
                <li>
                    <button type="submit" class="save">Salveaza</button>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </form>
</div>