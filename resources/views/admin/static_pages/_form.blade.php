
 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ tr('static_page_detail') }}</h4>

                    <form action="{{ route('admin.static_pages.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="static_page_id" class="form-control" @if($static_page!=NULL)value="{{ $static_page->id }}"  @endif >

                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="title">{{ tr('title') }} *</label>
     
                                <input type="text" name="title" class="form-control" @if($static_page!=NULL)value="{{ $static_page->title }}" @else value="{{ old('title') }}" @endif placeholder="{{ tr('title') }}" required>

                            </div>

                            <div class="form-group col-md-6 col-lg-6">
                            
                                <label class="type">{{ tr('static_page_type') }} *</label>


                                <select class="form-control" name="type" required>
                                    <option value="">{{tr('select_page_type')}}</option>

                                    @foreach($page_types as $value)

                                       <option value="{{ $value }}" @if($static_page!=NULL) {{ $static_page->type ===  $value ? 'selected' : $value   }}@endif>{{ $value }}</option>
                                    @endforeach 
                                </select>

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            
                            <div class="form-group col-md-12 col-lg-12 ">
                                
                                <label class="description">{{ tr('description') }} *</label>
                                
                                <textarea id="summernote" rows="5"  name="description" class="form-control" name="description" placeholder="{{ tr('description') }}" required > @if($static_page!=NULL)  {{ old('description') ?: $static_page->description }} @else {{ old('description') }} @endif</textarea>
                            </div>



                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>
              </div>                                
            </div>                          
        </div>
    </div>