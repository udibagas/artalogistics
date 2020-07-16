<section id="portfolio" class="portfolio">
    <div class="container">

    <div class="section-title">
        <h2>Portfolio</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
    </div>

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
        </ul>
        </div>
    </div>

    <div class="row portfolio-container">
        @foreach ($portfolios as $portfolio)
        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{$portfolio->image_url}}" class="img-fluid" alt="">
            <div class="portfolio-info">
            <h4>{{$portfolio->title}}</h4>
                <p>{{$portfolio->description}}</p>
                <a href="{{$portfolio->image_url}}" data-gall="portfolioGallery" class="venobox preview-link" title="{{$portfolio->title}}"><i class="bx bx-plus"></i></a>
                <a href="/portfolio/{{$portfolio->id}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
        </div>
        @endforeach
    </div>

    </div>
</section>
