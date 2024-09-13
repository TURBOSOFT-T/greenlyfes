@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')

    <main>


    <!-- content
    ================================================== -->
    <div class="row">
        <div class="column large-12">

          <article class="s-content__entry">

            <div class="s-content__entry-header">
                <h1 style="text-align: center;">{{ $page->title }}</h1>
            </div>

           
            

            <div class="s-content__primary">

                <div class="s-content__page-content" style="text-align: justify;">

                    {!! $page->body !!}

                </div>
                <style>
                    .s-content__page-content {
    text-align: justify;
    line-height: 2.6;
    margin: 100px;
}

                </style>

            </div>
        </article>

        </div>
    </div>

    </main>

@endsection



