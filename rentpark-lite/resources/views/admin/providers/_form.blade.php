
 <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ tr('provider_details') }}</h4>

                    <form action="{{ route('admin.providers.save') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            @if($provider_details!="")

                            <input type="hidden" name="id" class="form-control" value="{{$provider_details->id}}" >
                            @endif

                        </div>

                        <div class="row">
                        
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>

                                <input type="text" name="name" class="form-control" value="{{old('name')?: $provider_details->name}}" placeholder="{{ tr('name') }}" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">{{ tr('email_address') }} *</label>

                                <input type="text" name="email" class="form-control" value="{{old('email')?:$provider_details->email}}" placeholder="{{ tr('email_address') }}" required>
                                
                            </div>
                        </div>
                        
                       

                         @if($provider_details->id=="") 

                         <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="password">{{ tr('password') }} *</label>

                                <input type="password" name="password" class="form-control" placeholder="{{ tr('password') }}"  value="{{ old('password') }}" required>
                                
                            </div>

                             <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="cpassword">{{ tr('confirm_password') }} *</label>

                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_password') }}" value="{{ old('password_confirmation') }}" required>
                                
                            </div>

                         </div>
                            
                        @endif

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" value="{{old('description')?:$provider_details->description}}"placeholder="{{ tr('description') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="mobile">{{ tr('mobile_number') }} *</label>

                                <input type="number" name="mobile" class="form-control" value="{{old('mobile')?:$provider_details->mobile}}" placeholder="{{ tr('mobile_number') }}" required>

                            </div>
                        </div>
                        

                        <div class="form-group">
                              <img src="{{ $provider_details->picture?:asset('placeholder.jpg') }}" id="preview" style="width: 200px;height: 200px"> 

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" onchange="readURL(this);"  name="picture" class="form-control" value="{{asset('placeholder.jpg')?:$provider_details->picture}}" accept="image/*">

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="work">{{ tr('work') }} </label>

                                <input type="text" name="work" class="form-control" value="{{old('work')?:$provider_details->work}}" placeholder="{{ tr('work') }}">

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="school">{{ tr('school') }} </label>

                                <input type="text" name="school" class="form-control" value="{{old('school')?:$provider_details->school}}" placeholder="{{ tr('school') }}">

                            </div>
                        </div>
                        
                        <div class="row"> 

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">{{ tr('languages') }} ({{ tr('seperate_by_comma') }}[,])</label>

                                <textarea name="languages" class="form-control">{{$provider_details->languages?:""}}</textarea> 

                            </div>

                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>