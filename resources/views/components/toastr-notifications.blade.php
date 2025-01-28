@if ($type && $title)
<script>
  toastr.options = {
    'closeButton': true,
    'progressBar': true,
    'hideDuration': '2500',
    'newestOnTop': true,
    'preventDuplicates': true,
    'positionClass': 'toast-top-center',
  }

  toastr["{{ $type }}"]("{{ $message ?? '' }}", "{{ $title }}")
</script>
@endif
