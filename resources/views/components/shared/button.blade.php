 @props(['text' => '', 'faIcon' => ''])

 <button type="button" {{ $attributes->merge(['class' => 'btn btn-sm btn-warning']) }} data-toggle="modal">
     {{ $text }}

     @if ($faIcon)
         <i class="fa {{ $faIcon }}"></i>
     @endif
 </button>
