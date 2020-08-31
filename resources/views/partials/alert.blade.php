@if(session()->has('status'))
  <script>
    $(window).bind("load", function() {
      toastr.options.timeOut = 2000;
      toastr.options.closeButton = true;
      toastr.success('{{session('status')}}');
    });
  </script>
@endif
@if ($errors->any())
  <script>
      $(window).bind("load", function() {
        @foreach ($errors->all() as $error)
          toastr.options.closeButton = true;
          // toastr.options.showEasing = 'easeOutBounce';
          toastr.options.hideMethod = 'slideUp';
          toastr.options.timeOut = 2000;
          toastr.options.preventDuplicates = true;
          toastr.error('{{ $error }}');
        @endforeach
      });
  </script>
@endif
