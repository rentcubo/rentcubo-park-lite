<!-- ============================================================== -->
<!-- All Jquery -->
 <!-- ============================================================== -->
<script src="{{asset('admin-assets/node_modules/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('admin-assets/node_modules/bootstrap/js/popper.min.js')}}"></script>

<script src="{{asset('admin-assets/node_modules/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('admin-assets/js/perfect-scrollbar.jquery.min.js')}}"></script>

<!--Wave Effects -->
<script src="{{asset('admin-assets/js/waves.js')}}"></script>
    
<!--Menu sidebar -->
<script src="{{asset('admin-assets/js/sidebarmenu.js')}}"></script>
    
<!--Custom JavaScript -->
<script src="{{asset('admin-assets/js/custom.min.js')}}"></script>

<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->

<!--morris JavaScript -->
<script src="{{asset('admin-assets/node_modules/raphael/raphael-min.js')}}"></script>

<script src="{{asset('admin-assets/node_modules/morrisjs/morris.min.js')}}"></script>
    
<!--c3 JavaScript -->
<script src="{{asset('admin-assets/node_modules/d3/d3.min.js')}}"></script>
  
<script src="{{asset('admin-assets/node_modules/c3-master/c3.min.js')}}"></script>
    
<!-- Chart JS -->
<script src="{{asset('admin-assets/js/dashboard1.js')}}"></script>

{{-- TextArea Editor --}}
<script src="{{ asset('admin-assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>


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

{{-- Active the sidebar --}}
<script type="text/javascript">
    $(function() {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function() {
            return this.href.toString().split('/index')[0]+'/view' == url.toString().split('/view')[0]+'/view'
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            } else {
                break;
            }
        }

    });
    $(function() {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function() {
            return this.href.toString().split('/index')[0]+'/edit' == url.toString().split('/edit')[0]+'/edit'
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            } else {
                break;
            }
        }

    });

    $(function() {
      $('textarea#froala-editor').froalaEditor()
    });

    $(document).ready(function() {

        $('#summernote').summernote({
            height: 300,
            tabsize: 2
        });

    });
</script>