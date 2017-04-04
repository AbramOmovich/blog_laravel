@if(session()->has('alert'))
   <script>
           window.onload = function(){
                 swal("{{ session('alert.title') }}", "{{ session('alert.message') }}", "{{ session('alert.type') }}")
             };
       </script>
@endif