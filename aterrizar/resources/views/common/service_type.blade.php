
@switch($transaction->service->service_type)
    @case('Flight')
        Vuelo
        @break
    @case('Car')
        Auto
        @break
    @case('Room')
        Habitación
@endswitch
