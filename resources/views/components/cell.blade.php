<div {{ $attributes->merge(['class' => 'cell bg-white h-40 rounded-lg p-5 shadow overflow-auto']) }} data-cell-id="{{ $cell['id'] }}" data-cell-index="{{ $index }}">
    <div class="relative flex items-center justify-center h-full">
        <a class="invisible opacity-0 cell-edit cursor-pointer">
            <svg class="w-4 absolute top-0 right-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>
        <div class="cell-content select-none cursor-text">        
            {!!$cell['content']!!}    
        </div>              
    </div>
</div>  