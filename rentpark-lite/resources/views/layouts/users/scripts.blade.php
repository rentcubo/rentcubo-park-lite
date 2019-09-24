{{-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
  


<script type="text/javascript" src="{{ asset('user-assets/js/jquery.js') }}"></script>

<script src="{{ asset('user-assets/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script> 

<!-- Custom Scripts -->
<script type="text/javascript" src="{{ asset('user-assets/js/script.js') }}"></script>



<script src="{{ asset('user-assets/js/bootstrap.bundle.min.js')}}"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}

<script type="text/javascript" src="{{asset('user-assets/js/jquery.star-rating-svg.min.js')}}"> </script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


<script type="text/javascript">
    
    $(document).ready( function () {
      $('#table_view').DataTable();
    } );
</script>

{{-- Preview the Image while update --}}
<script type="text/javascript">
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

