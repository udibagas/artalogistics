<section id="services" class="services">
    <div class="container">
        <div class="section-title">
            <h2>Services</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-4 col-md-6 mt-4">
                <div class="icon-box">
                    <div class="icon"><i class="{{$service->icon}}"></i></div>
                    <h4><a href="">{{$service->title}}</a></h4>
                    <p>{{$service->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
