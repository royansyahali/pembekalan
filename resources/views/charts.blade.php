@extends('layouts.app')

@section('content')

<section class="content">
    <div class="card card-secondary card-outline">

        <div class="card-body">
            <div >
                <div >
                  <div >
                    <div >
                      <div >Chart Demo</div>

                      <div >
                        {!! $chart->html() !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {!! Charts::scripts() !!}
              {!! $chart->script() !!}
        </div>
    </div>
</section>
@endsection
