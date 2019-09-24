
 <div class="row">
    <!-- column -->
    <div class="col-12">
        
        <div class="card">
        
            <div class="card-body">
                
                <h4 class="card-title">{{ tr('user_details') }}</h4>

                <form action="{{ route('admin.users.save') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @if($user_details!="")
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{ $user_details->id }}" >
                        </div>
                    @endif
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>

                                <input type="text" name="name" class="form-control" value="{{old('name')?:$user_details->name}}" placeholder="{{ tr('name') }}" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">{{ tr('email_address') }} *</label>

                                <input type="text" name="email" class="form-control" value="{{old('email')?:$user_details->email}}" placeholder="{{ tr('email_address') }}" required>
                                
                            </div>

                        </div>
                        
                        @if($user_details->id == "") 

                        <div class="row">
                             
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="password">{{ tr('password') }} *</label>

                                <input type="password" name="password" class="form-control" placeholder="{{ tr('password') }}" value="{{ old('password') }}" required>
                                
                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="cpassword">{{ tr('confirm_password') }} *</label>

                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_password') }}" value="{{ old('password_confirmation') }}" required>
                                
                            </div>
                        
                        </div>

                        @endif

                        <div class="row">

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">{{ tr('mobile_number') }} *</label>

                                <input type="number" name="mobile" class="form-control" value="{{old('mobile')?:$user_details->mobile}}" placeholder="{{ tr('mobile_number') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" value="{{old('description')?:$user_details->description}}" placeholder="{{ tr('description') }}" required>

                            </div>
                 
                        </div>
                    
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                <input type="file" onchange="readURL(this);"  name="picture" class="form-control" value="{{ $user_details->picture }}"  accept="image/*">

                            </div>
                        </div>

                        <div class="form-group">
                            
                            <img src="{{ $user_details->picture?:asset('placeholder.jpg') }}" id="preview" style="width: 200px;height: 200px">
                        </div>
                    
                        <input type="submit" name="Submit" title="submit" value="{{ tr('submit') }}" class="btn btn-primary">

                </form>
            
            </div>                                
    
        </div>                          
    
    </div>

</div>