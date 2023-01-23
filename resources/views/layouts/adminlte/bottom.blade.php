<script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js?v='.$version)}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte3/plugins/datatables/jquery.dataTables.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js?v='.$version)}}">
</script>
<script src="{{ asset('adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js?v='.$version)}}">
</script>
<script src="{{ asset('adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/jszip/jszip.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/pdfmake/pdfmake.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/pdfmake/vfs_fonts.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-buttons/js/buttons.print.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/daterangepicker/daterangepicker.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/moment/moment.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/bs-stepper/js/bs-stepper.min.js?v='.$version)}}"></script>
<script src="{{ asset('adminlte3/plugins/select2/js/select2.full.min.js?v='.$version)}}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.4/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('adminlte3/js/adminlte.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ asset('js/custom.js?v='.$version) }}"></script>
<script src="{{ asset('js/customDataTable.js?v='.$version) }}"></script>
<script src="{{ asset('js/image-profile.js?v='.$version) }}"></script>

{{-- TOASTR --}}
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch(type){
        case 'info':

        toastr.options.timeOut = 4000;
        toastr.info("{{Session::get('message')}}");
        var audio = new Audio('audio.mp3');
        audio.play();
        break;
        case 'success':

        toastr.options.timeOut = 4000;
        toastr.success("{{Session::get('message')}}");
        var audio = new Audio('audio.mp3');
        audio.play();

        break;
        case 'warning':

        toastr.options.timeOut = 4000;
        toastr.warning("{{Session::get('message')}}");
        var audio = new Audio('audio.mp3');
        audio.play();

        break;
        case 'error':

        toastr.options.timeOut = 4000;
        toastr.error("{{Session::get('message')}}");
        var audio = new Audio('audio.mp3');
        audio.play();

        break;
        }
    @endif
</script>

<script>
    var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
$('.select2').select2()

</script>