@if ($type && $title)
<script>
  toastr.options = {
    'closeButton': true,
    'progressBar': true,
    'hideDuration': '2500',
    'newestOnTop': true,
    'preventDuplicates': true,
  }

  toastr["{{ $type }}"]("{{ $message ?? '' }}", "{{ $title }}")
</script>
@endif
