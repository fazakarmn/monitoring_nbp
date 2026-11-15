@php
$cls = match(true) {
    $v >= 100 => 'prog-100',
    $v >= 60  => 'prog-high',
    $v >= 30  => 'prog-mid',
    $v > 0    => 'prog-low',
    default   => 'prog-zero',
};
@endphp
<span class="prog-badge {{ $cls }}">{{ $v }}%</span>
