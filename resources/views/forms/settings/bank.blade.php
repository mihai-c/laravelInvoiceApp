<div class="general-settings-content-border">
    <h4><i class="fas fa-info-circle"></i> Setari conturi bancare</h4>
    <form method="post" action="{{ url('settings/add-accounts') }}">
        {{ csrf_field() }}
        <div class="col-md-3">
            <div class="form-group
            @if ($errors->has('iban_cont'))
                    has-error
@endif">
                <label for id="iban_cont">Iban <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('iban_cont') }}"
                       name="iban_cont" placeholder="Iban" id="iban_cont"/>
                @if ($errors->has('iban_cont'))<span class="help-block">{{ $errors->first('iban_cont') }}</span>@endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group
            @if ($errors->has('banca_cont'))
                    has-error
@endif">
                <label for id="banca">Banca <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('banca_cont') }}"
                       name="banca_cont" placeholder="Banca" id="banca_cont"/>
                @if ($errors->has('banca_cont'))<span class="help-block">{{ $errors->first('banca_cont') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('currency'))
                    has-error
@endif">
                <label for id="currency">Moneda <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('currency') }}" name="currency"
                       placeholder="Moneda" id="currency"/>
                @if ($errors->has('currency'))<span class="help-block">{{ $errors->first('currency') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('swift'))
                    has-error
@endif">
                <label for id="swift">SWIFT </label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('swift') }}" name="swift"
                       placeholder="Swift" id="swift"/>
                @if ($errors->has('swift'))<span class="help-block">{{ $errors->first('swift') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <ul class="client-sendbtns">
                <li>
                    <button type="submit" class="save-btn">Salveaza</button>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </form>
    <hr>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="vat-config">
                <thead>
                <tr>
                    <td>Nr.crt.</td>
                    <td>IBAN</td>
                    <td>Banca</td>
                    <td>Moneda</td>
                    <td>Folosit</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach ($conturi as  $i => $cont)
                    <tr class="row-{{ $i }}">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $cont->iban }}</td>
                        <td>{{ $cont->banca }}</td>
                        <td>{{ $cont->moneda }}</td>
                        <td align="center"><input type="checkbox" data-id="{{ $cont->id }}" class="cont_default"
                                                  value="{{ $cont->id }}"
                                                  name="vat_default" {{ $cont->used==TRUE ? "checked" : "" }} ></td>
                        <td><a class="sterge" href="#small-dialog" data-form="delete-account-form-{{ $i+1 }}"><i
                                        class="fas fa-trash"></i></a>
                            <form id="delete-account-form" action="{{route('settings.destroy',$cont->id)}}"
                                  class="form-hidden delete-account-form-{{ $i+1 }}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="type" value="account">
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>