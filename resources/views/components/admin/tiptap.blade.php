@props(['name', 'value' => '', 'label' => '', 'rows' => 8])
@php $id = 'tiptap-'.str_replace(['[',']','.'], '-', $name).'-'.rand(1000,9999); @endphp

<div x-data="tiptapEditor('{{ $id }}', {{ json_encode((string)$value) }})" class="relative">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    {{-- Toolbar --}}
    <div class="flex flex-wrap gap-0.5 p-2 bg-gray-50 border border-gray-300 border-b-0 rounded-t-sm">
        @foreach([
            ['cmd'=>'bold',        'icon'=>'B',    'title'=>'Gras'],
            ['cmd'=>'italic',      'icon'=>'I',    'title'=>'Italique'],
            ['cmd'=>'strike',      'icon'=>'S̶',    'title'=>'Barré'],
            ['sep'=>true],
            ['cmd'=>'h2',          'icon'=>'H2',   'title'=>'Titre 2'],
            ['cmd'=>'h3',          'icon'=>'H3',   'title'=>'Titre 3'],
            ['sep'=>true],
            ['cmd'=>'ul',          'icon'=>'≡',    'title'=>'Liste'],
            ['cmd'=>'ol',          'icon'=>'1.',   'title'=>'Liste numérotée'],
            ['sep'=>true],
            ['cmd'=>'blockquote',  'icon'=>'❝',    'title'=>'Citation'],
            ['cmd'=>'hr',          'icon'=>'—',    'title'=>'Séparateur'],
            ['sep'=>true],
            ['cmd'=>'undo',        'icon'=>'↩',    'title'=>'Annuler'],
            ['cmd'=>'redo',        'icon'=>'↪',    'title'=>'Rétablir'],
            ['sep'=>true],
            ['cmd'=>'clear',       'icon'=>'⊘',    'title'=>'Effacer mise en forme'],
        ] as $btn)
        @if(isset($btn['sep']))
        <div class="w-px h-6 bg-gray-300 mx-1 self-center"></div>
        @else
        <button type="button" @click="exec('{{ $btn['cmd'] }}')"
                :class="isActive('{{ $btn['cmd'] }}') ? 'bg-bordeaux text-white' : 'text-gray-600 hover:bg-gray-200'"
                title="{{ $btn['title'] }}"
                class="min-w-[28px] h-7 px-1.5 rounded text-xs font-semibold transition">
            {{ $btn['icon'] }}
        </button>
        @endif
        @endforeach
        <button type="button" @click="addLink()" title="Lien" class="min-w-[28px] h-7 px-1.5 rounded text-xs font-semibold text-gray-600 hover:bg-gray-200 transition">
            🔗
        </button>
    </div>

    {{-- Éditeur --}}
    <div :id="editorId"
         class="min-h-[{{ $rows * 2 }}rem] border border-gray-300 rounded-b-sm px-4 py-3 bg-white text-sm leading-relaxed focus:outline-none prose prose-sm max-w-none
                prose-headings:font-playfair prose-h2:text-xl prose-h3:text-lg prose-a:text-bordeaux"
         style="min-height: {{ $rows * 1.75 }}rem;">
    </div>

    {{-- Hidden input --}}
    <input type="hidden" :name="fieldName" :value="content">

    @once
    @push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tiptap/pm@latest/dist/style.min.css">
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/core@latest/dist/tiptap-core.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/starter-kit@latest/dist/tiptap-starter-kit.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/extension-link@latest/dist/tiptap-extension-link.umd.min.js"></script>
    <script>
    function tiptapEditor(editorId, initialContent) {
        return {
            editor: null,
            content: initialContent || '',
            editorId: editorId,
            fieldName: '',
            init() {
                // Retrouver le name de l'input hidden depuis le parent
                const el = document.getElementById(this.editorId);
                if (!el) return;
                const hiddenInput = this.$el.querySelector('input[type=hidden]');
                this.fieldName = hiddenInput ? hiddenInput.getAttribute(':name') || '' : '';

                this.editor = new window.TiptapCore.Editor({
                    element: el,
                    extensions: [
                        window.TiptapStarterKit.StarterKit,
                        window.TiptapExtensionLink.Link.configure({ openOnClick: false }),
                    ],
                    content: this.content,
                    editorProps: { attributes: { class: 'outline-none' } },
                    onUpdate: ({ editor }) => { this.content = editor.getHTML(); },
                });
            },
            exec(cmd) {
                if (!this.editor) return;
                const chain = this.editor.chain().focus();
                const map = {
                    bold: () => chain.toggleBold().run(),
                    italic: () => chain.toggleItalic().run(),
                    strike: () => chain.toggleStrike().run(),
                    h2: () => chain.toggleHeading({level:2}).run(),
                    h3: () => chain.toggleHeading({level:3}).run(),
                    ul: () => chain.toggleBulletList().run(),
                    ol: () => chain.toggleOrderedList().run(),
                    blockquote: () => chain.toggleBlockquote().run(),
                    hr: () => chain.setHorizontalRule().run(),
                    undo: () => this.editor.chain().focus().undo().run(),
                    redo: () => this.editor.chain().focus().redo().run(),
                    clear: () => chain.clearNodes().unsetAllMarks().run(),
                };
                map[cmd]?.();
            },
            isActive(cmd) {
                if (!this.editor) return false;
                const map = {
                    bold: () => this.editor.isActive('bold'),
                    italic: () => this.editor.isActive('italic'),
                    strike: () => this.editor.isActive('strike'),
                    h2: () => this.editor.isActive('heading', {level:2}),
                    h3: () => this.editor.isActive('heading', {level:3}),
                    ul: () => this.editor.isActive('bulletList'),
                    ol: () => this.editor.isActive('orderedList'),
                    blockquote: () => this.editor.isActive('blockquote'),
                };
                return map[cmd]?.() ?? false;
            },
            addLink() {
                const url = prompt('URL du lien :');
                if (url) this.editor.chain().focus().setLink({ href: url }).run();
            },
        };
    }
    </script>
    @endpush
    @endonce
</div>
