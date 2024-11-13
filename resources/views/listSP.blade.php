@extends('layout')

@section('title', 'Danh sách sản phẩm')

@section('content')
@foreach ( $hoa as $hoa)

<div class="col-lg-4 col-md-6 col-12">
    <div class="menu-thumb">
        <div class="menu-image-wrap">
            <a href="{{ route('hoas.detail', $hoa->id) }}"><img src="images/breakfast/brett-jordan-8xt8-HIFqc8-unsplash.jpg" class="img-fluid menu-image" alt=""></a>
            
            <img src="" alt="">
            <span class="menu-tag bg-warning">50%</span>
        </div>

        <div class="menu-info d-flex flex-wrap align-items-center">
            <h4 class="mb-0">{{ $hoa->title }}</h4>

            <span class="price-tag bg-white shadow-lg ms-4">{{ $hoa->price }}</span>

            <div class="d-flex flex-wrap align-items-center w-100 mt-2">
                <h6 class="reviews-text mb-0 me-3">4.3/5</h6>

                <div class="reviews-stars">
                    <i class="bi-star-fill reviews-icon"></i>
                    <i class="bi-star-fill reviews-icon"></i>
                    <i class="bi-star-fill reviews-icon"></i>
                    <i class="bi-star-fill reviews-icon"></i>
                    <i class="bi-star reviews-icon"></i>
                </div>


            </div>
        </div>
    </div>
</div>
    
@endforeach



@endsection