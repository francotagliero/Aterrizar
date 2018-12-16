
<div class="alert alert-{{ $type }} col-auto mr-auto ml-auto" role="alert">
@switch($type)
    @case('success')
        <i class="fas fa-check-circle fa-lg"></i>
        @break
    @case('danger')
        <i class="fas fa-exclamation-circle fa-lg"></i>
        @break
    @case('warning')
        <i class="fas fa-exclamation-triangle fa-lg"></i>
        @break
    @case('info')
        <i class="fas fa-info-circle fa-lg"></i>
@endswitch
{{ $message }}
</div>
