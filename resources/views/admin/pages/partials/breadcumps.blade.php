<ol class="breadcrumb m-0">
    @foreach ($breadcumps as $item)
        @if($loop->iteration==count($breadcumps))
        <li class="breadcrumb-item active">{{ $item['name'] }}</li>
        @else
        <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['name'] }}</a><li>
        @endif
    @endforeach
    {{-- @foreach ($breadcumps as $item)
    @if(!$loop->last)
    @else
    <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['name'] }}</a><li>
    @endif
    @endforeach --}}
</ol>
