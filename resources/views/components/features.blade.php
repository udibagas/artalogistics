<section id="features" class="features">
    <div class="container">

    <div class="row">
        <div class="col-lg-6 order-2 order-lg-1">
            @foreach ($features as $feature)
            <div class="icon-box mt-5 mt-lg-0">
                <i class="{{$feature->icon}}"></i>
                <h4>{{$feature->title}}</h4>
                <p>{{$feature->description}}</p>
            </div>
            @endforeach
        </div>
        <div class="image col-lg-6 order-1 order-lg-2" style='background-image: url("assets/img/features.jpg");'></div>
    </div>

    </div>
</section>
