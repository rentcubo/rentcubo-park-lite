 <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('provider-assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('provider-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('provider-assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('provider-assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('provider-assets/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('provider-assets/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{ asset('provider-assets/js/demo/chart-pie-demo.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('provider-assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('provider-assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('provider-assets/js/demo/datatables-demo.js') }}"></script>

{{-- Rating --}}
<script type="text/javascript">
  $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});
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


{{-- Charts --}}

<script>

    var url = "{{ route('provider.chart') }}";
        var Status = new Array();
        var Approved = 0;
        var Declined = 0;


        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Status.push(data.status);
            });

            for(var i = 0; i < Status.length; ++i){
            if(Status[i] == 1){
                Approved++;
            }else{
              Declined++;
            }
        }

    var ctx = document.getElementById("canvas").getContext('2d');
    var myChart = new Chart(ctx, {

      type: 'doughnut',

      data: {
        labels: Status,
        
        datasets: [{
          
          label: 'Hosts Status',
          
          data: [Approved,Declined],
          
          borderWidth: 1,

          backgroundColor:['green','red']
        }],

        labels: [
          '{{ tr('approved') }}',
          '{{ tr('declined') }}'
        ]

      },
                  
      options: {
        
      }

    });
    });
  });
</script>


{{-- DataTables --}}
<script type="text/javascript">
  
if ( $.fn.dataTable.isDataTable( '#dataTable' ) ) {
    table = $('#').DataTable();
}
else {
    table = $('#dataTable').DataTable( {
       "searching": false,
        "paging": false, 
        "info": false,         
        "lengthChange":false

    } );
}

</script>
