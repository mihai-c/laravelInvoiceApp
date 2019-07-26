<div class="general-settings-content-border">
    <h4><i class="fas fa-info-circle"></i> Setari documente</h4>
    <form method="post" action="{{ url('settings/add-docs') }}">
        {{ csrf_field() }}
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('tip_doc'))
                    has-error
@endif">
                <label for id="tip_doc">Tip document </label>
                <select name="tip_doc" class="form-control text-box-noradius select-tip">
                    <option value="factura" {{ old('tip_doc') == 'factura' ? 'selected' : '' }}>Factura</option>
                    <option value="proforma" {{ old('tip_doc') == 'proforma' ? 'selected' : '' }}>Proforma</option>
                    <option value="aviz" {{ old('tip_doc') == 'aviz' ? 'selected' : '' }}>Aviz</option>
                    <option value="chitanta" {{ old('tip_doc') == 'chitanta' ? 'selected' : '' }}>Chitanta</option>
                </select>
                @if ($errors->has('tip_doc'))<span class="help-block">{{ $errors->first('tip_doc') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('serie'))
                    has-error
@endif">
                <label for id="serie">Serie </label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('serie') }}" name="serie"
                       placeholder="Serie" id="serie"/>
                @if ($errors->has('serie'))<span class="help-block">{{ $errors->first('serie') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('numar_document'))
                    has-error
@endif">
                <label for id="numar_document">Numar de inceput </label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('numar_document') }}"
                       name="numar_document" placeholder="Numar de inceput" id="numar_document"/>
                @if ($errors->has('numar_document'))<span
                        class="help-block">{{ $errors->first('numar_document') }}</span>@endif
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group
            @if ($errors->has('descriere'))
                    has-error
@endif">
                <label for id="descriere">Descriere </label>
                <input class="form-control text-box-noradius" type="text" value="{{ old('descriere') }}"
                       name="descriere" placeholder="Descriere" id="descriere"/>
                @if ($errors->has('descriere'))<span class="help-block">{{ $errors->first('descriere') }}</span>@endif
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
            <table class="table table-bordered table-hover" id="doc-config">
                <thead>
                <tr>
                    <td>Nr.crt.</td>
                    <td>Tip document</td>
                    <td>Serie</td>
                    <td>Numar de inceput</td>
                    <td>Serie implicita</td>
                    <td>Descriere</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @if(empty($documents))
                    <tr>
                        <td colspan='7'>Niciun rezultat!</td>
                    </tr> ";
                @else
                    @foreach ($documents as $key =>$document)
                        <tr class="row-{{  $key+1 }}">
                            <td>{{  $key+1 }}</td>
                            <td>{{  ucfirst($document->tip_document) }}</td>
                            <td>{{  $document->serie_document }}</td>
                            <td>{{  $document->numar_document }}</td>
                            <td align="center"><input type="radio" data-tip="{{  $document->tip_document }}"
                                                      data-status="{{  $document->default_document }}"
                                                      class="doc_default" value="{{  $document->id }}"
                                                      name="{{  $document->tip_document }}" {{  $document->default_document==TRUE ? "checked" : "" }} >
                            </td>
                            <td>{{  $document->descriere }}</td>
                            <td><a href="#small-dialog" class="sterge" data-form="document-account-form-{{ $key+1 }}"
                                   href="#"><i class="fas fa-trash"></i></a>
                                <form id="delete-account-form" action="{{route('settings.destroy',$document->id)}}"
                                      class="form-hidden document-account-form-{{ $key+1 }}" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="type" value="document">
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