<div class="general-settings-content-border">
    <h4><i class="fas fa-info-circle"></i> Setari TVA</h4>
    <form action="{{ url('settings/add-vat') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-4">
            <div class="form-group
            @if ($errors->has('vat_name'))
                    has-error
@endif">
                <label for id="vat_name">Denumire cota </label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('vat_name') }}" name="vat_name"
                       placeholder="Denumire cota TVA" id="vat_name"/>
                @if ($errors->has('vat_name'))<span class="help-block">{{ $errors->first('vat_name') }}</span>@endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group
            @if ($errors->has('vat_procent'))
                    has-error
@endif">
                <label for id="vat_procent">Procent <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('vat_procent') }}"
                       name="vat_procent" placeholder="Procent TVA" id="vat_procent"/>
                @if ($errors->has('vat_procent'))<span
                        class="help-block">{{ $errors->first('vat_procent') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
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
                    <td>Denumire cota</td>
                    <td>Procent</td>
                    <td>Cota implicita</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @if(empty($vats))
                    echo "
                    <tr>
                        <td colspan='7'>Niciun rezultat!</td>
                    </tr>
                @else
                    @foreach ($vats as $index => $vat)
                        <tr class="row-{{ $index+1 }}">
                            <td>{{ $index+1}}</td>
                            <td>{{ $vat->vat_name }}</td>
                            <td>{{ $vat->vat_procent }}%</td>
                            <td align="center"><input type="radio" class="vat_default" value="{{ $vat->id }}"
                                                      name="vat_defaul" {{ $vat->default_vat==TRUE ? "checked" : "" }} >
                            </td>
                            <td><a class="sterge" data-form="document-vat-form-{{ $index+1 }}" href="#small-dialog"><i
                                            class="fas fa-trash"></i></a>
                                <form id="delete-vat-form" action="{{route('settings.destroy',$vat->id)}}"
                                      class="form-hidden document-vat-form-{{ $index+1 }}" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="type" value="vat">
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>