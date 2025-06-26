@extends('layouts.app')

@section('title', 'Materials')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Materials</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="text-dark fw-bold">Materials</h1>
        <p class="text-muted">Browse materials grouped by topics.</p>
    </div>
    <div>
        <form id="createMaterialForm" method="GET" class="d-inline">
            <select name="topic_id" id="topic_id" class="form-select d-inline w-auto">
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary" onclick="redirectToCreateMaterial()">Create Material</button>
        </form>
    </div>
</div>
<!--end::Page Header-->

<div class="accordion m-4" id="topicsAccordion">
    @foreach ($topics as $topic)
        <div class="card shadow-sm mb-7 border-0">
            <div class="card-body p-4 topic-card" 
             data-bs-toggle="collapse" 
             data-bs-target="#collapse{{ $topic->id }}" 
             aria-expanded="false" 
             aria-controls="collapse{{ $topic->id }}" 
             style="cursor:pointer;">
            <div class="d-flex align-items-center">
                <!--begin::foto cover-->
                <div class="symbol symbol-60px symbol-2by3 me-4 flex-shrink-0">
                @if ($topic->cover_photo)
                    <div class="symbol-label rounded" style="background-image: url('{{ asset($topic->cover_photo) }}'); background-size: cover;"></div>
                @else
                    <div class="symbol-label bg-light rounded d-flex align-items-center justify-content-center" style="height: 100%;">
                    <span class="text-muted small">No Image</span>
                    </div>
                @endif
                </div>
                <!--begin::Title-->
                <div class="flex-grow-1">
                <span class="text-gray-800 fw-bold text-hover-primary fs-5">{{ $topic->title }}</span>
                <div class="text-muted fw-semibold pt-1 mb-2">{{ $topic->description }}</div>
                <span class="badge badge-light-primary fs-8 fw-bold">{{ $topic->materials->count() }} Materials</span>
                </div>
            </div>
            <div class="collapse mt-4" id="collapse{{ $topic->id }}" data-bs-parent="#topicsAccordion">
                @if ($topic->materials->isEmpty())
                <p class="text-muted mb-0">No materials available for this topic.</p>
                @else
                @foreach ($topic->materials as $material)
                    <!--begin::Item-->
                    <div class="card mb-3 border-0 bg-light ms-8 material-card" 
                     style="cursor:pointer;" 
                     onclick="window.location='{{ route('materials.show', $material->id) }}'">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="symbol symbol-50px symbol-2by3 me-3 flex-shrink-0">
                        @if ($material->cover_photo)
                            <div class="symbol-label rounded" style="background-image: url('{{ asset($material->cover_photo) }}'); background-size: cover;"></div>
                        @else
                            <div class="symbol-label bg-white rounded d-flex align-items-center justify-content-center" style="height: 100%;">
                            <span class="text-muted small">No Image</span>
                            </div>
                        @endif
                        </div>
                        <div class="flex-grow-1">
                        <span class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $material->title }}</span>
                        <div class="text-muted fw-normal small pt-1">{{ Str::limit($material->abstract, 120) }}</div>
                        </div>
                        <span class="badge badge-light-success fs-8 fw-bold ms-2">{{ $material->reward_diamond }} Diamonds</span>
                    </div>
                    </div>
                    <!--end::Item-->
                @endforeach
                @endif
            </div>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        // Prevent collapse toggle when clicking on links inside the card
        document.querySelectorAll('.topic-card a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        });

        // Prevent collapse toggle when clicking on material card
        document.querySelectorAll('.material-card').forEach(function(card) {
        card.addEventListener('click', function(e) {
            // allow navigation, but prevent collapse toggle
            e.stopPropagation();
        });
        });
    </script>

<script>
    function redirectToCreateMaterial() {
        const topicId = document.getElementById('topic_id').value;
        const form = document.getElementById('createMaterialForm');
        form.action = `/topics/${topicId}/materials/create`;
        form.submit();
    }
</script>
@endsection
