@extends('siswa.template')
@section('warna','blue')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/event.css')}}">
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
@endsection

@section('menu')
<div class="categories-wrapper light-blue darken-3" style="height: 48px">
  <div class="categories-container">
    <div class="container">
     <a href="{{url('siswa')}}" class="breadcrumb">Home</a>
     <a href="{{url('siswa/artikel')}}" class="breadcrumb">Artikel</a>
     <a href="#!" class="breadcrumb">Tambah</a>
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="portfolio" class="section white">
<div class="container">
  <div id="dasbord" class="col s12">
    <form method="POST" action="{{route('artikel.siswa.tambah')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-field col s12">
          <input id="nim" type="text" class="validate" name="judul" value="{{old('judul')}}">
          <label for="nim">Judul Artikel</label>
          @if ($errors->has('judul'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('judul') }}</strong>
              </span>
          @endif
        </div>
        <div class="row">
            <div class="col m6 s12">
               <div class="input-field">
                  <input id="tag" type="text" class="validate" name="tag" value="{{old('tag')}}">
                  <label for="tag">Tag / Kategori</label>
                  @if ($errors->has('tag'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tag') }}</strong>
                    </span>
                @endif
                </div>
                <div class="input-field">
                  <textarea id="textarea1" class="materialize-textarea" name="text_pembuka"></textarea>
                  <label for="textarea1">Teks Pembuka</label>
                  @if ($errors->has('text_pembuka'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('text_pembuka') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <div class="col m6 s12">
              <div class="file-field input-field">
                <div class="btn blue">
                  <span>Upload</span>
                  <input type="file" name="lampiran"  onchange="fotoURl(this)" >
                </div>
                @if ($errors->has('lampiran'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lampiran') }}</strong>
                    </span>
                @endif
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Gambar">
                </div>
                <img class="img img-thumbnail" height="100px" id="gambar">
              </div>
            </div>
        </div>
       
        <div class="input-field col s12">
          <textarea name="artikel" required>{{old('artikel')}}</textarea>
          @if ($errors->has('artikel'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('artikel') }}</strong>
              </span>
          @endif
        </div>
        <div class="row"><br>
        <button type="submit" class="col s12 btn blue">Kirim</button>
        </div>
  </div>
  </div>
</div>
@endsection

@section('script')
<script>
    CKEDITOR.replace( 'artikel', {
    // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
    // The full preset from CDN which we used as a base provides more features than we need.
    // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
    toolbar: [
      { name: 'document', items: [ 'Print' ] },
      { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
      { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
      { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
      { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
      { name: 'links', items: [ 'Link', 'Unlink' ] },
      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
      { name: 'insert', items: [ 'Image', 'Table' ] },
      { name: 'tools', items: [ 'Maximize' ] },
      { name: 'editing', items: [ 'Scayt' ] }
    ],
    // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
    // One HTTP request less will result in a faster startup time.
    // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
    customConfig: '',
    // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
    // For more information check:
    //  - About Advanced Content Filter: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_advanced_content_filter
    //  - About Disallowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_disallowed_content
    //  - About Allowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_allowed_content_rules
    disallowedContent: 'img{width,height,float}',
    extraAllowedContent: 'img[width,height,align]',
    // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
    extraPlugins: 'tableresize,uploadimage,uploadfile',
    /*********************** File management support ***********************/
    // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
    // solution with file upload/management capabilities, like for example CKFinder.
    // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration
    // Uncomment and correct these lines after you setup your local CKFinder instance.
    // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
    // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    /*********************** File management support ***********************/
    // Make the editing area bigger than default.
    height: 800,
    // An array of stylesheets to style the WYSIWYG area.
    // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'mystyles.css' ],
    // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
    bodyClass: 'document-editor',
    // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
    format_tags: 'p;h1;h2;h3;pre',
    // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
    removeDialogTabs: 'image:advanced;link:advanced',
    // Define the list of styles which should be available in the Styles dropdown list.
    // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
    // (and on your website so that it rendered in the same way).
    // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
    // that file, which means one HTTP request less (and a faster startup).
    // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
    stylesSet: [
      /* Inline Styles */
      { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
      { name: 'Cited Work', element: 'cite' },
      { name: 'Inline Quotation', element: 'q' },
      /* Object Styles */
      {
        name: 'Special Container',
        element: 'div',
        styles: {
          padding: '5px 10px',
          background: '#eee',
          border: '1px solid #ccc'
        }
      },
      {
        name: 'Compact table',
        element: 'table',
        attributes: {
          cellpadding: '5',
          cellspacing: '0',
          border: '1',
          bordercolor: '#ccc'
        },
        styles: {
          'border-collapse': 'collapse'
        }
      },
      { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
      { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
    ]
  } );
   function fotoURl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
<script type="text/javascript">
  $(document).ready(function() {
    @if(Session::has('berhasil'))
      Materialize.toast('{{ Session::get('berhasil') }}', 4000);
    @endif
  });
</script>
@endsection