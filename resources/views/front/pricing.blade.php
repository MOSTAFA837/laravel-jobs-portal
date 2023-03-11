@extends('front.layout.app')

{{-- @section('seo_title')
    {{ $pricing_page_item->title }}
@endsection --}}
{{-- @section('seo_meta_description')
    {{ $pricing_page_item->meta_description }}
@endsection --}}

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Pricing</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content pricing">
        <div class="container">
            <div class="row pricing">
                @foreach ($packages as $item)
                    <div class="col-lg-4 mb_30">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h2 class="card-title">{{ $item->package_name }}</h2>
                                <h3 class="card-price">${{ $item->package_price }}</h3>
                                <h4 class="card-day">({{ $item->package_display_time }})</h4>
                                <hr />
                                <ul class="fa-ul">
                                    <li>
                                        @php
                                            if ($item->total_allowed_jobs == -1) {
                                                $text = 'Unlimited';
                                                $icon_code = 'fas fa-check';
                                            } elseif ($item->total_allowed_jobs == 0) {
                                                $text = 'No';
                                                $icon_code = 'fas fa-times';
                                            } else {
                                                $text = $item->total_allowed_jobs;
                                                $icon_code = 'fas fa-check';
                                            }
                                        @endphp

                                        <span class="fa-li"><i class="{{ $icon_code }}"></i></span>
                                        {{ $text }} Jobs Post Allowed
                                    </li>
                                    <li>
                                        @php
                                            if ($item->total_allowed_featured_jobs == -1) {
                                                $text = 'Unlimited';
                                                $icon_code = 'fas fa-check';
                                            } elseif ($item->total_allowed_featured_jobs == 0) {
                                                $text = 'No';
                                                $icon_code = 'fas fa-times';
                                            } else {
                                                $text = $item->total_allowed_featured_jobs;
                                                $icon_code = 'fas fa-check';
                                            }
                                        @endphp
                                        <span class="fa-li"><i class="{{ $icon_code }}"></i></span>
                                        {{ $text }} Featured Job
                                    </li>
                                    <li>
                                        @php
                                            if ($item->total_allowed_photos == -1) {
                                                $text = 'Unlimited';
                                                $icon_code = 'fas fa-check';
                                            } elseif ($item->total_allowed_photos == 0) {
                                                $text = 'No';
                                                $icon_code = 'fas fa-times';
                                            } else {
                                                $text = $item->total_allowed_photos;
                                                $icon_code = 'fas fa-check';
                                            }
                                        @endphp
                                        <span class="fa-li"><i class="{{ $icon_code }}"></i></span>
                                        {{ $text }} Company Photos
                                    </li>
                                    <li>
                                        @php
                                            if ($item->total_allowed_videos == -1) {
                                                $text = 'Unlimited';
                                                $icon_code = 'fas fa-check';
                                            } elseif ($item->total_allowed_videos == 0) {
                                                $text = 'No';
                                                $icon_code = 'fas fa-times';
                                            } else {
                                                $text = $item->total_allowed_videos;
                                                $icon_code = 'fas fa-check';
                                            }
                                        @endphp
                                        <span class="fa-li"><i class="{{ $icon_code }}"></i></span>
                                        {{ $text }} Company Videos
                                    </li>
                                </ul>
                                <div class="buy">
                                    <a href="" class="btn btn-primary">Choose Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
