 
 <div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ tr('admin_profile') }}</h4>

                    <form action="{{ route('admin.profile.save')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $admin->id }}" >

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>

                                <input type="text" name="name" class="form-control" value="{{ $admin->name }}" placeholder="{{ tr('name') }}" required>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">{{ tr('email_address') }} *</label>

                                <input type="text" name="email" class="form-control" value="{{ $admin->email }}" placeholder="{{ tr('email_address') }} " required>
                                
                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">{{ tr('mobile_number') }} *</label>

                                <input type="tel" name="mobile" class="form-control" value="{{ $admin->mobile }}" placeholder="{{ tr('mobile_number') }}" required>

                            </div>


                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="description">{{ tr('about') }} *</label>

                                <input type="text" name="about" class="form-control" value="{{ $admin->about }}" placeholder="{{ tr('about') }}" required>

                            </div>

                        </div>


                        <div class="row">
                            
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" name="picture" onchange="readURL(this);" class="form-control" value="{{ $admin->picture }}" accept="image/*">

                            </div>

                        </div>

                        <div class="form-group">
                             <img  id="preview" src="{{ $admin->picture }}" style="width: 200px;height: 200px">

                        </div>

                       

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>