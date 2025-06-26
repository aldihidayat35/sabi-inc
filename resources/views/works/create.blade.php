@extends('layouts.app')

@section('title', 'Add Work')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('works.index') }}" class="text-gray-600 text-hover-primary">Works</a>
        </li>
        <li class="breadcrumb-item active">Add Work</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Add Work</h1>
    <p class="text-muted">Fill in the details to add a new work.</p>
</div>
<!--end::Page Header-->

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('works.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter work title" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Categories</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($categories as $category)
                            <div class="form-check me-3">
                                <input type="checkbox" name="category_ids[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="form-check-input">
                                <label for="category_{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('category_ids')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter description"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_photo" class="form-label fw-bold">Cover Photo</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control">
                @error('cover_photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Content</label>
                <textarea name="content" id="content" class="form-control" placeholder="Enter content here..."></textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Publish">Publish</option>
                        <option value="Draft">Draft</option>
                        <option value="Suspend">Suspend</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="suspend_note" class="form-label fw-bold">Suspend Note</label>
                    <textarea name="suspend_note" id="suspend_note" class="form-control" placeholder="Enter suspend note (if applicable)"></textarea>
                    @error('suspend_note')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include CKEditor Classic Build -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize CKEditor Classic with custom image upload adapter
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'link', '|',
                    'alignment', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells'
                    ]
                },
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                },
                simpleUpload: {
                    uploadUrl: '/upload-image', // Replace with your server endpoint
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                    }
                }
            })
            .then(editor => {
                console.log('CKEditor initialized successfully.');
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });
    });
</script>
@endsection
