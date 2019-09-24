<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="">
    
<meta name="author" content="">

<!-- Favicon icon -->

<link rel="icon" type="image/png"  href="{{ setting()->get('favicon')}}">


<title>{{ setting()->get('site_name') }}</title> 

<!-- Bootstrap Core CSS -->
<link href="{{asset('admin-assets/node_modules/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

<link href="{{asset('admin-assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
<!-- This page CSS -->
<!-- chartist CSS -->
<link href="{{asset('admin-assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">

<!--c3 CSS -->
<link href="{{asset('admin-assets/node_modules/c3-master/c3.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('admin-assets/css/style.css')}}" rel="stylesheet">

<!-- Dashboard 1 Page CSS -->
<link href="{{asset('admin-assets/css/pages/dashboard1.css')}}" rel="stylesheet">

<!-- You can change the theme colors from here -->
<link href="{{asset('admin-assets/css/colors/default.css')}}" id="theme" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />

{{-- TextArea Editor --}}
 <link rel="stylesheet" href="{{ asset('admin-assets/node_modules/summernote/dist/summernote-bs4.css')}}">


 <style type="text/css">

  .table-responsive {

    overflow: visible;
  }

  .size {
    height: 80px;

    width: 205px;
  }
    
    .rating {
  display: inline-block;
  position: relative;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color: #09f;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
}
  </style>



