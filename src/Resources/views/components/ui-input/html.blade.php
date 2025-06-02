@props([
    "id" => generateId(),
	"name" => '',
	"value" => '',
	"type" => null,
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"short" => false,
	"menubar" => false,
	"templates" => [],
	"wireTarget" => null,
])

@if($label)
    <label for="{{ $id }}" class="@if(!!$required) required @endif">{!! __($label) !!}</label>
@endif
<textarea class="tinymce" name="{{ $name }}" id="{{ $id }}" {{ $attributes }}>@php echo $value @endphp</textarea>

@pushonce('script-lib')
    <script src="{{ asset('assets/js/libs/tinymce/tinymce.min.js') }}"></script>
@endpushonce
@push('script')
    <script>
        if(typeof initTinymce !== 'function') {
            function initTinymce(target_id) {
                tinymce.init({
                    selector: '#' + target_id,
                    statusbar: false,
                    menubar: @json($menubar),

                    @if(!$short)

                    plugins: 'preview case importcss searchreplace autolink autosave directionality visualblocks visualchars fullscreen image link media template codesample table charmap  nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars emoticons code',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor case removeformat | charmap emoticons | insertfile image media link anchor codesample | a11ycheck ltr rtl | showcomments addcomment | fullscreen  preview  code',
                    quickbars_selection_toolbar: 'bold italic underline strikethrough | quicklink h2 h3 blockquote | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | case',
                    quickbars_insert_toolbar: 'template image table',
                    templates: @json($templates),
                    toolbar_mode: 'sliding',
                    autosave_ask_before_unload: true,
                    autosave_interval: '30s',
                    autosave_prefix: '{path}{query}-{id}-',
                    autosave_restore_when_empty: false,
                    autosave_retention: '2m',

                    @else

                    plugins: 'lists autoresize',
                    toolbar: 'bold italic h2 h3 numlist bullist blockquote hr undo redo',

                    @endif

                    autoresize: 'on',
                    images_upload_url: '/api/images/editor',
                    image_title: true,
                    relative_urls: false,
                    remove_script_host: false,
                    convert_urls: false,
                    images_upload_base_path: '/',

                    @isset($wireTarget)

                    setup: function (editor) {
                        editor.on('change', function (e) {
                            @this.
                            set('{{ $wireTarget }}', editor.getContent());
                            Livewire.hook('morph.updated', () => initTinymce(target_id))
                        });
                    }

                    @endisset

                });
            }
            document.addEventListener('DOMContentLoaded', initTinymce('{{ $id }}'))
        }

    </script>
@endpush
