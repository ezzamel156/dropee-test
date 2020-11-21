@extends('layouts.app')

@section('content')
    <div x-data="app()" class="container mx-auto px-4">
        <div x-ref="editor" id="editor" x-show="isEditorOpen">
        </div>
        <button @click="save">Save</button>
        <div class="grid grid-cols-4 gap-12" @dblclick="selectCard($event)">
            @foreach ($grid->layout as $cell)
                <div class="cell--isDraggable">
                    <x-cell :cell="$cell"/>
                </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
        <script>                                                        
            function app() {
                var toolbarOptions = [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons                
                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    ['clean']                                         // remove formatting button
                ];

                var quill = new Quill('#editor', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'bubble'   // Specify theme in configuration
                });

                const containerSelector = '.grid';
                const containers = document.querySelectorAll('.grid');

                if (containers.length !== 0) {
                    const sortable = new Sortable(containers, {
                        draggable: '.cell--isDraggable',
                        mirror: {
                            appendTo: containerSelector,
                            constrainDimensions: true,
                        },
                        delay: 200,
                    }); 
                                       
                    sortable.on('sortable:stop', (se) => {
                        if(se.newIndex !== se.oldIndex)
                            console.log('Index changed')
                    });
                }

                return {
                    isEditorOpen: true,
                    selectedCellContent: '',
                    selectCard(e) {                        
                        this.selectedCellContent = e.target.querySelector('.cell-content') || e.target.closest('.cell-content');
                        console.log(this.selectedCellContent);
                        quill.clipboard.dangerouslyPasteHTML(this.selectedCellContent.innerHTML.trim());
                    },
                    save(e) {
                        this.selectedCellContent.innerHTML = quill.container.querySelector('.ql-editor').innerHTML;
                        e.preventDefault();
                    }
                }
            }
        </script>
    @endpush
@endsection