<script>
  window.Laravel = {!! json_encode([
    'apiToken' => \Auth::user()->api_token ?? null
  ]) !!};
</script>

<script type="text/javascript">
  window.User = <?php echo json_encode(\Auth::user()); ?>
</script>
<script src="{{ asset('js/app.js') }}"></script>