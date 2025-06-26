@extends('frontend.layouts.app')

@section('title', 'Tentang SABI')

@section('content')
<div style="background:#d2bba3;">
    <div class="container px-0" style="max-width:430px;">
        <div class="py-4 px-3 d-flex align-items-center">
            <a href="{{ url()->previous() }}" class="btn btn-link p-0 me-2" style="font-size:1.5rem;color:#795548;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-bold flex-grow-1 text-center" style="color:#795548;letter-spacing:0.5px;">Tentang SABI</h5>
            <span style="width:2.5rem;"></span>
        </div>
        <div class="d-flex flex-column align-items-center pb-4 pt-2">
            <img src="https://img.icons8.com/ios-filled/100/795548/idea.png" alt="SABI Logo" style="width:70px;height:70px;">
            <div class="fw-bold mt-2 mb-1" style="font-size:1.3rem;color:#795548;letter-spacing:1px;">SABI, INC.</div>
        </div>
    </div>
</div>
<div class="container px-0" style="max-width:430px;">
    <div class="bg-white px-4 py-4" style="border-radius:0 0 18px 18px;">
        <div style="color:#795548;font-size:1.05rem;line-height:1.7;">
            <p class="mb-2">
                <b>SABI</b> (Sastra Bicara) Merupakan Sebuah Aplikasi Android yang dirancang khusus untuk mengembangkan kemampuan menulis siswa terutama dalam lingkup teks sastra. Ada beragam fitur yang dapat digunakan dan diintegrasikan secara langsung kepada pengajar sehingga dapat menilai lembar kerja siswa dengan mudah.
            </p>
            <p class="mb-0">
                Bersama aplikasi ini, kamu dapat membaca teks sastra yang dibuat oleh seluruh siswa dan dapat memberikan kontribusi berupa kritik, saran dan komentar untuk saling berkolaborasi meningkatkan kemampuan dalam keterampilan menulis.
            </p>
        </div>
    </div>
</div>
@endsection
