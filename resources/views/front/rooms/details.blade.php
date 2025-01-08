@extends('front.fixe')
@section('titre', 'Détails')
@section('body')

<main>
    @php
    $config = DB::table('configs')->first();

    @endphp


    <main>


        <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix" data-background="/assets/img/breadcrumb/breadcrumb.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__content z-index text-center">
                            <div class="breadcrumb__section-title-box">
                                <h3 class="breadcrumb__title">{{ $room->name ?? '' }}</h3>
                            </div>
                            <div class="breadcrumb__list">
                                {{-- <span><a href="index.html">Home</a></span>
                        <span class="dvdr"><i>/</i></span>
                        <span class="dvdr">Pages</span>
                        <span class="dvdr"><i>/</i></span>
                        <span><b>Products Details</b></span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tp-product-details-area pt-130">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="tp-shop-details__wrapper">
                            <div class="tp-shop-details__tab-content-box mb-20">
                                <div class="tab-content" id="nav-tabContent">

                                    <div id="main-image" class="tp-shop-details__tab-big-img">
                                        <img id="zoom-image" src="{{ url('public/Image/' . $room->image) }}" data-zoom-image="{{ url('public/Image/' . $room->image) }}" alt="Main Image" width="700" height="500">
                                    </div>



                                </div>
                            </div>
                            <div class="tp-shop-details__tab-btn-box">

                                <nav>
                                    <div class="nav nav-tab" id="nav-tab" role="tablist">
                                        @if (!empty($room->images) && is_array(json_decode($room->images, true)))
                                        @foreach (json_decode($room->images) as $key => $image)
                                        <button class="nav-links thumbnail-btn" data-image="{{ url('public/Image/' . $image) }}" type="button">
                                            <img src="{{ url('public/Image/' . $image) }}" alt="Thumbnail {{ $loop->index + 1 }}" loading="lazy">
                                        </button>
                                        @endforeach
                                        @else
                                        <p>No additional images available.</p>
                                        @endif
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const thumbnailButtons = document.querySelectorAll('.thumbnail-btn');
                            const mainImage = document.querySelector('#main-image img');

                            thumbnailButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const newImageSrc = this.getAttribute('data-image');
                                    mainImage.setAttribute('src', newImageSrc);
                                });
                            });
                        });

                        $(document).ready(function() {
                            $('#zoom-image').elevateZoom({
                                zoomType: "lens"
                                , lensShape: "round"
                                , lensSize: 200
                            });
                        });

                    </script>
                    <div class="col-xl-6 col-lg-6">
                        <div class="tp-shop-details__right-wrap">
                            <h3 class="tp-section-title">{{ $room->name ?? ' ' }}</h3>
                            <div class="tp-shop-details__price pb-10">

                                <ul>
                                    <span>Responsable:</span> <span> {{ $room->user->name ?? ' ' }}</span>
                                </ul>
                            </div>
                         {{--    <div class="tp-shop-details__ratting mb-20">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span class="review-text">(5)</span>
                            </div> --}}
                            <div class="tp-shop-details__color d-flex align-items-center mb-20">

                            </div>
                            <div class="tp-shop-details__text-2 mb-25">
                                <p style="text-align:justify">
                                    {!! $room->meta_description ?? ' ' !!}

                                </p>
                            </div>
                            <div class="tp-shop-details__product-info mb-35">
                                {{-- <span class="mb-15 d-block">Last 24 Stock Ready To Buy</span> --}}
                                <ul>
                                    <li>Categorie:{{-- <span> {{ $room->rooms->title ?? '' }}</span> --}}</li>
                                </ul>
                            </div>
                            <div class="tp-shop-details__quantity-wrap  mb-30 d-flex align-items-center">

                            </div>
                            <div class="tp-shop-details__btn text-center mb-40">
                                <a class="tp-btn-theme"
                                href="{{ url('reservation', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}"
                               {{--   href="{{ url('reservation', $room->id) }}" --}}><span>Reserver</span></a>
                            </div>
                            {{-- <div class="tp-shop-details__social">
                        <span>Partagez:</span>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                     </div>  --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="productdetails-tabs mt-50">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12">
                                <div class="product-additional-tab">
                                    <div class="pro-details-nav theme-bg-2 mb-40">
                                        <ul class="nav nav-tabs pro-details-nav-btn justify-content-center" id="myTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab" data-bs-target="#home-1" type="button" role="tab" aria-controls="home-1" aria-selected="true"><span>Description
                                                    </span></button>
                                            </li>
                                           {{--  <li class="nav-item" role="presentation">
                                                <button class="nav-links" id="information-tab" data-bs-toggle="tab" data-bs-target="#additional-information" type="button" role="tab" aria-controls="additional-information" aria-selected="false"><span>Contacts</span></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-links" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"><span>Commentaires</span></button>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <div class="tab-content tp-content-tab" id="myTabContent-2">
                                        <div class="tab-para tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                            <p class="mb-20" style="text-align: justify"> {!! $room->body !!}
                                            </p>

                                        </div>
                                        <div class="tab-pane fade" id="additional-information" role="tabpanel" aria-labelledby="information-tab">
                                            <div class="product__details-info table-responsive mb-50">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td class="add-info">Weight</td>
                                                            <td class="add-info-list"> 2 lbs</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Dimensions</td>
                                                            <td class="add-info-list"> 12 × 16 × 19 in</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Product</td>
                                                            <td class="add-info-list"> Purchase this product on
                                                                rag-bone.com</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Color</td>
                                                            <td class="add-info-list"> Gray, Black</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Size</td>
                                                            <td class="add-info-list"> S, M, L, XL</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Model</td>
                                                            <td class="add-info-list"> Model </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Shipping</td>
                                                            <td class="add-info-list"> Standard shipping: $5,95L</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Care Info</td>
                                                            <td class="add-info-list"> Machine Wash up to 40ºC/86ºF
                                                                Gentle Cycle</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="add-info">Brand</td>
                                                            <td class="add-info-list"> Kazen</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                            <div class="product-details-review">
                                                <h3 class="tp-comments-title mb-35">3 reviews for “Wide Cotton Tunic
                                                    extreme hammer”</h3>
                                                <div class="latest-comments mb-55">
                                                    <ul>
                                                        <li>
                                                            <div class="comments-box d-flex">
                                                                <div class="comments-avatar mr-25">
                                                                    <img src="assets/img/product/client.png" alt="">
                                                                </div>
                                                                <div class="comments-text">
                                                                    <div class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                        <div class="avatar-name">
                                                                            <b>Siarhei Dzenisenka</b>
                                                                            <div class="comments-date mb-20">
                                                                                <span>March 27, 2018 9:51 am</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="user-rating">
                                                                            <ul>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fal fa-star"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <p class="m-0">Lorem ipsum dolor sit amet,
                                                                        consectetur adipiscing elit. Curabitur vulputate
                                                                        vestibulum Phasellus rhoncus, dolor eget viverra
                                                                        pretium, dolor tellus aliquet nunc, vitae
                                                                        ultricies erat elit eu lacus. Vestibulum non
                                                                        justo consectetur, cursus ante, tincidunt
                                                                        sapien. Nulla quis diam sit amet turpis interdum
                                                                        accumsan quis nec enim. Vivamus faucibus ex sed
                                                                        nibh egestas elementum. Mauris et bibendum dui.
                                                                        Aenean consequat pulvinar luctus. Suspendisse
                                                                        consectetur tristique tortor</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="comments-box d-flex">
                                                                <div class="comments-avatar mr-25">
                                                                    <img src="assets/img/product/client-2.png" alt="">
                                                                </div>
                                                                <div class="comments-text">
                                                                    <div class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                        <div class="avatar-name">
                                                                            <b>Tommy Jarvis </b>
                                                                            <div class="comments-date mb-20">
                                                                                <span>March 27, 2018 9:51 am</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="user-rating">
                                                                            <ul>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fal fa-star"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <p class="m-0">We have covered many special
                                                                        events
                                                                        such as fireworks, fairs, parades, races, walks,
                                                                        awards ceremonies, fashion shows, sporting
                                                                        events, and even a memorial service.
                                                                        Lorem ipsum dolor sit amet, consectetur
                                                                        adipiscing elit. Curabitur vulputate vestibulum
                                                                        Phasellus rhoncus, dolor eget viverra pretium,
                                                                        dolor tellus aliquet nunc, vitae ultricies erat
                                                                        elit eu lacus. Vestibulum non justo consectetur,
                                                                        cursus ante, tincidunt sapien. Nulla quis diam
                                                                        sit amet turpis interdum accumsan quis nec enim.
                                                                        Vivamus faucibus ex sed nibh egestas elementum.
                                                                        Mauris et bibendum dui. Aenean consequat
                                                                        pulvinar luctus. Suspendisse consectetur</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="comments-box d-flex">
                                                                <div class="comments-avatar mr-25">
                                                                    <img src="assets/img/product/client-3.png" alt="">
                                                                </div>
                                                                <div class="comments-text">
                                                                    <div class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
                                                                        <div class="avatar-name">
                                                                            <b>Johnny Cash</b>
                                                                            <div class="comments-date mb-20">
                                                                                <span>March 27, 2018 9:51 am</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="user-rating">
                                                                            <ul>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fas fa-star"></i></a>
                                                                                </li>
                                                                                <li><a href="#"><i class="fal fa-star"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <p class="m-0">This is cardigan is a comfortable
                                                                        warm classic piece. Great to layer with a light
                                                                        top and you can dress up or down given the jewel
                                                                        buttons. I'm 5'8” 128lbs a 34A and the Small fit
                                                                        fine.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-details-comment pb-100">
                                                    <div class="comment-title mb-20">
                                                        <h3>Add a review</h3>
                                                        <p>Your email address will not be published. Required fields are
                                                            marked*</p>
                                                    </div>
                                                    <div class="comment-rating mb-20 d-flex">
                                                        <span>Overall ratings</span>
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-input-box">
                                                        <form action="#">
                                                            <div class="row">
                                                                <div class="col-xxl-12">
                                                                    <div class="comment-input">
                                                                        <textarea placeholder="Your review..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <div class="comment-input">
                                                                        <input type="text" placeholder="Your Name*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <div class="comment-input">
                                                                        <input type="email" placeholder="Your Email*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-12">
                                                                    <div class="comment-submit">
                                                                        <button type="submit" class="tp-btn-theme"><span>Submit</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tp-product-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-product-title-box text-center mb-55">
                            <h4 class="tp-section-title">Les chambre de la même catégorie</h4>
                        </div>
                    </div>
                </div>

                <style>
                    .tp-project-3-thumb img {
                        width: 100%;
                        aspect-ratio: 16 / 9;
                        object-fit: cover;
                    }
                    
                    
                    </style>
                <div class="row">
                 @foreach ($otherRooms  as  $room )
                 <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="tp-product-item-2 mb-40">
                        <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
                            <div class="tp-project-3-thumb ">
                            <a   class="tp-project-3-thumb "  href="{{ route('details-room', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 10))]) }}">
                                <img src="{{ url('public/Image/' . $room->image) }}" alt="">
                            </a>
                            </div>
                            <!-- product action -->
                          {{--   <div class="tp-product-action-2 tp-product-action-blackStyle">
                                <div class="tp-product-action-item-2 d-flex flex-column">
                                    <button type="button" class="tp-product-action-btn-2 tp-product-add-cart-btn">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.34706 4.53799L3.85961 10.6239C3.89701 11.0923 4.28036 11.4436 4.74871 11.4436H4.75212H14.0265H14.0282C14.4711 11.4436 14.8493 11.1144 14.9122 10.6774L15.7197 5.11162C15.7384 4.97924 15.7053 4.84687 15.6245 4.73995C15.5446 4.63218 15.4273 4.5626 15.2947 4.54393C15.1171 4.55072 7.74498 4.54054 3.34706 4.53799ZM4.74722 12.7162C3.62777 12.7162 2.68001 11.8438 2.58906 10.728L1.81046 1.4837L0.529505 1.26308C0.181854 1.20198 -0.0501969 0.873587 0.00930333 0.526523C0.0705036 0.17946 0.406255 -0.0462578 0.746256 0.00805037L2.51426 0.313534C2.79901 0.363599 3.01576 0.5995 3.04042 0.888012L3.24017 3.26484C15.3748 3.26993 15.4139 3.27587 15.4726 3.28266C15.946 3.3514 16.3625 3.59833 16.6464 3.97849C16.9303 4.35779 17.0493 4.82535 16.9813 5.29376L16.1747 10.8586C16.0225 11.9177 15.1011 12.7162 14.0301 12.7162H14.0259H4.75402H4.74722Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6629 7.67446H10.3067C9.95394 7.67446 9.66919 7.38934 9.66919 7.03804C9.66919 6.68673 9.95394 6.40161 10.3067 6.40161H12.6629C13.0148 6.40161 13.3004 6.68673 13.3004 7.03804C13.3004 7.38934 13.0148 7.67446 12.6629 7.67446Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38171 15.0212C4.63756 15.0212 4.84411 15.2278 4.84411 15.4836C4.84411 15.7395 4.63756 15.9469 4.38171 15.9469C4.12501 15.9469 3.91846 15.7395 3.91846 15.4836C3.91846 15.2278 4.12501 15.0212 4.38171 15.0212Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38082 15.3091C4.28477 15.3091 4.20657 15.3873 4.20657 15.4833C4.20657 15.6763 4.55592 15.6763 4.55592 15.4833C4.55592 15.3873 4.47687 15.3091 4.38082 15.3091ZM4.38067 16.5815C3.77376 16.5815 3.28076 16.0884 3.28076 15.4826C3.28076 14.8767 3.77376 14.3845 4.38067 14.3845C4.98757 14.3845 5.48142 14.8767 5.48142 15.4826C5.48142 16.0884 4.98757 16.5815 4.38067 16.5815Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9701 15.0212C14.2259 15.0212 14.4333 15.2278 14.4333 15.4836C14.4333 15.7395 14.2259 15.9469 13.9701 15.9469C13.7134 15.9469 13.5068 15.7395 13.5068 15.4836C13.5068 15.2278 13.7134 15.0212 13.9701 15.0212Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9692 15.3092C13.874 15.3092 13.7958 15.3874 13.7958 15.4835C13.7966 15.6781 14.1451 15.6764 14.1443 15.4835C14.1443 15.3874 14.0652 15.3092 13.9692 15.3092ZM13.969 16.5815C13.3621 16.5815 12.8691 16.0884 12.8691 15.4826C12.8691 14.8767 13.3621 14.3845 13.969 14.3845C14.5768 14.3845 15.0706 14.8767 15.0706 15.4826C15.0706 16.0884 14.5768 16.5815 13.969 16.5815Z" fill="currentColor" />
                                        </svg>
                                        <span class="tp-product-tooltip tp-product-tooltip-right">Add to
                                            Cart</span>
                                    </button>
                                    <button type="button" class="tp-product-action-btn-2 tp-product-quick-view-btn" data-bs-toggle="modal" data-bs-target="#producQuickViewModal">
                                        <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99948 5.06828C7.80247 5.06828 6.82956 6.04044 6.82956 7.23542C6.82956 8.42951 7.80247 9.40077 8.99948 9.40077C10.1965 9.40077 11.1703 8.42951 11.1703 7.23542C11.1703 6.04044 10.1965 5.06828 8.99948 5.06828ZM8.99942 10.7482C7.0581 10.7482 5.47949 9.17221 5.47949 7.23508C5.47949 5.29705 7.0581 3.72021 8.99942 3.72021C10.9407 3.72021 12.5202 5.29705 12.5202 7.23508C12.5202 9.17221 10.9407 10.7482 8.99942 10.7482Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.41273 7.2346C3.08674 10.9265 5.90646 13.1215 8.99978 13.1224C12.0931 13.1215 14.9128 10.9265 16.5868 7.2346C14.9128 3.54363 12.0931 1.34863 8.99978 1.34773C5.90736 1.34863 3.08674 3.54363 1.41273 7.2346ZM9.00164 14.4703H8.99804H8.99714C5.27471 14.4676 1.93209 11.8629 0.0546754 7.50073C-0.0182251 7.33091 -0.0182251 7.13864 0.0546754 6.96883C1.93209 2.60759 5.27561 0.00288103 8.99714 0.000185582C8.99894 -0.000712902 8.99894 -0.000712902 8.99984 0.000185582C9.00164 -0.000712902 9.00164 -0.000712902 9.00254 0.000185582C12.725 0.00288103 16.0676 2.60759 17.945 6.96883C18.0188 7.13864 18.0188 7.33091 17.945 7.50073C16.0685 11.8629 12.725 14.4676 9.00254 14.4703H9.00164Z" fill="currentColor" />
                                        </svg>
                                        <span class="tp-product-tooltip tp-product-tooltip-right">Quick View</span>
                                    </button>
                                    <button type="button" class="tp-product-action-btn-2 tp-product-add-to-wishlist-btn">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.60355 7.98635C2.83622 11.8048 7.7062 14.8923 9.0004 15.6565C10.299 14.8844 15.2042 11.7628 16.3973 7.98985C17.1806 5.55102 16.4535 2.46177 13.5644 1.53473C12.1647 1.08741 10.532 1.35966 9.40484 2.22804C9.16921 2.40837 8.84214 2.41187 8.60476 2.23329C7.41078 1.33952 5.85105 1.07778 4.42936 1.53473C1.54465 2.4609 0.820172 5.55014 1.60355 7.98635ZM9.00138 17.0711C8.89236 17.0711 8.78421 17.0448 8.68574 16.9914C8.41055 16.8417 1.92808 13.2841 0.348132 8.3872C0.347252 8.3872 0.347252 8.38633 0.347252 8.38633C-0.644504 5.30321 0.459792 1.42874 4.02502 0.284605C5.69904 -0.254635 7.52342 -0.0174044 8.99874 0.909632C10.4283 0.00973263 12.3275 -0.238878 13.9681 0.284605C17.5368 1.43049 18.6446 5.30408 17.6538 8.38633C16.1248 13.2272 9.59485 16.8382 9.3179 16.9896C9.21943 17.0439 9.1104 17.0711 9.00138 17.0711Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.203 6.67473C13.8627 6.67473 13.5743 6.41474 13.5462 6.07159C13.4882 5.35202 13.0046 4.7445 12.3162 4.52302C11.9689 4.41097 11.779 4.04068 11.8906 3.69666C12.0041 3.35175 12.3724 3.16442 12.7206 3.27297C13.919 3.65901 14.7586 4.71561 14.8615 5.96479C14.8905 6.32632 14.6206 6.64322 14.2575 6.6721C14.239 6.67385 14.2214 6.67473 14.203 6.67473Z" fill="currentColor" />
                                        </svg>
                                        <span class="tp-product-tooltip tp-product-tooltip-right">Add To
                                            Wishlist</span>
                                    </button>
                                    <button type="button" class="tp-product-action-btn-2 tp-product-add-to-compare-btn">
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4144 6.16828L14 3.58412L11.4144 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.48883 3.58374L14 3.58374" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M4.07446 8.32153L1.48884 10.9057L4.07446 13.4898" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 10.9058H1.48883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="tp-product-tooltip tp-product-tooltip-right">Add To
                                            Compare</span>
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tp-product-content-2">
                         {{--    <div class="tp-product-tag-2 mb-10">
                                <span>Garden Tools</span>
                            </div> --}}
                            <h3 class="tp-product-title-2">
                                <a  href="{{ route('details-room', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 10))]) }}">{{ $room->name ?? ' ' }}</a>
                            </h3>
                            <div class="tp-product-price-wrapper-2 mb-15">
                                <span class="tp-product-price-2 new-price">$166.00</span>
                            </div>
                            <div class="tp-product-button">
                                <a class="tp-btn-price w-100 text-center"  href="{{ url('reservation', ['id' => $room->id, 'slug' => Str::slug(Str::limit($room->name, 20))]) }}">
                                    <i>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.56973 13.1809C5.19175 13.1809 5.70135 13.7014 5.70135 14.3443C5.70135 14.9795 5.19175 15.5 4.56973 15.5C3.94023 15.5 3.43062 14.9795 3.43062 14.3443C3.43062 13.7014 3.94023 13.1809 4.56973 13.1809ZM13.0007 13.1809C13.6227 13.1809 14.1323 13.7014 14.1323 14.3443C14.1323 14.9795 13.6227 15.5 13.0007 15.5C12.3712 15.5 11.8616 14.9795 11.8616 14.3443C11.8616 13.7014 12.3712 13.1809 13.0007 13.1809ZM1.08367 0.50009L1.16004 0.506554L2.9474 0.781326C3.2022 0.828014 3.38955 1.04156 3.41204 1.30179L3.55443 3.01624C3.57691 3.26193 3.77176 3.44562 4.01157 3.44562H14.1324C14.5896 3.44562 14.8893 3.60635 15.1891 3.95843C15.4889 4.3105 15.5413 4.81565 15.4739 5.27412L14.7619 10.295C14.627 11.2602 13.8177 11.9712 12.8659 11.9712H4.68979C3.69307 11.9712 2.86871 11.1913 2.78627 10.181L2.09681 1.83755L0.965194 1.63855C0.665428 1.58498 0.455591 1.28648 0.50805 0.980325C0.560509 0.667284 0.852782 0.459865 1.16004 0.506554L1.08367 0.50009ZM11.6669 6.27677H9.59097C9.27622 6.27677 9.02891 6.52934 9.02891 6.8508C9.02891 7.16461 9.27622 7.42484 9.59097 7.42484H11.6669C11.9816 7.42484 12.2289 7.16461 12.2289 6.8508C12.2289 6.52934 11.9816 6.27677 11.6669 6.27677Z" fill="currentcolor" />
                                        </svg>
                                    </i>
                                    <span>Reserver</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
              
                 @endforeach
                    
                 
                </div>
            </div>
        </div>
        <!-- product-area-end -->


        <!-- contact area start -->
        <div class="tp-contact-2-area theme-bg-2 pt-75 pb-55 z-index">
            <div class="container">
                <div class="tp-contact-2-bg white-bg tp-contact-2-style-2">
                    <div class="row align-items-center">
                        <div class="col-xl-4 d-none d-xl-block">
                            <div class="tp-contact-2-logo">
                                <a href="index.html"><img src="/assets/img/logo/logo-black.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="tp-contact-2-right">
                                <div class="tp-contact-2-right-content d-flex align-items-center justify-content-between">
                                    <div class="tp-contact-2-box p-relative">
                                        <div class="tp-contact-2-icon">
                                            <span>
                                                <svg width="13" height="18" viewBox="0 0 13 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.40889 5.57171C1.18267 4.00171 2.23598 2.58796 3.84505 2.06921C4.13074 1.97717 4.43904 2.00332 4.70704 2.14234C4.97504 2.28137 5.18256 2.52278 5.28727 2.81734L5.80324 4.26734C5.88619 4.50058 5.90107 4.75459 5.84595 4.99679C5.79083 5.239 5.66824 5.45835 5.49389 5.62671L3.95905 7.10859C3.88335 7.18179 3.82695 7.27437 3.79532 7.37732C3.76368 7.48027 3.75791 7.59009 3.77855 7.69609L3.7922 7.76109L3.8302 7.92421C3.86405 8.06171 3.91511 8.25546 3.98695 8.48671C4.12945 8.94609 4.35686 9.56359 4.6953 10.1805C5.03374 10.7973 5.42799 11.3136 5.73436 11.673C5.89392 11.8601 6.06071 12.0402 6.2343 12.213L6.2818 12.2592C6.35857 12.3308 6.45164 12.3802 6.55195 12.4027C6.65226 12.4251 6.75638 12.4198 6.85417 12.3873L8.84086 11.7292C9.06658 11.6545 9.30836 11.6525 9.53517 11.7235C9.76199 11.7944 9.9635 11.935 10.1139 12.1273L11.0538 13.3286C11.4456 13.8286 11.3993 14.5636 10.9487 15.0055C9.71724 16.2136 8.02386 16.4617 6.84586 15.4642C5.40195 14.2383 4.18468 12.7432 3.25486 11.0536C2.31736 9.36505 1.69107 7.50479 1.40889 5.57171ZM5.02245 7.77796L6.29664 6.54796C6.64534 6.21123 6.89052 5.77253 7.00076 5.28813C7.11099 4.80372 7.08124 4.2957 6.91533 3.82921L6.39877 2.37921C6.18803 1.78679 5.77059 1.30127 5.23153 1.02163C4.69248 0.741979 4.0724 0.689259 3.4977 0.874212C1.49973 1.51796 -0.104579 3.40359 0.235047 5.75921C0.539639 7.84797 1.21587 9.85749 2.22827 11.6823C3.23115 13.5044 4.54403 15.1167 6.1013 16.4386C7.8677 17.9323 10.2273 17.423 11.7585 15.9198C12.1967 15.49 12.4626 14.9004 12.502 14.2712C12.5414 13.6421 12.3513 13.0209 11.9705 12.5342L11.0306 11.333C10.7298 10.9482 10.3267 10.6669 9.87297 10.525C9.41922 10.3831 8.93555 10.3872 8.48402 10.5367L6.83517 11.083C6.76137 11.0031 6.68911 10.9216 6.61845 10.8386C6.27959 10.444 5.97978 10.014 5.72367 9.55546C5.47435 9.09262 5.27043 8.60427 5.11508 8.09796C5.08214 7.99197 5.05125 7.88528 5.02245 7.77796Z" fill="currentcolor" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="tp-contact-2-text">
                                            <span>Phone:</span>
                                            <a class="text-anim-2" href="tel:6845550102">(684) 555-0102</a>
                                        </div>
                                    </div>
                                    <div class="tp-contact-2-box p-relative">
                                        <div class="tp-contact-2-icon">
                                            <span>
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.3327 1.99967C17.3327 1.08301 16.5827 0.333008 15.666 0.333008H2.33268C1.41602 0.333008 0.666016 1.08301 0.666016 1.99967V11.9997C0.666016 12.9163 1.41602 13.6663 2.33268 13.6663H15.666C16.5827 13.6663 17.3327 12.9163 17.3327 11.9997V1.99967ZM15.666 1.99967L8.99935 6.16634L2.33268 1.99967H15.666ZM15.666 11.9997H2.33268V3.66634L8.99935 7.83301L15.666 3.66634V11.9997Z" fill="currentcolor" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="tp-contact-2-text">
                                            <span>Email:</span>
                                            <a class="text-anim-2" href="mailto:manhhachkt08@gmail.com">manhhachkt08@gmail.com</a>
                                        </div>
                                    </div>
                                    <div class="tp-contact-2-box location p-relative">
                                        <div class="tp-contact-2-icon">
                                            <span>
                                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 10.834C9.38071 10.834 10.5 9.7147 10.5 8.33398C10.5 6.95327 9.38071 5.83398 8 5.83398C6.61929 5.83398 5.5 6.95327 5.5 8.33398C5.5 9.7147 6.61929 10.834 8 10.834Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M8.00065 1.66699C6.23254 1.66699 4.53685 2.36937 3.28661 3.61961C2.03636 4.86986 1.33398 6.56555 1.33398 8.33366C1.33398 9.91033 1.66898 10.942 2.58398 12.0837L8.00065 18.3337L13.4173 12.0837C14.3323 10.942 14.6673 9.91033 14.6673 8.33366C14.6673 6.56555 13.9649 4.86986 12.7147 3.61961C11.4645 2.36937 9.76876 1.66699 8.00065 1.66699Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="tp-contact-2-text">
                                            <span>Location:</span>
                                            <a class="text-anim-2" href="#" target="_blank">Elgin, Celina,
                                                Delaware 10299</a>
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
    @endsection
