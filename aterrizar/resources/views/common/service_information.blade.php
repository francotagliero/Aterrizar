
@switch($transaction->service->service_type)
    @case('Flight')
        <a href="{!! route('flights.show', $transaction->service_id) !!}">
        {{ $transaction->service->from->name }} &gt; {{ $transaction->service->to->name }}
        </a>
        ({{ Carbon\Carbon::parse($transaction->service->date)->format('d-m-Y') }})
        @if ($transaction->detail->stop !== null)
        <br>
        <a href="{!! route('flights.show', $transaction->detail->stop->id) !!}">
        {{ $transaction->detail->stop->from->name }} &gt; {{ $transaction->detail->stop->to->name }}
        </a>
        ({{ Carbon\Carbon::parse($transaction->detail->stop->date)->format('d-m-Y') }})
        @endif
        <br>
        @switch($transaction->detail->class)
            @case('Economy')
            Clase Económica
            @break
            @case('Business')
            Clase Ejecutiva
            @break
            @case('First')
            Primera Clase
        @endswitch
        @break
    @case('Car')
        <a href="{!! route('cars.show', $transaction->service_id) !!}">
        {{ $transaction->service->brand->name }} {{ $transaction->service->model }}
        </a>
        <br>
        {{ $transaction->service->agency->name }}
        <br>
        Del {{ Carbon\Carbon::parse($transaction->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->to)->format('d-m-Y') }}
        @break
    @case('Room')
        <a href="{!! route('rooms.show', $transaction->service_id) !!}">
        Hotel {{ $transaction->service->hotel->name }} 
        </a>
        ({{ $transaction->service->capacity }} personas)
        <br>
        Del {{ Carbon\Carbon::parse($transaction->service->from)->format('d-m-Y') }} al {{ Carbon\Carbon::parse($transaction->service->to)->format('d-m-Y') }}
@endswitch
