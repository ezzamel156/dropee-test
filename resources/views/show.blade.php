@extends('layouts.app')

@section('content')
    <div x-data="app()" x-init="init()" class="container mx-auto px-4">
        <div class="flex p-4 text-gray-700 opacity-75">
            <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm ml-2"><em>Drag and drop to change the cell's position. Hover over them and click on the edit icon to edit content</em></span>
        </div>
        <div data-grid-id="{{ $grid->id }}"  x-ref="grid" class="grid grid-cols-4 gap-12" @click="openModal($event)">
            @foreach ($grid->layout as $cell)
                <x-cell :cell="$cell" :index="$loop->iteration" class="cell--isDraggable cursor-move"/>
            @endforeach
        </div>
        <x-modal x-show="isModalOpen">
            <x-slot name="body">
                <div x-ref="editor">
                    <div id="editor"  class="h-20">
                    </div>
                </div>               
            </x-slot>
            <x-slot name="footer">
                <button @click="saveContent" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Save
                </button>
                <button  @click="isModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </x-slot>
        </x-modal>
    </div>
    @push('scripts')
        <script>                                                        
            function app() {   
                return {
                    isModalOpen: false,
                    selectedCell: null,
                    swappedCell: null,                 
                    swappable: new Swappable(document.querySelectorAll('.grid'), {
                        draggable: '.cell--isDraggable',
                        mirror: {
                            appendTo: '.grid',
                            constrainDimensions: true,
                        },
                        delay: 150,
                    }),
                    quill : new Quill('#editor', {
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'size': ['small', false, 'large', 'huge'] }],
                                [{ 'color': [] }, { 'background': [] }],
                                ['clean']                                         
                            ]
                        },
                        theme: 'snow'
                    }),
                    init() {
                        this.swappable.on('swappable:swapped', (e) => this.swappedCell = e.swappedElement);
                        this.swappable.on('swappable:stop', (e) => {
                            if(this.swappedCell) {
                                this.saveIndex(e)
                            }
                        });
                    },
                    openModal(e) {
                        if(e.target.matches('.cell-edit, .cell-edit *')) {
                            this.isModalOpen = true;
                            this.selectedCell = e.target.closest('.cell');
                            this.quill.clipboard.dangerouslyPasteHTML(this.selectedCell.querySelector('.cell-content').innerHTML.trim());
                        }
                    },
                    saveIndex(e) {
                        let originalCell = e.dragEvent.data.originalSource;
                        let cellId = null;
                        let data = {};
                        
                        if(this.swappedCell.dataset.cellId && originalCell.dataset.cellId) {
                            cellId = originalCell.dataset.cellId;
                            data.swappedCellId = this.swappedCell.dataset.cellId;
                        }
                        else if(!this.swappedCell.dataset.cellId && originalCell.dataset.cellId) {
                            cellId = originalCell.dataset.cellId;
                            data.cellIndex = this.swappedCell.dataset.cellIndex;
                        }
                        else if(this.swappedCell.dataset.cellId && !originalCell.dataset.cellId) {
                            cellId = this.swappedCell.dataset.cellId;
                            data.cellIndex = originalCell.dataset.cellIndex;
                        }
                        else {
                            this.swapCellIndeces(originalCell, this.swappedCell);
                            return;
                        }

                        axios.put(`/grids/${this.$refs.grid.dataset.gridId}/cells/${cellId}/index`, data)
                            .catch((error) => {
                                throw error;
                            })
                            .then((response) => {                                
                                this.swapCellIndeces(originalCell, this.swappedCell);
                                this.swappedCell = null;
                            });
                            
                    },
                    swapCellIndeces(originalCell, swappedCell) {
                        let cellIndex = originalCell.dataset.cellIndex;                                
                        originalCell.dataset.cellIndex = swappedCell.dataset.cellIndex;
                        swappedCell.dataset.cellIndex = cellIndex;
                    },
                    saveContent(e) {
                        if(!this.selectedCell)
                            return;
                        
                        let content = this.quill.container.querySelector('.ql-editor').innerHTML;
                        let cellIndex = this.selectedCell.dataset.cellIndex;
                        let method = this.selectedCell.dataset.cellId ? 'put' : 'post';
                        axios[method](`/grids/${this.$refs.grid.dataset.gridId}/cells/${this.selectedCell.dataset.cellId}`, {
                                content,
                                cellIndex,
                            })
                            .catch((error) => {
                                throw error;
                            })
                            .then((response) => {
                                this.selectedCell.querySelector('.cell-content').innerHTML = content;
                                this.selectedCell.dataset.cellId = response.data.id;
                                this.isModalOpen = false;
                                this.selectedCell = null;
                            });
                        e.preventDefault();
                    }
                }
            }
        </script>
    @endpush
@endsection