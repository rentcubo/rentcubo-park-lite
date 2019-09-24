<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">

<title>{{ setting()->get('site_name') }}</title>

<!-- Favicon icon -->

<link rel="icon" type="image/png"  href="{{ setting()->get('favicon')}}">
    
<meta name="author" content="Codegama">
    
<meta name="description" content="Rent-Parking APP Design">

<meta name="keywords" content="">

<link rel="canonical" href="#">

<meta name="theme-color" content="#6866fc">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}} 
    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    
<!-- Default Style CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/default.css') }}">
    
<!-- Responsive CSS -->
<!--link rel="stylesheet" type="text/css" href="css/responsive.css"-->
<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/slick/slick.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/slick/slick-theme.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> 

<script src="https://code.jquery.com/jquery-2.2.0.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/star-rating-svg.css') }} ">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style type="text/css">
	
	/* Google Material icons */
@import "http://fonts.googleapis.com/icon?family=Material+Icons";
</style>


<style type="text/css">
    
.rating {
  display: inline-block;
  position: relative;
  height: 30px;
  line-height: 30px;
  font-size: 20px;
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
  color: #ffa31a;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #ffa31a;
}
  </style>