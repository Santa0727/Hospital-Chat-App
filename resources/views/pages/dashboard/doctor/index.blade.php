@extends('layouts.theme')

@section('page')
<div class="container d-lg-flex align-items-lg-center space-top-2 space-top-md-5 space-lg-0 min-height-lg-100vh">
    <div class="row w-100">
        <div class="col-lg-5">
            <h1 class="text-dark display-4 font-size-md-down-5 mb-3">Professionnel de Sante ?</h1>
            <p class="text-secondary hero-fancybox__description">Notre outil convient aussi bien pour
                <span class="text-primary">
                    <strong class="u-text-animation u-text-animation--typing">les dentistes</strong>
                </span>
                <br>Ideal pour les annualation de derniere minutes ou les practiciens en teleconsultation.</p>
            <div class="d-flex align-items-center flex-wrap">
                <a href="https://www.youtube.com/watch?v=8ubSry6lLCM" class="justify-content-center fgb-button btn fgb-button--align-center btn-soft-primary btn-wide transition-3d-hover">
                    <div class="fgb-button--inner">Get Started</div>
                </a>
                <a class="js-fancybox media align-items-center u-media-player min-width-21 ml-3" href="javascript:;" data-src="//vimeo.com/167434033" data-speed="700" data-animate-in="zoomIn" data-animate-out="zoomOut" data-caption="Front - Responsive Website Template"><span class="fgb-button u-media-player__icon u-media-player__icon--success mr-3"><span class="fa fa-play btn-icon__inner u-media-player__icon-inner ml-1"></span></span><span class="media-body text-black">Play video</span></a>
            </div>
        </div>
    </div>
    <div class="mt-12 col-lg-9 col-xl-7 d-none d-lg-block position-absolute top-0 right-0 pr-0">
        <figure class="main-hero"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1374.7 1083.6" style="enable-background:new 0 0 1374.7 1083.6;" xml:space="preserve" class="injected-svg js-svg-injector" data-img-paths="[ { &quot;targetId&quot;: &quot;#SVGMainHeroImg1&quot;, &quot;newPath&quot;: &quot;https://demo2.madrasthemes.com/front-demos/main/wp-content/plugins/front-gutenberg-blocks/assets/img/750x750/img2.jpg&quot; } ]" data-parent="#SVGMainHero">
            <style type="text/css">
                .main-hero-0{fill:#377dff;}
            </style>
            <path class="main-hero-0 fill-primary" opacity=".05" d="M285.2,170.1c-94.5,8.6-181.2,57.4-235.9,134.8C-34.7,423.6-54.5,621.5,349,879.8  c636.5,407.6,600,9.3,591.9-47.4c-0.8-5.5-1.4-11.1-2-16.6l-34.2-374.1C888.4,262,729.2,129.6,549.4,146L285.2,170.1z"></path>
            <g>
                <defs>
                    <path id="mainHeroBlock1" d="M1374.7,0H687.6l-278,279.7c-150,150.9-148.1,395.3,4.4,543.8l0,0C554.1,960,774.9,968.7,925.4,843.6    l449.3-373.4V0z"></path>
                </defs>
                <clipPath id="mainHeroBlock2">
                    <use xlink:href="#mainHeroBlock1" style="overflow:visible;"></use>
                </clipPath>
                <g transform="matrix(1 0 0 1 0 0)" style="clip-path:url(#mainHeroBlock2);">
                    <!-- Apply your (750px width to 750px height) image here -->
                    <image id="SVGMainHeroImg1" style="overflow:visible;" width="750" height="750" xlink:href="{{url('images/doctor-header-image.jpg')}}" transform="matrix(1.4462 0 0 1.4448 290.09 0)"></image>
                </g>
            </g>
            </svg></figure>
    </div>
</div>

<div class="container services mt-5">
    <div class="row row-top">
        <div class="col-lg-8 offset-lg-2 text-center">
            <span class="btn-soft-success mb-2">What we do?</span>
            <h2>Dispose d'une facilite d'utilisation couple a une librete d'exploitation</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-5 text-center">
            <img src="{{url('images/img-1.png')}}" alt="">
            <h3 class="mt-3 mb-2">Teleconsultation</h3>
            <p class="text-light">Achieve virtually any design and layout from within the one template.</p>
        </div>
        <div class="col-md-4 mb-5 text-center">
            <img src="{{url('images/img-2.png')}}" alt="">
            <h3 class="mt-3 mb-2">Consultation Physique</h3>
            <p class="text-light">We strive to figure out ways to help your businnes grow through all platforms.</p>
        </div>
        <div class="col-md-4 mb-5 text-center">
            <img src="{{url('images/img-3.png')}}" alt="">
            <h3 class="mt-3 mb-2">Consultation a domicile</h3>
            <p class="text-light">Find what you need in one template and combine features at will.</p>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <img class="img-fluid" src="{{url('images/pointer.png')}}" alt="">
    </div>
    <div class="row mb-5">
        <div class="col-lg-6 offset-lg-3 text-center">
            <h3><strong>C'est rapide et simple.</strong> Proposez vos rendez-vous et consultez votre planning</h3>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <img class="img-fluid" src="{{url('images/img-urgo.png')}}" alt="">
    </div>
    <div class="row mb-5">
        <div class="col-lg-4 offset-lg-4 text-center">
            <p class="text-light"><small>We are launching soon. Join the priority list for information and early access.</small></p>
        </div>
    </div>

    <div class="row mt-5 pt-5 plans">
        <div class="col-lg-5 pr-5 mb-5">
            <span class="btn-soft-success mb-2">Pricing plans</span>
            <h2>Pas de charge<br>addictionnel</h2>
            <p class="text-light mt-3">Choose the most suitable service for your needs with reasonable price.</p>
            <div class="btn-group btn-group-toggle mt-4">
                <a class="btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide active" href="#" ><span>Monthly</span></a>
                <a class="btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide" href="#"><span>Yearly</span><span class="badge badge-success badge-pill badge-bigger badge-pos"><span>10% OFF</span></span></a>
            </div>
        </div>

        <div class="col-lg-7">
            <div id="pricing-1initialId" class="row align-items-center mb-3" >
                <div class="col-sm-6 mb-7 mb-sm-0">
                    <div class="card border-0 mw-100 mt-0 p-0 shadow-sm">
                        <header class="card-header position-relative border-0 p-4 bg-primary text-white">
                            <h3 class="h4 mb-1 text-white">Practicien individuel</h3><span class="frontgb-pricing-format frontgb-pricing-format-style-1 d-block"><span class="pricePrefix align-top"><span class="align-top">$</span></span><span class="packPrice display-4 font-weight-semi-bold"><span class="display-4 font-weight-semi-bold">22</span></span><span class="packValidity"><span>/month</span></span></span>
                        </header>
                        <img class="img-fluid" width="100%" src="{{url('images/wave-cards.jpeg')}}" alt="">
                        <div class="card-body">
                            <ul class="list-group list-group-flush list-group-borderless mb-4 text-light">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>Community support</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>400+ pages</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>100+ header variations</span>
                                    </div>
                                </li>
                                <li class="list-group-item disabled py-2">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>30+ home page options</span>
                                    </div>
                                </li>
                            </ul>
                            <a href="" class="fgb-button btn fgb-button--align-center btn-soft-primary btn-block transition-3d-hover">
                                <div class="fgb-button--inner">Get Started</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0 mw-100 mt-0 p-0 shadow-sm">
                        <header class="card-header position-relative border-0 p-4 bg-primary text-white">
                            <h3 class="h4 mb-1 text-white">Cabinet medical</h3><span class="frontgb-pricing-format frontgb-pricing-format-style-1 d-block"><span class="pricePrefix align-top"><span class="align-top">$</span></span><span class="packPrice display-4 font-weight-semi-bold"><span class="display-4 font-weight-semi-bold">99</span></span><span class="packValidity"><span>/month</span></span></span>
                        </header>
                        <img class="img-fluid" width="100%" src="{{url('images/wave-cards.jpeg')}}" alt="">
                        <div class="card-body">
                            <ul class="list-group list-group-flush list-group-borderless mb-4 text-light">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>24/7 support</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>400+ pages</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>200+ header variations</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>40+ home page options</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center"><span class="btn-icon btn-soft-primary rounded-circle mr-3"><span class="fa fa-check btn-icon__inner"></span></span><span>E-commerce</span>
                                    </div>
                                </li>
                            </ul>
                            <a href="" class="fgb-button btn fgb-button--align-center btn-soft-primary btn-block transition-3d-hover">
                                <div class="fgb-button--inner">Get Started</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="frontgb-pricing-term-text small text-muted text-center text-light">* <a href="#" class="text-light text-dashed">Terms</a> are subject to change.</p>
        </div>
    </div>
</div>

<div class="gradient-half-primary-v2">
    <div class="container">
        <div class="row news-blog">
            <div class="col-lg-6 offset-lg-3 text-center news-top">
                <span class="btn-soft-success mb-2">What we do?</span>
                <h2 class="mt-3">Read our latest news</h2>
                <p class="text-light">Our duty towards you is to share our experience we're reaching in our work path with you.</p>
            </div>

            <div class="slick-slider d-flex justify-content-between">
                <div class="slick-list shadow-sm">
                    <img class="object-fit" src="{{url('images/bg1.jpg')}}" alt="">
                    <a class="info-over" href="#" class="p-5">
                        <h3 class="text-white text-center">How to make trust your competitive advantage.</h3>
                        <h5 class="text-light">Keith Margaret</h5>
                        <img src="{{url('images/thumbnail.png')}}" alt="thumbnail">
                    </a>
                </div>
                <div class="slick-list shadow-sm">
                    <div class="card p-5">
                        <p class="text-center">” How to help your team excel at remote collaboration. Here are tips and tools we use on the content team at InVision to keep our remote collaboration game strong. Trust is both a complex and nuanced topic. Its very nature makes it difficult to tackle through direct effort. “</p>
                        <h5 class="my-3">Keith Margaret</h5>
                        <img src="{{url('images/thumbnail.png')}}" alt="thumbnail">
                        <a class="btn btn-sm btn-soft-primary btn-wide transition-3d-hover min-width-200 mt-4" href="#" tabindex="0">Read More</a>
                    </div>
                </div>
                <div class="slick-list shadow-sm">
                    <img class="object-fit" src="{{url('images/img2.jpg')}}" alt="">
                    <a class="info-over" href="#" class="p-5">
                        <h3 class="text-white text-center">How to make trust your competitive advantage.</h3>
                        <h5 class="text-light">Keith Margaret</h5>
                        <img src="{{url('images/thumbnail.png')}}" alt="thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
