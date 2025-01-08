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
                        <h3 class="breadcrumb__title">Produits</h3>
                     </div>
                     <div class="breadcrumb__list">
                        <span><a href="/">Accueil</a></span>
                        <span class="dvdr"><i>/</i></span>
                       
                        <span class="dvdr"><i>/</i></span>
                        <span><b>Produits</b></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb area end -->

      <!-- product-area-start -->
      <div class="tp-product__area fix pt-150 pb-150">
         <div class="container">
               <div class="row align-items-center">     
                  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-40">
                     
                  </div>
                  <div class="col-xl-9 col-lg-8 col-md-6 col-sm-6 mb-40">
                     <div class="tp-shop-top d-flex align-items-center justify-content-sm-end">
                        {{-- <div class="tp-product__text">
                           <span>Filtre</span>
                        </div> --}}
                     {{--    <div class="tp-product__filter">
                           <select>
                              <option >Default</option>
                              <option >Low to Hight</option>
                              <option >High to Low</option>
                              <option >New Added</option>
                              <option >On Sale</option>
                           </select>
                        </div>  --}}
                     </div> 
                  </div>                 
               </div>
               <div class="row">
                  <div class="col-xl-4 col-lg-4">
                     <div class="tp-product-sidebar">
                        <!-- search -->
                        <div class="tp-product-widget mb-30">
                           <h3 class="sidebar__widget-title mb-20">Search</h3>
                           <div class="sidebar__widget-content">
                              <div class="sidebar__search">
                                 <form role="search" action="{{ url('search') }}" method="get">
                                    @csrf
                                    <div class="sidebar__search-input-2">
                                       <input type="text" id="search"  type="search" name="search"    value="{{ $name ?? '' }}"
                                       placeholder="Search Products">
                                       <button  value="Search" type="submit"><i class="far fa-search"></i></button>
                                    </div>
                                 </form>
                              </div>
                           </div>

                        </div>
                        <!-- categories -->
                        <div class="tp-product-widget mb-30">
                           <h3 class="sidebar__widget-title mb-0">Category</h3>
                           <div class="tp-product-widget-content">
                              <div class="tp-product-widget-category">
                                 <ul>
                                    @foreach ($categories as $category)
                                    <li><a  href="/categorie/{{ $category->id }}"
                                        class="{{ isset($current_category) && $current_category->id === $category->id ? 'selected' : '' }}">  {{ Str::limit($category->title,25) }}<span>{{ $category->products->count() }}</span></a></li>
                              @endforeach
                                 </ul>
                              </div>
                           </div>
                        </div>
                      
                       
                        <!-- color rating -->
                       
                     </div>
                  </div>
                  <div class="col-xl-8 col-lg-8">
                     <div class="row">  
                        @foreach($products as $product)
                        @if ($products)
                        <div class="col-xl-4 col-md-6 col-sm-6">
                           <div class="tp-product-item-2 mb-40">
                              <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
                                 <a href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 10))]) }}">
                                    <img src="{{ url('public/Image/' . $product->image) }}" width="200" height="150" alt="">
                                 </a>
                                 <!-- product action -->
                                 <div class="tp-product-action-2 tp-product-action-blackStyle">
                                    <div class="tp-product-action-item-2 d-flex flex-column">
                                   
                                      
                                    </div>
                                 </div>
                              </div>
                              <div class="tp-product-content-2">
                                 <div class="tp-product-tag-2 mb-10">
                                   {{--  <span>Garden Tools</span> --}}
                                 </div>
                                 <h3 class="tp-product-title-2">
                                    <a href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 10))]) }}">{{$product->name}}</a>
                                 </h3>
                                 <div class="tp-product-price-wrapper-2 mb-15">
                                   {{--  <span class="tp-product-price-2 new-price">$166.00</span> --}}
                                 </div>
                                 <div class="tp-product-button">
                                    <a class="tp-btn-price w-100 text-center" href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 10))]) }}">
                                       {{-- <i>
                                          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M4.56973 13.1809C5.19175 13.1809 5.70135 13.7014 5.70135 14.3443C5.70135 14.9795 5.19175 15.5 4.56973 15.5C3.94023 15.5 3.43062 14.9795 3.43062 14.3443C3.43062 13.7014 3.94023 13.1809 4.56973 13.1809ZM13.0007 13.1809C13.6227 13.1809 14.1323 13.7014 14.1323 14.3443C14.1323 14.9795 13.6227 15.5 13.0007 15.5C12.3712 15.5 11.8616 14.9795 11.8616 14.3443C11.8616 13.7014 12.3712 13.1809 13.0007 13.1809ZM1.08367 0.50009L1.16004 0.506554L2.9474 0.781326C3.2022 0.828014 3.38955 1.04156 3.41204 1.30179L3.55443 3.01624C3.57691 3.26193 3.77176 3.44562 4.01157 3.44562H14.1324C14.5896 3.44562 14.8893 3.60635 15.1891 3.95843C15.4889 4.3105 15.5413 4.81565 15.4739 5.27412L14.7619 10.295C14.627 11.2602 13.8177 11.9712 12.8659 11.9712H4.68979C3.69307 11.9712 2.86871 11.1913 2.78627 10.181L2.09681 1.83755L0.965194 1.63855C0.665428 1.58498 0.455591 1.28648 0.50805 0.980325C0.560509 0.667284 0.852782 0.459865 1.16004 0.506554L1.08367 0.50009ZM11.6669 6.27677H9.59097C9.27622 6.27677 9.02891 6.52934 9.02891 6.8508C9.02891 7.16461 9.27622 7.42484 9.59097 7.42484H11.6669C11.9816 7.42484 12.2289 7.16461 12.2289 6.8508C12.2289 6.52934 11.9816 6.27677 11.6669 6.27677Z" fill="currentcolor" />
                                          </svg>
                                       </i> --}}
                                       <span>Voir détails</span>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                        @endforeach
         
                        <div class="pagination-wrapper d-flex justify-content-center">
                           {{ $products->links('pagination::bootstrap-4') }} 
                      </div>

                     </div>
                  </div>
               </div>
         </div>
      </div>
      <!-- product-area-end -->

 




    

</main>
@endsection