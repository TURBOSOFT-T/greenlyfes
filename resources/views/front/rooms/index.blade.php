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
                                     </div>
                                 <div class="tp-product-button">
                                    <a class="tp-btn-price w-100 text-center" href="{{ route('details-produits', ['id' => $product->id, 'slug' => Str::slug(Str::limit($product->name, 10))]) }}">
                                 
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