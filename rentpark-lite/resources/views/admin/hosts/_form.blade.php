
 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ tr('host_detail') }}</h4>

                    <form action="{{ route('admin.hosts.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" @if($host!=NULL)value="{{ $host->id }}"  @endif >

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="host_name">{{ tr('host_name') }} *</label>
     
                                <input type="text" name="host_name" class="form-control" @if($host!=NULL)value="{{ $host->host_name }}" @else value="{{ old('host_name') }}" @endif placeholder="{{ tr('host_name') }}" required>

                            </div>

                             <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="provider_name">{{ tr('provider_name') }} *</label>

                                <select name="provider_name" required class="form-control">

                                    @foreach($providers as $provider)
                                        
                                       <option @if($host != NULL) {{ $host->provider_id ===  $provider->id ? 'selected' : '' }} @endif >
                                            {{ $provider->name}}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="host_type">{{ tr('host_type') }} *</label>

                                <select name="host_type" required class="form-control">
                                    <option value="Driveway" @if($host!=NULL){{ $host->host_type === 'Driveway' ? 'selected' : '' }}@endif>{{ tr('driveway') }}</option>
                                    <option value="Garage" @if($host!=NULL) {{ $host->host_type === 'Garage' ? 'selected' : '' }}@endif>{{ tr('garage') }}</option>
                                    <option value="Carpark" @if($host!=NULL) {{ $host->host_type === 'Carpark' ? 'selected' : '' }}@endif>{{ tr('carpark') }}</option>
                                </select>

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
                            
                                <label class="picture">{{ tr('picture') }}</label>

                                 <input type="file" onchange="readURL(this);" name="picture" class="form-control" @if($host!=NULL)value="{{ $host->picture }}"@endif accept="image/*">

                            </div>
                         </div>
                        


                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="service_location">{{ tr('service_location') }} *</label>

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
        </div>
    </div>