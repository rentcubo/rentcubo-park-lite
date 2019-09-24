<!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('provider_profile') }}</h1>
          <p class="mb-4">{{ tr('update_profile_info') }}</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.profile.view') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('go_back') }}</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('update_profile') }}</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('provider.profile.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $provider_details->id }}" >

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>
     
                                <input type="text" name="name" class="form-control" value="{{ $provider_details->name }}" placeholder="{{ tr('name') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="email">{{ tr('email_address') }} *</label>
     
                                <input type="text" name="email" class="form-control" value="{{ $provider_details->email }}" placeholder="{{ tr('email_address') }}" required>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="mobile">{{ tr('mobile_number') }} *</label>

                                <input type="number" name="mobile" class="form-control" value="{{ $provider_details->mobile }}" placeholder="{{ tr('mobile_number') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" value="{{ $provider_details->description }}" placeholder="{{ tr('description') }}" required>

                            </div>
                        </div>

                        <div class="form-group">
                              <img src="{{ $provider_details->picture }}" id="preview" style="width: 200px;height: 200px"> 

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" name="picture" onchange="readURL(this);"  class="form-control" value="{{ $provider_details->picture }}" accept="image/*">

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="work">{{ tr('work') }} </label>

                                <input type="text" name="work" class="form-control" value="{{ $provider_details->work }}" placeholder="{{ tr('work') }} " >

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="school">{{ tr('school') }} </label>

                                <input type="text" name="school" class="form-control" value="{{ $provider_details->school }}" placeholder="{{ tr('school') }}">

                            </div>

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="languages">{{ tr('languages') }} *</label>

                                <input type="text" name="languages" class="form-control" value="{{ $provider_details->languages }}" placeholder="{{ tr('languages') }}" required>

                            </div>

                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>

            </div>
          </div>