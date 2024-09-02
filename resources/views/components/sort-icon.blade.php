@if ($sortField !== $field)
    <i data-lucide="chevron-down"></i>
@elseif ($sortDirection === 'asc')
    <i data-lucide="chevron-up"></i>
@else
    <i data-lucide="chevron-down"></i>
@endif
