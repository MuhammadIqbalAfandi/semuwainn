@foreach ($roomType->roomPrices as $roomPrice)
    <p>
        <span class="d-block">{{ $roomPrice->description }}</span>
        <span class="d-block">{{ $roomPrice->price }}</span>
    </p>
@endforeach
