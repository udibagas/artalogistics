<section id="clients" class="clients">
    <div class="container">
        <div class="row no-gutters clients-wrap clearfix wow fadeInUp">
            @foreach ($clients as $client)
            <div class="col-lg-3 col-md-4 col-xs-6">
                <div class="client-logo">
                    <img src="{{$client->imageUrl}}" class="img-fluid" alt="">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
