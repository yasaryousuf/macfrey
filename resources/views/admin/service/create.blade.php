@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Service form</h4>
                <p class="card-description">
                    Add service
                </p>
                <form action="{{url('service')}}" method="POST" name="create-service">
                    @csrf
                    <div class="form-group">
                        <label for="service-name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" id="service-name" required>
                    </div>
                    <div class="form-group">
                        <label for="service-slug">Slug</label>
                        <input type="text" class="form-control" placeholder="Slug" name="slug" id="service-slug" required>
                    </div>

                    <div class='form-group'>
                        <label>Content</label>
                        <div class="service-content">
                        </div>

                    </div>
                    <textarea name="content" style="display:none" id="service-content-html"></textarea>
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
    var quill = new Quill('.service-content', {
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
    $('[name="create-service"]').on("submit", function(e) {
        $("#service-content-html").val($(".service-content").find('.ql-editor').html());
    })
</script>
@endsection