@extends('layouts.app')

@section('title', 'Edit Material')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('topics.show', $material->topic_id) }}" class="text-gray-600 text-hover-primary">{{ $material->topic->title }}</a>
        </li>
        <li class="breadcrumb-item active">Edit Material</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Edit Material</h1>
    <p class="text-muted">Update the details of the selected material.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $material->title }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="abstract" class="form-label fw-bold">Abstract</label>
                <textarea name="abstract" id="abstract" class="form-control">{{ $material->abstract }}</textarea>
                @error('abstract')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="reward_diamond" class="form-label fw-bold">Reward Diamond</label>
                <input type="number" name="reward_diamond" id="reward_diamond" class="form-control" value="{{ $material->reward_diamond }}" required>
                @error('reward_diamond')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Content</label>
                <textarea name="content" id="content" class="form-control" placeholder="Enter content here...">{{ $material->content }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_photo" class="form-label fw-bold">Cover Photo</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control">
                @if ($material->cover_photo)
                    <img src="{{ asset($material->cover_photo) }}" alt="Cover Photo" class="img-thumbnail mt-2" width="150">
                @endif
                @error('cover_photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include CKEditor Classic Build -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize CKEditor Classic
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'link', 'imageUpload', '|',
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
