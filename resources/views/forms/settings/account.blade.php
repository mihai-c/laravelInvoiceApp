<div class="general-settings-content-border">
    <h4><i class="fas fa-info-circle"></i> Setari Cont</h4>
    <form action="{{ route('settings.update', Auth::user()->id) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="col-md-6">
            <div class="form-group
            @if ($errors->has('email'))
                    has-error
@endif">
                <label for id="email">Email <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" readonly value="{{ $user->email }}"
                       name="email" placeholder="Email" id="email"/>
                @if ($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('name'))
                    has-error
@endif">
                <label for id="username">Nume <em>*</em></label>
                <input class="form-control text-box-noradius" type="text" value="{{ $user->name  }}" name="name"
                       placeholder="Nume" id="name"/>
                @if ($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}</span>@endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group
            @if ($errors->has('password'))
                    has-error
@endif">
                <label for id="password">Parola curenta <em>*</em></label>
                <input class="form-control text-box-noradius" type="password" name="password"
                       placeholder="Parola curenta" id="password"/>
                @if ($errors->has('password'))<span class="help-block">{{ $errors->first('password') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('newpassword'))
                    has-error
@endif">
                <label for id="newpassword">Parola noua </label>
                <input class="form-control text-box-noradius" type="password" name="newpassword"
                       placeholder="Parola noua" id="newpassword"/>
                @if ($errors->has('newpassword'))<span
                        class="help-block">{{ $errors->first('newpassword') }}</span>@endif
            </div>
            <div class="form-group
            @if ($errors->has('repass'))
                    has-error
@endif">
                <label for id="repass">Confirmare parola noua </label>
                <input class="form-control text-box-noradius" type="password" name="repass"
                       placeholder="Confirma parola noua" id="repass"/>
                @if ($errors->has('repass'))<span class="help-block">{{ $errors->first('repass') }}</span>@endif
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <ul class="client-sendbtns">
                <li>
                    <button type="submit" class="update-btn">Salveaza</button>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="clearfix"></div>
</div>