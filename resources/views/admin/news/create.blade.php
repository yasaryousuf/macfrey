@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">News form</h4>
                <p class="card-description">
                    Add latest news
                </p>
                <form action="{{url('news')}}" method="POST" name="create-news" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control" placeholder="Name" name="title" required>
                    </div>
                    <img id="news-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('news-image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group news-content">
                    </div>
                    <textarea name="content" style="display:none" id="news-content-html"></textarea>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('.news-content', {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

                ['clean'],
                ['image', 'code-block'] // remove formatting button
            ],
        },
        placeholder: 'Compose an epic...',
        theme: 'snow' // or 'bubble'
    });
    $('[name="create-news"]').on("submit", function(e) {
        $("#news-content-html").val($(".news-content").find('.ql-editor').html());
    })
</script>
@endsection