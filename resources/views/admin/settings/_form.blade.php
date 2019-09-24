<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="site_name">{{ tr('site_name') }} *</label>
     
                                <input type="text" name="site_name" class="form-control" value="{{ Setting::get('site_name') }}" placeholder="{{ tr('site_name') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="currency">{{ tr('currency') }} *</label>
     
                                <input type="text" name="currency" class="form-control" value="{{ Setting::get('currency') }}" placeholder="{{ tr('currency') }} " required>

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">

                               <img src="{{ setting()->get('favicon')}}" style="width: 200px;height: 200px"> 
                            </div>

                            <div class="form-group col-md-6 col-lg-6">

                               <img src="{{ Setting::get(
                                    'site_logo')}}" style="width: 200px;height: 200px"> 
                            </div>


                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="favicon">{{ tr('favicon') }} *</label><br>

                                <span>{{ tr('only_png_images') }}</span>

                                 <input type="file" name="favicon" class="form-control" >

                            </div>

                            

                            <div class="form-group col-md-6 col-lg-6">
                                
                                <label class="site_logo">{{ tr('site_logo') }} *</label><br>

                                <span>{{ tr('only_png_images') }}</span>

                                 <input type="file" name="site_logo" class="form-control" >

                            </div>


                        </div>
                         
                        
                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">                       

                    </form>
              </div>                                
            </div>                          
        </div>