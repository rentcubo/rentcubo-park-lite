<!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('host_detail') }}</h1>
          <p class="mb-4">{{ tr('host_info') }}</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.hosts.index') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('go_back') }}</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('host') }}</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('provider.hosts.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($host!=NULL)value="{{ $host->id }}"@endif >

                        </div>
                        
                        <div class="row">
                            
                             <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="host_name">{{ tr('host_name') }} *</label>
     
                                <input type="text" name="host_name" class="form-control " @if($host!=NULL)value="{{ $host->host_name }}" @else value="{{ old('host_name') }}" @endif placeholder="{{ tr('host_name') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="host_type">{{ tr('host_type') }} *</label>

                                <select name="host_type" required class="form-control">
                                    <option value="Driveway" @if($host!=NULL){{ $host->host_type === 'Driveway' ? 'selected' : '' }}@endif>{{ tr('driveway') }}</option>
                                    <option value="Garage" @if($host!=NULL) {{ $host->host_type === 'Garage' ? 'selected' : '' }}@endif>{{ tr('garage') }}</option>
                                    <option value="Carpark" @if($host!=NULL) {{ $host->host_type === 'Carpark' ? 'selected' : '' }}@endif>{{ tr('carpark') }}</option>
                                </select>

                            </div>

                        </div>
                       
                        <div class="row"> 

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" name="picture" onchange="readURL(this);"  class="form-control" @if($host!=NULL)value="{{ $host->picture }}"@endif accept="image/*">

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="description">{{ tr('description') }} *</label>

                                <input type="text" name="description" class="form-control" @if($host!=NULL)value="{{ $host->description }}" @else value="{{ old('description') }}" @endif placeholder="{{ tr('description') }}" required>

                            </div>
                        </div>
                        
                        <div class="form-group">
                             @if($host!=NULL) <img src="{{ $host->picture }}" id="preview" style="width: 200px;height: 200px"> @endif

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="service_location">{{ tr('location') }} *</label>

                                <select name="service_location" required class="form-control">
                                        @foreach($service_locations as $service_location)
                                            
                                           <option @if($host!=NULL)
                                                {{ $host->service_location_id ===  $service_location->id ? 'selected' : '' }}     @endif >{{ $service_location->name}}
                                            </option>

                                        @endforeach
                                </select>

                            </div>
                            
                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="total_spaces">{{ tr('total_spaces') }} *</label>

                                <input type="number" name="total_spaces" class="form-control" @if($host!=NULL)value="{{ $host->total_spaces }}" @else value="{{ old('total_spaces') }}" @endif placeholder="{{ tr('total_spaces') }}" required>

                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="full_address">{{ tr('full_address') }} *</label>

                                <input type="text" name="full_address" class="form-control" @if($host!=NULL)value="{{ $host->full_address }}" @else value="{{ old('full_address') }}" @endif placeholder="{{ tr('full_address') }}" required>

                            </div>


                             <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="per_hour">{{ tr('per_hour') }} *</label>

                                <input type="number" name="per_hour" class="form-control" @if($host!=NULL)value="{{ $host->per_hour }}" @else value="{{ old('per_hour') }}" @endif placeholder="{{ tr('per_hour') }}" required>

                            </div>

                        </div>
                        
                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>

            </div>
          </div>