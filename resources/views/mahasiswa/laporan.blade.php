@extends('layouts.app')

@section('title', 'Draft Laporan Akhir')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1 italic">
            Digital Report Editor 📄
        </h2>
        <p class="text-gray-500 font-medium text-sm">Tulis laporan akhir Anda dengan pengalaman layaknya Google Docs.</p>
    </div>
    <div class="flex gap-2">
        <div class="px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl flex items-center gap-3">
            <div class="w-2 h-2 rounded-full {{ $laporan && !$laporan->is_draft ? 'bg-green-500' : 'bg-orange-500 animate-pulse' }}"></div>
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">
                Status: {{ $laporan ? ($laporan->is_draft ? 'Drafting' : 'Submitted') : 'New Document' }}
            </span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-20 px-4 sm:px-6">
    <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" id="docForm">
        @csrf
        <input type="hidden" name="id_magang" value="{{ Auth::user()->mahasiswa->pesertaMagang->id_magang }}">
        
        <div class="flex flex-col gap-8">
            <!-- Header Info -->
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 transition-all hover:shadow-md">
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1 italic">Judul Laporan</label>
                    <input type="text" name="judul" value="{{ old('judul', $laporan->judul ?? '') }}" 
                        placeholder="Contoh: LAPORAN AKHIR MAGANG PT. GOJEK INDONESIA..."
                        class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xl md:text-2xl font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 transition-all outline-none placeholder:text-gray-300"
                        {{ $laporan && !$laporan->is_draft ? 'readonly' : '' }} required>
                </div>
            </div>

            <!-- Editor Workspace -->
            <div class="flex flex-col gap-0 shadow-2xl rounded-[2rem] overflow-hidden border border-gray-200">
                <!-- Toolbar Container -->
                <div id="toolbar-container" class="bg-white border-b border-gray-100 z-30 sticky top-4 mx-4 my-4 rounded-2xl shadow-xl"></div>

                <!-- Scrollable Container for Page -->
                <div class="bg-gray-100/80 p-4 md:p-12 min-h-[900px] flex justify-center">
                    <!-- The Page -->
                    <div class="w-full max-w-[850px] bg-white shadow-lg min-h-[1100px] p-16 md:p-24 prose prose-slate max-w-none focus:outline-none" id="editor">
                        {!! old('konten', $laporan->konten ?? '') !!}
                    </div>
                </div>
            </div>
            
            <textarea name="konten" id="hidden-konten" class="hidden"></textarea>

            <!-- Status & Actions -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                 <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-primary shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div class="text-[11px] text-gray-400 font-bold leading-tight">
                        Dokumen ini tersimpan secara lokal di browser Anda. <br>
                        Pastikan klik "Kirim" setelah selesai menyusun laporan.
                    </div>
                 </div>

                 <div class="flex gap-4 w-full md:w-auto">
                    @if(!$laporan || $laporan->is_draft)
                    <button type="submit" name="save_draft" value="1" class="btn h-14 px-8 bg-white hover:bg-gray-50 text-gray-600 border-2 border-gray-100 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all flex-1 md:flex-none">
                        Simpan Draf
                    </button>
                    <button type="submit" name="submit_final" value="1" class="btn h-14 px-10 bg-primary hover:bg-purple-700 text-white border-none rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-2xl shadow-purple-200 flex-1 md:flex-none transition-all">
                        Kirim Laporan
                    </button>
                    @else
                    <div class="h-14 px-10 bg-green-50 text-green-600 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center gap-3 border border-green-100">
                        Laporan Selesai ✓
                    </div>
                    @endif
                 </div>
            </div>
        </div>
    </form>
</div>

<style>
    /* Styling khusus agar editor benar-benar mirip Word */
    .ck-editor__editable_inline {
        min-height: 1000px !important;
        border: none !important;
        padding: 0 !important;
    }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: transparent !important;
    }
    .ck-toolbar {
        border: none !important;
        border-radius: 1rem !important;
    }
    #editor {
        font-family: 'Times New Roman', serif; /* Font standard laporan */
        font-size: 12pt;
        line-height: 1.5;
        color: #000;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: 'Mulai menulis isi laporan di sini...',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@blackberry', '@bread', '@carrot', '@cars', '@cat', '@cherry', '@cloud', '@cow', '@dog', '@elephant', '@fruit', '@fox', '@gears', '@grapes', '@ice', '@lemon', '@lion', '@melon', '@monkeys', '@orange', '@pear', '@pineapple', '@pizza', '@potatoes', '@rabbit', '@sand', '@sheep', '@strawberry', '@sun', '@tomato', '@trolley', '@wheat'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeDeviceTracking',
                'RealTimeCollaboration',
                'RealTimeCollaborationRevisionHistory',
                'RealTimeCollaborationComments',
                'RealTimeCollaborationTrackChanges',
                'RealTimeCollaborationPresenceList',
                'RealTimeCollaborationNotifications',
                'Title',
                'CloudServices',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'CaseChange',
                'AIAssistant'
            ]
        })
        .then(editor => {
            const toolbarContainer = document.querySelector('#toolbar-container');
            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            @if($laporan && !$laporan->is_draft)
                editor.enableReadOnlyMode('view-only');
            @endif

            const form = document.querySelector('#docForm');
            form.addEventListener('submit', () => {
                document.querySelector('#hidden-konten').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
