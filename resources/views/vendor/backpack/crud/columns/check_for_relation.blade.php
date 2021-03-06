{{-- checkbox with loose false/null/0 checking --}}
@php
//$checkValue = data_get($entry, $column['name']);
$function = data_get($entry, $column['relation']);

$checkedIcon = data_get($column, 'icons.checked', 'fa-check-circle');
$uncheckedIcon = data_get($column, 'icons.unchecked', 'fa-circle');

$exportCheckedText = data_get($column, 'labels.checked', trans('backpack::crud.yes'));
$exportUncheckedText = data_get($column, 'labels.unchecked', trans('backpack::crud.no'));

$icon = $function->isEmpty() ? $uncheckedIcon : $checkedIcon;
$text = $function->isEmpty() ? $exportUncheckedText : $exportCheckedText;
@endphp

<span>
    <i class="fa {{ $icon }}"></i>
</span>

<span class="sr-only">{{ $text }}</span>
