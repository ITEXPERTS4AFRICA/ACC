@props(['name', 'value' => '', 'label' => '', 'rows' => 8])
@php $id = 'quill-'.str_replace(['[',']','.'], '-', $name).'-'.rand(1000,9999); @endphp

<div class="relative" x-data="quillEditor('{{ $id }}', '{{ $name }}', {{ json_encode((string)$value) }})">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <div class="bg-white border border-gray-300 rounded-sm overflow-hidden">
        <div id="{{ $id }}-toolbar" class="border-b border-gray-200 bg-gray-50">
            <span class="ql-formats">
                <select class="ql-header">
                    <option value="2">Titre 2</option>
                    <option value="3">Titre 3</option>
                    <option selected>Normal</option>
                </select>
            </span>
            <span class="ql-formats">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-link"></button>
                <button class="ql-clean"></button>
            </span>
        </div>
        <div id="{{ $id }}" style="height: {{ $rows * 1.5 }}rem;" class="text-sm"></div>
    </div>

    <input type="hidden" name="{{ $name }}" :id="'hidden-'+editorId" :value="content">

    @once
    @push('head')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-editor { font-family: inherit; font-size: 0.875rem; line-height: 1.625; }
        .ql-container.ql-snow { border: none !important; }
        .ql-toolbar.ql-snow { border: none !important; border-bottom: 1px solid #e5e7eb !important; }
    </style>
    @endpush
    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
    function quillEditor(editorId, name, initialContent) {
        return {
            editorId: editorId,
            content: initialContent,
            quill: null,
            init() {
                this.$nextTick(() => {
                    this.quill = new Quill('#' + this.editorId, {
                        modules: { toolbar: '#' + this.editorId + '-toolbar' },
                        theme: 'snow',
                        placeholder: 'Rédiger le contenu...',
                    });

                    this.quill.root.innerHTML = this.content;

                    this.quill.on('text-change', () => {
                        this.content = this.quill.root.innerHTML;
                    });
                });
            }
        }
    }
    </script>
    @endpush
    @endonce
</div>
