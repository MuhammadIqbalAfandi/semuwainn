@foreach ($roomType->roomFacilities as $roomFacility)
    <span class="badge badge-pill badge-warning">{{ $roomFacility->facility->name }}</span>
@endforeach
