<div class="client_online-form-left">
    <form method="post" enctype="multipart/form-data" action="{{ route('clients.update', $client->id) }}"
          id="client-form-add">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <h4><i class="fas fa-info-circle"></i> Informatii client</h4>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="form-group
        @if ($errors->has('cif'))
                    has-error
        @endif ">
                <div class="input-group">
                    <input class="form-control text-box-noradius cif-cnp" type="text" value="{{ $client->cif }}"
                           name="cif" id="cif" placeholder="CIF/CNP*"/>
                    <span class="input-group-addon"><a href="#" id="cif-cnp-info"><i
                                    class="fas fa-cloud-download-alt"></i></a></span>
                </div>
                @if ($errors->has('cif'))
                    <span class="help-block">{{ $errors->first('cif') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('client_id'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text"
                       value="{{ $client->code.str_pad($client->id,5,0,STR_PAD_LEFT) }} " name="client_id" readonly
                       placeholder="Cod Client"/>
                @if ($errors->has('client_id'))
                    <span class="help-block">{{ $errors->first('client_id') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('name'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->company }}" name="name"
                       id="denumire" required placeholder="Denumire*">
                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('reg'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->reg }}" name="reg" id="reg"
                       placeholder="Nr. Reg. Com (ex: JXX/XXXX/XXXX)">
                @if ($errors->has('reg'))
                    <span class="help-block">{{ $errors->first('reg') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('logo'))
                    has-error
            @endif ">
                <input id="f02" type="file" name="logo" placeholder="Adauga logo"/>
                <label for="f02">Adauga logo</label>
                @if ($errors->has('logo'))
                    @foreach ($errors->get('logo') as $message)
                        <span class="help-block">{{ $message }}</span>
                    @endforeach

                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="tva" value="1"
                           name="platitor_tva" {{ $client->attr_fiscal  ? 'checked' : '' }}> Platitor de TVA
                </label>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="form-group
            @if ($errors->has('address'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->address }}" name="address"
                       id="address" required placeholder="Adresa*">
                @if ($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('city'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->city }}" name="city"
                       id="city" required placeholder="Localitate*">
                @if ($errors->has('city'))
                    <span class="help-block">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('judet'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->judet }}" name="judet"
                       id="judet" required placeholder="Judet*">
                @if ($errors->has('judet'))
                    <span class="help-block">{{ $errors->first('judet') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('zip'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->zip }}" name="zip" id="zip"
                       placeholder="Cod Postal">
                @if ($errors->has('zip'))
                    <span class="help-block">{{ $errors->first('zip') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('country'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text"
                       value="{{ $client->country  ? $client->country : 'Romania' }}" required id="country"
                       name="country" placeholder="Tara">
                @if ($errors->has('country'))
                    <span class="help-block">{{ $errors->first('country') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="form-group
            @if ($errors->has('iban'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->iban }}" name="iban"
                       id="iban" placeholder="IBAN">
                @if ($errors->has('iban'))
                    <span class="help-block">{{ $errors->first('iban') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('banca'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->banca }}" name="banca"
                       id="banca" placeholder="Banca">
                @if ($errors->has('banca'))
                    <span class="help-block">{{ $errors->first('banca') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('contact'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->contact_person }}"
                       name="contact" id="contact" placeholder="Persoana Contact">
                @if ($errors->has('contact'))
                    <span class="help-block">{{ $errors->first('contact') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('phone'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->phone }}" name="phone"
                       id="phone" placeholder="Telefon">
                @if ($errors->has('phone'))
                    <span class="help-block">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group
            @if ($errors->has('email'))
                    has-error
            @endif ">
                <input class="form-control text-box-noradius" type="text" value="{{ $client->emails }}" name="email"
                       id="email" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
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