<section id="faq" class="faq">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                <div class="content">
                    <h3>Frequently Asked <strong>Questions</strong></h3>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                    </p>
                </div>

                <div class="accordion-list">
                    <ul>
                        @foreach ($faqs as $faq)
                        <li>
                            <a data-toggle="collapse" class="collapse" href="#accordion-list-{{$faq->id}}">{{$faq->question}} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-{{$faq->id}}" class="collapse" data-parent=".accordion-list">
                            <p>{{ $faq->answer }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/faq.jpg");'>&nbsp;</div>
        </div>
    </div>
</section>
