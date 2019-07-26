<div class="general-settings-content-border">
    <h4><i class="fas fa-info-circle"></i> Setari firma</h4>
    <form method="post" action="{{ url('/settings/update-company') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="form-group
            @if ($errors->has('company'))
                    has-error
@endif">
                <label for id="company">Denumire companie <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('company')->config_value ? Settings::get_value('company')->config_value : old('company')}}"
                       name="company" placeholder="Denumire companie" id="company"/>
                @if ($errors->has('company'))<span class="help-block">{{ $errors->first('company') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('cif'))
                    has-error
@endif">
                <label for id="cif">CUI <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('cif')->config_value ? Settings::get_value('cif')->config_value : old('cif') }}"
                       name="cif" placeholder="CUI/CIF" id="cif"/>
                @if ($errors->has('cif'))<span class="help-block">{{ $errors->first('cif') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('reg'))
                    has-error
@endif">
                <label for id="reg">Nr. Reg. Com <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('reg')->config_value ? Settings::get_value('reg')->config_value : old('reg') }}"
                       name="reg" placeholder="Nr. Reg. Com." id="reg"/>
                @if ($errors->has('reg'))<span class="help-block">{{ $errors->first('reg') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('address'))
                    has-error
@endif">
                <label for id="address">Adresa <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('address')->config_value ? Settings::get_value('address')->config_value : old('address') }}"
                       name="address" placeholder="Adresa" id="address"/>
                @if ($errors->has('address'))<span class="help-block">{{ $errors->first('address') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('city'))
                    has-error
@endif">
                <label for id="city">Oras <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('city')->config_value ? Settings::get_value('city')->config_value : old('city') }}"
                       name="city" placeholder="Localitate" id="city"/>
                @if ($errors->has('city'))<span class="help-block">{{ $errors->first('city') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('judet'))
                    has-error
@endif">
                <label for id="judet">Judet <em>*</em></label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('judet')->config_value ? Settings::get_value('judet')->config_value : old('judet') }}"
                       name="judet" placeholder="Judet" id="judet"/>
                @if ($errors->has('judet'))<span class="help-block">{{ $errors->first('judet') }}</span>@endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group
            @if ($errors->has('iban'))
                    has-error
@endif">
                <label for id="iban">IBAN </label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('iban')->config_value ? Settings::get_value('iban')->config_value : old('iban') }}"
                       name="iban" placeholder="IBAN" id="iban"/>
                @if ($errors->has('iban'))<span class="help-block">{{ $errors->first('iban') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('banca'))
                    has-error
@endif">
                <label for id="banca">Banca </label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('banca')->config_value ? Settings::get_value('banca')->config_value : old('banca') }}"
                       name="banca" placeholder="Banca" id="banca"/>
                @if ($errors->has('banca'))<span class="help-block">{{ $errors->first('banca') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('email'))
                    has-error
@endif">
                <label for id="email">Email </label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('email')->config_value ? Settings::get_value('email')->config_value : old('email') }}"
                       name="email" placeholder="Email" id="email"/>
                @if ($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('capital'))
                    has-error
@endif">
                <label for id="capital">Capital Social </label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('capital')->config_value ? Settings::get_value('capital')->config_value : old('capital') }}"
                       name="capital" placeholder="Capital Social" id="capital"/>
                @if ($errors->has('capital'))<span class="help-block">{{ $errors->first('capital') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('web'))
                    has-error
@endif">
                <label for id="web">Adresa web </label>
                <input class="form-control text-box-noradius" type="text"
                       value="{{  Settings::get_value('web')->config_value ? Settings::get_value('web')->config_value : old('web') }}"
                       name="web" placeholder="Adresa web" id="web"/>
                @if ($errors->has('web'))<span class="help-block">{{ $errors->first('web') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('logo'))
                    has-error
@endif">
                <input id="f02" type="file" name="logo"
                       placeholder="{{  Settings::get_value('logo')->config_value ? 'Schimba logo' : 'Adauga logo' }}"/>
                <label for="f02">{{  Settings::get_value('logo')->config_value ? 'Schimba logo' : 'Adauga logo' }}</label>
                <span class="pull-right">
                @if(!is_null(Settings::get_value('logo')->config_value))
                        <img src="../media/company/{{ Settings::get_value('logo')->config_value }}"
                             class="img-responsive" style="max-width:200px;">
                    @endif
            </span>
                @if ($errors->has('logo'))
                    @foreach ($errors->get('logo') as $message)
                        <span class="help-block">{{ $message }}</span>
                    @endforeach

                @endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <ul class="client-sendbtns">
                <li>
                    <button type="submit" class="save-btn">Salveaza</button>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="clearfix"></div>
</div>