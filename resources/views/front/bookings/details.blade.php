@extends('front.fixe')
@section('titre','Blogs')
@section('body')

<main>
   @php
    $config = DB::table('configs')->first();
    $service =DB::table('services')->get();
@endphp



   <main>

      <!-- breadcrumb area start -->
      <div class="breadcrumb__area breadcrumb__overlay breadcrumb__height p-relative fix"
         data-background="{{ url('public/Image/parametres/' . $config->imageindustrielle) }}">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="breadcrumb__content z-index text-center">
                     <div class="breadcrumb__section-title-box">
                        <h3 class="breadcrumb__title">Les détails du produit</h3>
                     </div>
                     <div class="breadcrumb__list">
                        <span><a href="/">Home</a></span>
                      
                        <span class="dvdr"><i>/</i></span>
                        <span><b>Détails produit</b></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb area end -->

      <!--product-details-area-start -->
      <div class="tp-product-details-area pt-130">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6">
                  <div class="tp-shop-details__wrapper">
                     <div class="tp-shop-details__tab-content-box mb-20">
                        <div class="tab-content" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                              aria-labelledby="nav-one-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="{{ url('public/Image/' . $product->image) }}" alt=""  width="700 " height="500 ">
                              </div>
                           </div>
                           {{-- <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-2.jpg" alt="">
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-3.jpg" alt="">
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                              <div class="tp-shop-details__tab-big-img">
                                 <img src="assets/img/product/pro-1-1.jpg" alt="">
                              </div>
                           </div> --}}
                        </div>
                     </div>
                     <div class="tp-shop-details__tab-btn-box">
                      {{--   <nav>
                           <div class="nav nav-tab" id="nav-tab" role="tablist">
                              <button class="nav-links active" id="nav-one-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one"
                                 aria-selected="true">
                                 <img src="assets/img/product/pro-sm-1-1.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two"
                                 type="button" role="tab" aria-controls="nav-two" aria-selected="false">
                                 <img src="assets/img/product/pro-sm-1-2.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-three-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-three" type="button" role="tab" aria-controls="nav-three"
                                 aria-selected="false">
                                 <img src="assets/img/product/pro-sm-1-3.jpg" alt="">
                              </button>
                              <button class="nav-links" id="nav-four-tab" data-bs-toggle="tab"
                                 data-bs-target="#nav-four" type="button" role="tab" aria-controls="nav-four"
                                 aria-selected="false">
                                 <img src="assets/img/product/pro-1-1.jpg" alt="">
                              </button>
                           </div>
                        </nav> --}}
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="tp-shop-details__right-wrap">
                     <h3 class="tp-section-title">{{$product->name}}</h3>
                     <div class="tp-shop-details__price pb-10">
                      
                     </div>
                     <div class="tp-shop-details__ratting mb-20">
                        {{-- <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span class="review-text">(5)</span> --}}
                     </div>
                     <div class="tp-shop-details__color d-flex align-items-center mb-20">
                        {{-- <i>Color:</i>
                        <span class="tia"></span>
                        <span class="black"></span>
                        <span class="yellow"></span>
                        <span class="ass"></span> --}}
                     </div>
                     <div class="tp-shop-details__text-2 mb-25">
                        <p>{{ Str::limit($product->description, 50) }} </p>
                     </div>
                     <div class="tp-shop-details__product-info mb-35">
                        
                        <ul>
                           <li>Categorie:<span> {{$product->categories->title ?? ' '}}</span></li>
                        </ul>
                     </div>
                     <div class="tp-shop-details__quantity-wrap  mb-30 d-flex align-items-center">
                        
                                            
                     </div>
                     <div class="tp-shop-details__btn text-center mb-40">
                        <a class="tp-btn-theme"  href="{{ url('commandes', $product->id) }}"><span>Commander</span></a>
                     </div>
                     <div class="tp-shop-details__social">
                       
                     </div>                    
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
                                    <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab"
                                       data-bs-target="#home-1" type="button" role="tab" aria-controls="home-1"
                                       aria-selected="true"><span>
                                          Détails du produit</span></button>
                                 </li>
                                 {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-links" id="information-tab" data-bs-toggle="tab"
                                       data-bs-target="#additional-information" type="button" role="tab"
                                       aria-controls="additional-information" aria-selected="false"><span>Product Include</span></button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <button class="nav-links" id="reviews-tab" data-bs-toggle="tab"
                                       data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                       aria-selected="false"><span>Product Review</span></button>
                                 </li> --}}
                              </ul>
                           </div>
                           <div class="tab-content tp-content-tab" id="myTabContent-2">
                              <div class="tab-para tab-pane fade show active" id="home-1" role="tabpanel"
                                 aria-labelledby="home-tab-1">
                                 <p class="mb-20 text-center">{{$product->description}} </p>
                                
                              </div>
                              <div class="tab-pane fade" id="additional-information" role="tabpanel"
                                 aria-labelledby="information-tab">
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
                                                   <div
                                                      class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
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
                                                   <div
                                                      class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
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
                                                   <p class="m-0">We have covered many special events
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
                                                   <div
                                                      class="comments-top d-sm-flex align-items-start justify-content-between mb-5">
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
      <!-- product-details-area-end -->

    

</main>
@endsection