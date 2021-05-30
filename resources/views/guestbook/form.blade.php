<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Add entry') }}</div>

            <div class="card-body content-ct">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form autocomplete="off" class="form-horizontal" role="form" method="post" id="entry_form" action="{{ !empty($id) ? route('update entry',$id) : route('add entry')}}" onSubmit="captchaExecuter(this)">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-12">
                            <input id="name" name="name" class="form-control" placeholder="Text your name..."  value="{{old('name')  ?? $entry['name'] ?? null }}" maxlength="25" required >
                            <div class="help-block with-errors pull-right"></div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                    
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <div class="col-12">
                            <textarea autocomplete="off" id="message" name="message" class="form-control" rows="3"  placeholder="Text your message..." required minlength="5" maxlength="150">{{ old('message') ?? $entry['message'] ?? null }}</textarea>
                            <div class="help-block with-errors pull-right"></div>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{$errors->first('message')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if(!empty($is_admin))
                        <div class="form-group{{ $errors->has('approved') ? ' has-error' : '' }}">
                            <label for="approved" class="col-md-4 control-label">Approved</label>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <input id="approved" type="checkbox"
                                        @if(!empty($entry['approved']) || !empty(old('approved')))
                                            checked
                                        @endif
                                    name="approved" >  
                                </div>
                            </div>
                        </div>  
                    @else
                        <div 
                            id='recaptcha' 
                            class="g-recaptcha"
                            data-sitekey="6LcTt5caAAAAAG7V2RiYsecebXzPzXUe8-2KvBGk"
                            data-callback="onSubmit"
                            data-size="invisible">
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            <div class="help-block with-errors pull-right"></div>
                            @if ($errors->has('captcha'))
                                <span class="help-block">
                                    <strong class="captcha_error">{{$errors->first('captcha')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>