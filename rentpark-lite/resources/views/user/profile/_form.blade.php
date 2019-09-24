<!-- Page Heading -->
<div class="row">
    <div class="col-md-5">
        <h2 class="h3 mb-2 text-gray-800 profile">{{ tr('user_profile') }}</h2>
        <p class="mb-4">{{ tr('update_profile_info') }}</p>
        @include('notifications.notification')
    </div>

    <div class="col-md-7 pt-3">
        <a href="{{ route('profile.view') }}"  class="btn btn-primary float-right hidden-sm-down ">{{ tr('go_back') }}</a>
    </div>
</div>  


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ tr('update_profile') }}</h6>
    </div>

    <div class="card-body">

        <form action="{{ route('profile.save') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                
                <input type="hidden" name="id" class="form-control" value="{{ $user_details->id }}" >

            </div>
            
            <div class="row">
                
                <div class="form-group col-md-6 col-lg-6">
                
                    <label class="name">{{ tr('name') }} *</label>

                    <input type="text" name="name" class="form-control" value="{{ $user_details->name }}" placeholder="{{ tr('name') }}" required>

                </div>

                <div class="form-group col-md-6 col-lg-6">
                    
                    <label class="email">{{ tr('email') }} *</label>

                    <input type="text" name="email" class="form-control" value="{{ $user_details->email }}" placeholder="{{ tr('email') }}" required>

                </div>
            </div>
            
            <div class="row">
                
                <div class="form-group col-md-6 col-lg-6">
                
                    <label class="description">{{ tr('description') }} *</label>

                    <input type="text" name="description" class="form-control" value="{{ $user_details->description }}" placeholder="{{ old('description') ?: tr('description') }}" required>

                </div>

                <div class="form-group col-md-6 col-lg-6">
                    
                    <label class="mobile">{{ tr('mobile') }} *</label>

                    <input type="text" name="mobile" class="form-control" value="{{ $user_details->mobile }}" placeholder="{{ old('mobile') ?: tr('mobile') }}" required>

                </div>

            </div>
            
           <div class="row">

                <div class="form-group col-md-6 col-lg-6">
                
                    <img src="{{ $user_details->picture }}" id="preview" style="width: 200px;height: 200px"> 

                </div> 
           </div>

            <div class="row">
                 <div class="form-group col-md-6 col-lg-6">
                
                    <label class="picture">{{ tr('picture') }}</label>

                    <input type="file" name="picture"  onchange="readURL(this);" class="form-control" value="{{ $user_details->picture }}" accept="image/*">

                </div>

            </div>

            <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

        </form>

    </div>
</div>