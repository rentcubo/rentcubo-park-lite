<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ tr('service_location_detail') }}</h4>

                    

                    <form action="{{ route('admin.service_locations.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($service_location!=NULL)value="{{ $service_location->id }}"@endif >

                        </div>

                        <div class="row">
                            
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="name">{{ tr('name') }} *</label>

                                <input type="text" name="name" class="form-control" @if($service_location!=NULL)value="{{ $service_location->name }}" @else value="{{ old('name') }}" @endif placeholder="{{ tr('name') }}" required> 

                            </div>

                        </div>
                        
                       
                        <div class="form-group ">
                            @if($service_location!=NULL) <img src="{{ $service_location->picture }}" id="preview" style="width: 200px;height: 200px"> @endif
                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                <input type="file" name="picture" onchange="readURL(this);" class="form-control" @if($service_location!=NULL)value="{{ $service_location->picture }}"@endif accept="image/*">

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="full_address">{{ tr('full_address') }} *</label>

                                <textarea name="full_address" class="form-control" required> @if($service_location!=NULL){{$service_location->full_address }} @else {{ old('full_address') }} @endif</textarea> 

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" @if($service_location!=NULL)value="{{ $service_location->description }}" @else value="{{ old('description') }}" @endif placeholder="{{ tr('description') }}" required>

                            </div>

                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>