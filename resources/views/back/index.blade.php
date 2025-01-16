@extends('back.layout')

@section('main')
    <div class="container-xxl">
        <div class="row">

            @if ($posts)
                <x-back.box type='info' :number='$posts' title='New posts' route='posts.indexnew' model='post'>
                </x-back.box>
            @endif

            @if ($users)
                <x-back.box type='success' :number='$users' title='Nouvels utilisateurs' route='users.indexnew' model='user'>
                </x-back.box>
            @endif

            @if ($contacts)
                <x-back.box type='primary' :number='$contacts' title='New contacts' route='contacts.indexnew' model='contact'>
                </x-back.box>
            @endif

            @if ($comments)
                <x-back.box type='danger' :number='$comments' title='New comments' route='comments.indexnew' model='comment'>
                </x-back.box>
            @endif

            @if ($inscriptions)
                <x-back.box type='primary' :number='$inscriptions' title='Les nouvelles inscriptions'
                    route='inscriptions.indexnew' model='Inscription'>
                </x-back.box>
            @endif

            @if ($consultations)
                <x-back.box type='success' :number='$consultations' title='Les nouvelles consultations'
                    route='consultations.indexnew' model='Consultation'>
                </x-back.box>
            @endif
            @if ($testimonials)
                <x-back.box type='warning' :number='$testimonials' title='Les nouveaux témoignages' route='testimonials.indexnew'
                    model='Testimonial'>
                </x-back.box>
            @endif
            @if ($orders)
                <x-back.box type='info' :number='$orders' title='Les nouveaux commandes' route='orders.indexnew'
                    model='Order'>
                </x-back.box>
            @endif


            @if ($books)
                <x-back.box type='primary' :number='$books' title='Les nouveaux logements' route='books.indexnew'
                    model='Book'>
                </x-back.box>
            @endif

            @if($reservations)

 <x-back.box type='primary' :number='$reservations' title='Les nouvelles reservations' route='reservations.indexnew'
                    model='Reservation'>
                </x-back.box>
            @endif 

            @if ($rooms)
            <x-back.box type='success' :number='$rooms' title='Les nouvelles chambres' route='rooms.indexnew'
            model='Room'>
            </x-back.box>
            @endif

                
           





        </div>
    </div>
    <br>

    <div class="row">
       {{--  <div class="col-sm-6">
            @include('back.stats')
        </div>
        <div class="col-sm-6">
            @include('back.statcommande')
        </div>

 --}}
    </div>
@endsection
