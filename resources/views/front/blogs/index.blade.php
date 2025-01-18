@extends('front.fixe')
@section('titre', 'Blogs')
@section('body')

    <main>
        @php
            $config = DB::table('configs')->first();
            $service = DB::table('services')->get();
            $sponsors = DB::table('sponsors')->get();

        @endphp



        <main>
     <!-- breadcrumb area start -->
<style>
  
.responsive-background {
    background-size: cover;      /* Ensure the image covers the entire container */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    width:auto;                 /* Ensure the container is full width */
    height: auto;                /* Let the height adjust based on content */
    min-height: 100px;           /* Set a minimum height if needed */
}



@media (max-width: 768px) {
    .tp-footer-bg {
        height: 200px; /* Ajuste la hauteur pour les petits écrans */
    }

}

</style>
<div class=" tp-footer-bg breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix responsive-background"
     data-background="{{ url('public/Image/parametres/' . $config->imageblog) }}">
    <div class="container">
        <div class="row">
            <!-- Utilisez des classes Bootstrap pour rendre la mise en page responsive -->
            <div class="col-12">
                <div class="breadcrumb__content z-index text-center">
                    <div class="breadcrumb__section-title-box">
                        <h3 class="breadcrumb__title">Nos  actualités</h3>
                    </div>
                    <div class="breadcrumb__list">
                        <span><a href="#">Accueil</a></span>
                        <span class="dvdr"><i>/</i></span>
                        <span><b>Actualités</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        {{--     <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix "
                data-background="{{ url('public/Image/parametres/' . $config->imageblog) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content z-index text-center">
                                <div class="breadcrumb__section-title-box">
                                    <h3 class="breadcrumb__title">Nos blogs</h3>
                                </div>
                                <div class="breadcrumb__list">
                                    <span><a href="#">Accueil</a></span>
                                    <span class="dvdr"><i>/</i></span>

                                    <span><b>Blogs</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- breadcrumb area end -->

            <!-- blog area start -->
            <div class="tp-blog-area tp-blog-style-2 tp-blog-style-4 pb-0 mb-150 p-relative fix z-index">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-blog-title-box text-center mb-60">
                                <span class="tp-section-subtitle">Les rescentes publicatiions </span>
                                {{-- <h4 class="tp-section-title">Latest Blog & News</h4> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($posts->isEmpty())
                            <div class="alert alert-info">
                                <p>Aucune publication n'est disponible pour le moment.</p>
                            </div>
                        @else
                            @foreach ($posts as $post)
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                                    <div class="tp-blog-item">
                                        <div class="tp-blog-thumb p-relative">
                                            <a href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}"{{-- href="{{ url('details-blog', $post->id) }}" --}}>
                                                <img class="w-100" width="200" height="300"
                                                    src="{{ url('public/Image/posts/' . $post->image) }}">
                                            </a>
                                        </div>
                                        <div class="tp-blog-content p-relative">
                                            <div class="tp-blog-meta mb-15">
                                                <span>
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M20 4.16667V2.08333C20 0.933329 19.0666 0 17.9167 0H2.08333C0.933329 0 0 0.933329 0 2.08333V4.16667H20ZM14.1667 1.66667C14.625 1.66667 15 2.03751 15 2.5C15 2.95835 14.625 3.33333 14.1667 3.33333C13.7083 3.33333 13.3333 2.95835 13.3333 2.5C13.3333 2.03751 13.7083 1.66667 14.1667 1.66667ZM5.83333 1.66667C6.29166 1.66667 6.66667 2.03751 6.66667 2.5C6.66667 2.95835 6.29166 3.33333 5.83333 3.33333C5.37498 3.33333 5 2.95835 5 2.5C5 2.03751 5.37498 1.66667 5.83333 1.66667Z"
                                                            fill="currentcolor" />
                                                        <path
                                                            d="M0 5V17.9167C0 19.0625 0.933329 20 2.08333 20H17.9167C19.0666 20 20 19.0625 20 17.9167V5H0ZM4.58333 17.5H2.5C2.27081 17.5 2.08333 17.3125 2.08333 17.0833C2.08333 16.85 2.27081 16.6667 2.5 16.6667H4.58333C4.81249 16.6667 5 16.85 5 17.0833C5 17.3125 4.81249 17.5 4.58333 17.5ZM4.58333 14.1667H2.5C2.27081 14.1667 2.08333 13.9792 2.08333 13.75C2.08333 13.5167 2.27081 13.3333 2.5 13.3333H4.58333C4.81249 13.3333 5 13.5167 5 13.75C5 13.9792 4.81249 14.1667 4.58333 14.1667ZM4.58333 10.8333H2.5C2.27081 10.8333 2.08333 10.6458 2.08333 10.4167C2.08333 10.1833 2.27081 10 2.5 10H4.58333C4.81249 10 5 10.1833 5 10.4167C5 10.6458 4.81249 10.8333 4.58333 10.8333ZM8.88748 17.5H6.80415C6.57499 17.5 6.38748 17.3125 6.38748 17.0833C6.38748 16.85 6.57499 16.6667 6.80415 16.6667H8.88748C9.12081 16.6667 9.30415 16.85 9.30415 17.0833C9.30415 17.3125 9.12081 17.5 8.88748 17.5ZM8.88748 14.1667H6.80415C6.57499 14.1667 6.38748 13.9792 6.38748 13.75C6.38748 13.5167 6.57499 13.3333 6.80415 13.3333H8.88748C9.12081 13.3333 9.30415 13.5167 9.30415 13.75C9.30415 13.9792 9.12081 14.1667 8.88748 14.1667ZM8.88748 10.8333H6.80415C6.57499 10.8333 6.38748 10.6458 6.38748 10.4167C6.38748 10.1833 6.57499 10 6.80415 10H8.88748C9.12081 10 9.30415 10.1833 9.30415 10.4167C9.30415 10.6458 9.12081 10.8333 8.88748 10.8333ZM13.1958 17.5H11.1125C10.8792 17.5 10.6958 17.3125 10.6958 17.0833C10.6958 16.85 10.8792 16.6667 11.1125 16.6667H13.1958C13.425 16.6667 13.6125 16.85 13.6125 17.0833C13.6125 17.3125 13.425 17.5 13.1958 17.5ZM13.6125 14.1667H10.6958V13.3333H13.6125V14.1667ZM13.1958 10.8333H11.1125C10.8792 10.8333 10.6958 10.6458 10.6958 10.4167C10.6958 10.1833 10.8792 10 11.1125 10H13.1958C13.425 10 13.6125 10.1833 13.6125 10.4167C13.6125 10.6458 13.425 10.8333 13.1958 10.8333ZM13.1958 7.5H11.1125C10.8792 7.5 10.6958 7.31249 10.6958 7.08333C10.6958 6.85 10.8792 6.66667 11.1125 6.66667H13.1958C13.425 6.66667 13.6125 6.85 13.6125 7.08333C13.6125 7.31249 13.425 7.5 13.1958 7.5ZM17.5 17.5H15.4167C15.1875 17.5 15 17.3125 15 17.0833C15 16.85 15.1875 16.6667 15.4167 16.6667H17.5C17.7292 16.6667 17.9167 16.85 17.9167 17.0833C17.9167 17.3125 17.7292 17.5 17.5 17.5ZM17.5 14.1667H15.4167C15.1875 14.1667 15 13.9792 15 13.75C15 13.5167 15.1875 13.3333 15.4167 13.3333H17.5C17.7292 13.3333 17.9167 13.5167 17.9167 13.75C17.9167 13.9792 17.7292 14.1667 17.5 14.1667ZM17.5 10.8333H15.4167C15.1875 10.8333 15 10.6458 15 10.4167C15 10.1833 15.1875 10 15.4167 10H17.5C17.7292 10 17.9167 10.1833 17.9167 10.4167C17.9167 10.6458 17.7292 10.8333 17.5 10.8333ZM17.5 7.5H15.4167C15.1875 7.5 15 7.31249 15 7.08333C15 6.85 15.1875 6.66667 15.4167 6.66667H17.5C17.7292 6.66667 17.9167 6.85 17.9167 7.08333C17.9167 7.31249 17.7292 7.5 17.5 7.5Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('D MMM YYYY') }}
                                                </span>
                                                </span>

                                                <span>
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18 0H2C0.9 0 0 0.9 0 2V14C0 15.1 0.9 16 2 16H16L20 20V2C20 0.9 19.1 0 18 0ZM16 12H4V10H16V12ZM16 9H4V7H16V9ZM16 6H4V4H16V6Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                    {{ $post->comments->count() }}
                                                </span>
                                            </div>
                                            <h4 class="tp-blog-title mb-20">
                                                <a class="text-anim-3"href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}">
                                                    <span>{{ $post->title }}</span>
                                                </a>
                                            </h4>
                                            <a class="tp-btn-border-sm" href="{{ url('details-blog', ['id' => $post->id, 'slug' => Str::slug(Str::limit($post->title, 10))]) }}">
                                                <span>Voir détails</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Afficher les liens de pagination -->
                            <div class="pagination-wrapper d-flex justify-content-center">
                                 {{ $posts->links('pagination::bootstrap-4') }} 
                            </div>

                        @endif

                    </div>
                   
                </div>
            </div>
            <!-- blog area end -->

            <!-- brand area start -->
            <div class="tp-brand-area tp-brand-bg" data-background="assets/img/shape/funfact/bg-3-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-brand-wrap">
                                <div class="swiper-container tp-brand-active">
                                    <div class="swiper-wrapper">
                                        @foreach ($sponsors as $sponsor)
                                            <div class="swiper-slide">
                                                <div class="tp-brand-thumb text-center">
                                                    <img class="w-100"
                                                        src="{{ url('public/Image/sponsors/' . $sponsor->image) }}"
                                                        width="150" height="150" alt="">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand area end -->

            <!-- contact area start -->
            <div class="tp-contact-2-area theme-bg-2 pt-75 pb-55 z-index">
                <div class="container">
                    <div class="tp-contact-2-bg white-bg tp-contact-2-style-2">
                        <div class="row align-items-center">
                            <div class="col-xl-4 d-none d-xl-block">
                                <div class="tp-contact-2-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ url('public/Image/parametres/' . $config->logo) }}" width="80"
                                            height="80" alt="logo footer">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="tp-contact-2-right">
                                    <div
                                        class="tp-contact-2-right-content d-flex align-items-center justify-content-between">
                                        <div class="tp-contact-2-box p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="13" height="18" viewBox="0 0 13 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Phone:</span>
                                                <a class="text-anim-2" href="#">{{ $config->telephone ?? ' ' }}</a>
                                            </div>
                                        </div>
                                        <div class="tp-contact-2-box p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z"
                                                            fill="currentcolor" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Email:</span>
                                                <a class="text-anim-2"
                                                    href="mailto:manhhachkt08@gmail.com">{{ $config->email ?? ' ' }}</a>
                                            </div>
                                        </div>
                                        <div class="tp-contact-2-box location p-relative">
                                            <div class="tp-contact-2-icon">
                                                <span>
                                                    <svg width="16" height="20" viewBox="0 0 16 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 10.834C9.38071 10.834 10.5 9.7147 10.5 8.33398C10.5 6.95327 9.38071 5.83398 8 5.83398C6.61929 5.83398 5.5 6.95327 5.5 8.33398C5.5 9.7147 6.61929 10.834 8 10.834Z"
                                                            stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M8.00065 1.66699C6.23254 1.66699 4.53685 2.36937 3.28661 3.61961C2.03636 4.86986 1.33398 6.56555 1.33398 8.33366C1.33398 9.91033 1.66898 10.942 2.58398 12.0837L8.00065 18.3337L13.4173 12.0837C14.3323 10.942 14.6673 9.91033 14.6673 8.33366C14.6673 6.56555 13.9649 4.86986 12.7147 3.61961C11.4645 2.36937 9.76876 1.66699 8.00065 1.66699Z"
                                                            stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-contact-2-text">
                                                <span>Location:</span>
                                                <a class="text-anim-2" href="#"
                                                    target="_blank">{{ $config->addresse ?? ' ' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contact area end -->


        </main>
    </main>
@endsection
