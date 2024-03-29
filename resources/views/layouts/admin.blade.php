<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet"/>
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>

    @yield('styles')

</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    @include('admin.partials.menu')

    <div class="content-wrapper" style="min-height: 917px;">
        <!-- Main content -->
        <section class="content" style="padding-top: 20px">
            @if(session('message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
            @endif

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong> &copy;</strong> {{ trans('global.allRightsReserved') }}
    </footer>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var arrDropZones = [];

    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Перетащите сюда файлы для загрузки";
    Dropzone.prototype.defaultOptions.dictFallbackMessage = "Ваш браузер не поддерживает загрузку файлов drag'n'drop.";
    Dropzone.prototype.defaultOptions.dictFallbackText = "Пожалуйста, используйте резервную форму ниже, чтобы загружать свои файлы, как в былые времена.";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "Файл слишком большой (@{{filesize}} Мб). Максимальный размер файла: @{{maxFilesize}} Мб.";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "Вы не можете загружать файлы этого типа.";
    Dropzone.prototype.defaultOptions.dictResponseError = "Сервер ответил кодом @{{statusCode}}.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "отменить загрузку";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Вы уверены, что хотите отменить это загрузки?";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "удалить файл";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "Вы не можете загружать несколько файлов.";

    $(function () {
        tinymce.init({
            language: "ru",
            selector: '.tinymceTextarea',
            plugins: "code,link,lists",
            themes: "modern",
            valid_elements : '*',
            valid_styles: '*',
            extended_valid_elements: "*[*]",
            // extended_valid_elements: "svg[*],defs[*],pattern[*],desc[*],metadata[*],g[*],mask[*],path[*],line[*],marker[*],rect[*],circle[*],ellipse[*],polygon[*],polyline[*],linearGradient[*],radialGradient[*],stop[*],image[*],view[*],text[*],textPath[*],title[*],tspan[*],glyph[*],symbol[*],switch[*],use[*]",
            height: 300,
            toolbar: "code | insertfile undo redo | link | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });

        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

        let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
            'ru': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json',
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {className: 'btn'})
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
                style: 'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                    extend: 'selectAll',
                    className: 'btn-primary',
                    text: selectAllButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'selectNone',
                    className: 'btn-primary',
                    text: selectNoneButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    className: 'btn-default',
                    text: copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-default',
                    text: csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    text: excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-default',
                    text: printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

    let index = 1;

    /**
     * @param name
     * @param container
     * @param type
     */
    function renderSmartLink(name, container, type = 'site') {
        let str = '<div class="row" style="margin-top: 15px;">';
        let classRows = 'col-md-6 col-sm-6 col-xs-6';
        if (type === 'all') {
            classRows = 'col-md-4 col-sm-4 col-xs-4'
        }

        str += '<div class="' + classRows +'">';
        str += '<input name="' + name + '[url][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_url') }}">';
        str += '</div>';

        str += '<div class="' + classRows +'">';
        str += '<input name="' + name + '[title][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_title') }}">';
        str += '</div>';

        if (type === 'all') {
            let options = '';
            @foreach(['site', 'phone', 'vk', 'viber', 'whatsapp', 'telegram', 'email'] as $name)
                options += '<option value=' + '{{ $name }}' + '>' + '{{ $name }}' + '</option>';
            @endforeach

                str += '<div class="' + classRows +'">';
            str += '<select name="' + name + '[type][' + index + ']" class="form-control">' + options + ' </select>';
            str += '</div>';
        } else {
            str += '<input type="hidden" name="' + name + '[type][' + index + ']" value="' + type + '" />';
        }

        str += '</div>';

        container.append(str);

        index++;
    }

    /**
     * @param name
     * @param container
     * @param type
     */
    function renderPhone(name, container, type = 'phone') {
        let str = '<div class="row" style="margin-top: 15px;">';

        str += '<div class="col-md-12 col-sm-12 col-xs-12">';
        str += '<input name="' + name + '[url][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_phone') }}">';
        str += '</div>';

        str += '<input type="hidden" name="' + name + '[type][' + index + ']" value="' + type + '" />';

        str += '</div>';

        container.append(str);

        index++;
    }

    /**
     * @param name
     * @param container
     * @param type
     */
    function renderLinkPhone(name, container, type = 'phone') {
        let str = '<div class="row" style="margin-top: 15px;">';

        str += '<div class="col-md-6 col-sm-6 col-xs-6">';
        str += '<input name="' + name + '[url][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_phone') }}">';
        str += '</div>';

        str += '<div class="col-md-6 col-sm-6 col-xs-6">';
        str += '<input name="' + name + '[title][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_name') }}">';
        str += '</div>';

        str += '<input type="hidden" name="' + name + '[type][' + index + ']" value="' + type + '" />';

        str += '</div>';

        container.append(str);

        index++;
    }

    /**
     * @param name
     * @param container
     * @param type
     */
    function renderAddress(name, container, type = 'site') { // ToDo change type for text
        let str = '<div class="row" style="margin-top: 15px;">';

        str += '<div class="col-md-12 col-sm-12 col-xs-12">';
        str += '<input name="' + name + '[title][' + index + ']" class="form-control" type="text" placeholder="{{ __('global.input_address') }}">';
        str += '</div>';

        str += '<input type="hidden" name="' + name + '[type][' + index + ']" value="' + type + '" />';

        str += '</div>';

        container.append(str);

        index++;
    }

</script>
<script src="{{ asset('js/adminltev3.js') }}"></script>

@yield('scripts')

</body>

</html>
