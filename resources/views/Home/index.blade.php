@extends('Layouts._layout1')
@section('content')
    <div class="ts-page-wrapper" id="page-top">
        <!--*********************************************************************************************************-->
        <!--************ HERO ***************************************************************************************-->
        <!--*********************************************************************************************************-->
        <header id="ts-hero" class="ts-full-screen">

            <!--NAVIGATION ******************************************************************************************-->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top ts-separate-bg-element" data-bg-color="#13a589">
                <div class="container">
                    <a class="navbar-brand" href="#page-top">
                        <img src="assets/img/logo_ssm_horizontal.png" width="40%" alt="">
                    </a>
                    <!--end navbar-brand-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--end navbar-toggler-->
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ml-auto">
                            <a class="nav-item nav-link active ts-scroll" href="#page-top">Home <span
                                    class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link ts-scroll" href="#event">Events</a>
                            <a class="nav-item nav-link ts-scroll" href="#about">About</a>
                            <a class="nav-item nav-link ts-scroll" href="#features">Features</a>
                            <a class="nav-item nav-link ts-scroll" href="#contact">Contact</a>
                        </div>
                        <!--end navbar-nav-->
                    </div>
                    <!--end collapse-->
                </div>
                <!--end container-->
            </nav>
            <!--end navbar-->

            <!--HERO CONTENT ****************************************************************************************-->
            <div class="container align-self-center">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <h3 class="ts-opacity__50">Get Organized!</h3>
                        <h1>Make Your Soccer Schedule Instantly</h1>
                        <a href="#about" class="btn btn-light btn-lg ts-scroll">Learn More</a>
                    </div>
                    <!--end col-sm-7 col-md-7-->
                    <div class="col-sm-5 d-none d-sm-block">

                    </div>
                    <!--end col-sm-5 col-md-5 col-xl-5-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->

            <div id="ts-dynamic-waves" class="ts-background" data-bg-color="#13a589">
                <svg class="ts-svg ts-parallax-element" width="100%" height="100%" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <defs></defs>
                    <path class="ts-dynamic-wave" d="" data-wave-color="#13bf9e" data-wave-height=".6" data-wave-bones="4"
                        data-wave-speed="0.15" />
                </svg>
                <svg class="ts-svg" width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <defs></defs>
                    <path class="ts-dynamic-wave" d="" data-wave-color="#fff" data-wave-height=".2" data-wave-bones="6"
                        data-wave-speed="0.2" />
                </svg>
            </div>

        </header>
        <!--end #hero-->

        <!--*********************************************************************************************************-->
        <!--************ CONTENT ************************************************************************************-->
        <!--*********************************************************************************************************-->
        <main id="ts-content">

            <section class="ts-block">
                <div class="container">
                    <!--end ts-title-->
                    <div class="row">
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--SUBSCRIBE *******************************************************************************************-->
            <section id="event" class="ts-block ts-separate-bg-element" data-bg-image="assets/img/bg-pattern-dot.png"
                data-bg-size="inherit" data-bg-image-opacity=".1" data-bg-repeat="repeat">
                <div class="container">
                    <h3>See Match Detail</h3>
                    <form class="ts-form ts-form-email ts-labels-inside-input" data-php-path="assets/php/email.php">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group mb-0">
                                    <label for="email-subscribe">Email address</label>
                                    <input type="email" class="form-control" id="email-subscribe"
                                        aria-describedby="subscribe" name="email" placeholder="" required>
                                    <small class="form-text mt-2 ts-opacity__50">*You’ll get only relevant news once a
                                        week</small>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-10-->
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Find</button>
                            </div>
                            <!--end col-md-2-->
                        </div>
                        <!--end row-->
                    </form>
                    <!--end ts-form-->
                </div>
                <!--end container-->
            </section>
            <!--END SUBSCRIBE ***************************************************************************************-->

            <!--WHAT IS APPSTORM ************************************************************************************-->
            <section id="about" class="ts-block">
                <div class="container">
                    <div class="ts-title">
                        <h2>What Is Seroja Match Scheduler?</h2>
                    </div>
                    <!--end ts-title-->
                    <div class="row">
                        <div class="col-md-5 col-xl-5" data-animate="ts-fadeInUp" data-offset="100">
                            <p>
                                Seroja Match Scheduling is android based sport utility application that can help you to
                                making the soccer
                                elimination scheduling with knockout system or group system within its standings. It has
                                rich features including
                                shuffle schedule, input score, etc.
                            </p>
                            <p>
                                Besides that, other people can see the match details, standings, information about the
                                events by search its link at input field above.
                            </p>
                        </div>
                        <!--end col-xl-5-->
                        <div class="col-md-7 col-xl-7 text-center" data-animate="ts-fadeInUp" data-delay="0.1s"
                            data-offset="100">
                            <div class="px-3">
                                <img src="assets/img/img-screen-desktop.jpg"
                                    class="mw-100 ts-shadow__lg ts-border-radius__md" alt="">
                            </div>
                        </div>
                        <!--end col-xl-7-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--END WHAT IS APPSTORM ********************************************************************************-->

            <!--FEATURES ********************************************************************************************-->
            <section id="features" class="ts-block" data-bg-image="assets/img/bg-shapes-03.png" data-bg-size="inherit"
                data-bg-position="left" data-bg-repeat="no-repeat">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-xl-7 text-center">
                            <div class="position-relative">
                                <figure class="position-absolute text-center w-100 ts-z-index__1"
                                    data-animate="ts-zoomInShort">
                                    <img src="assets/img/img-screen-small-01.jpg"
                                        class="mw-100 d-inline-block ts-shadow__lg" alt="">
                                </figure>
                                <figure class="p-5" data-animate="ts-zoomInShort" data-delay="0.1s">
                                    <img src="assets/img/img-screen-desktop.jpg" class="mw-100 ts-shadow__lg" alt="">
                                </figure>
                                <figure class="position-absolute ts-bottom__0 ts-left__0 ts-z-index__2"
                                    data-animate="ts-zoomInShort" data-delay="0.2s">
                                    <img src="assets/img/img-screen-small-02.jpg"
                                        class="mw-100 d-inline-block ts-shadow__lg" alt="">
                                </figure>
                            </div>
                        </div>
                        <!--end col-xl-7-->
                        <div class="col-md-5 col-xl-5" data-animate="ts-fadeInUp" data-offset="100">
                            <div class="ts-title">
                                <h2>Features</h2>
                            </div>
                            <!--end ts-title-->
                            <p>
                                Vivamus fermentum magna non faucibus dignissim. Sed a venenatis mi, vel tempus neque.
                                Fusce pharetra, diam in hendrerit facilisis, enim diam cursus augue.
                            </p>
                            <!--features list-->
                            <ul class="list-unstyled ts-list-divided">
                                <li>
                                    <a href="#feature-1" class="ts-font-color__black" data-toggle="collapse" role="button"
                                        aria-expanded="false" aria-controls="feature-1">
                                        <h6 class="my-2">Real Time Statistics</h6>
                                    </a>
                                    <div class="collapse" id="feature-1">
                                        <p>
                                            Proin dapibus augue vitae massa placerat, vitae pulvinar lectus sodales.
                                            Suspendisse lobortis justo sed sapien placerat eleifend.
                                        </p>
                                    </div>
                                    <!--end collapse-->
                                </li>
                                <li>
                                    <a href="#feature-2" class="ts-font-color__black" data-toggle="collapse" role="button"
                                        aria-expanded="false" aria-controls="feature-2">
                                        <h6 class="my-2">Beautiful Charts</h6>
                                    </a>
                                    <div class="collapse" id="feature-2">
                                        <p>
                                            Proin dapibus augue vitae massa placerat, vitae pulvinar lectus sodales.
                                            Suspendisse lobortis justo sed sapien placerat eleifend.
                                        </p>
                                    </div>
                                    <!--end collapse-->
                                </li>
                                <li>
                                    <a href="#feature-3" class="ts-font-color__black" data-toggle="collapse" role="button"
                                        aria-expanded="false" aria-controls="feature-3">
                                        <h6 class="my-2">Activity Reminder</h6>
                                    </a>
                                    <div class="collapse" id="feature-3">
                                        <p>
                                            Proin dapibus augue vitae massa placerat, vitae pulvinar lectus sodales.
                                            Suspendisse lobortis justo sed sapien placerat eleifend.
                                        </p>
                                    </div>
                                    <!--end collapse-->
                                </li>
                            </ul>
                            <!--end features list-->
                        </div>
                        <!--end col-xl-5-->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--FEATURES ********************************************************************************************-->




            <section id="our-clients" class="ts-block text-center">
                <div class="container">
                    <div class="ts-title">
                        <h2>Our Clients</h2>
                    </div>
                    <!--end ts-title-->
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="owl-carousel ts-carousel-blockquote" data-owl-dots="1"
                                data-animate="ts-zoomInShort">
                                <blockquote class="blockquote">
                                    <!--person image-->
                                    <figure>
                                        <aside>
                                            <i class="fa fa-quote-right"></i>
                                        </aside>
                                        <div class="ts-circle__lg" data-bg-image="assets/img/person-05.jpg"></div>
                                    </figure>
                                    <!--end person image-->
                                    <!--cite-->
                                    <p>
                                        Morbi et nisl a sapien malesuada scelerisque. Suspendisse tempor turpis mattis nibh
                                        posuere. Aenean sagittis nisl.
                                        uthicula sagitti
                                    </p>
                                    <!--end cite-->
                                    <!--person name-->
                                    <footer class="blockquote-footer">
                                        <h4>Jane Doe</h4>
                                        <h6>CEO at MarketsGuru</h6>
                                    </footer>
                                    <a href="#download" class="btn btn-primary mb-4 ts-scroll">Download Now!</a>
                                    <!--end person name-->
                                </blockquote>
                                <!--end blockquote-->
                                <blockquote class="blockquote">
                                    <!--person image-->
                                    <figure>
                                        <aside>
                                            <i class="fa fa-quote-right"></i>
                                        </aside>
                                        <div class="ts-circle__lg" data-bg-image="assets/img/person-05.jpg"></div>
                                    </figure>
                                    <!--end person image-->
                                    <!--cite-->
                                    <p>
                                        Morbi et nisl a sapien malesuada scelerisque. Suspendisse tempor turpis mattis nibh
                                        posuere. Aenean sagittis nisl.
                                        uthicula sagitti
                                    </p>
                                    <!--end cite-->
                                    <!--person name-->
                                    <footer class="blockquote-footer">
                                        <h4>Jane Doe</h4>
                                        <h6>CEO at MarketsGuru</h6>
                                    </footer>
                                    <!--end person name-->
                                </blockquote>
                                <!--end blockquote-->
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!--end #our-clients.ts-block-->
        </main>
        <!--end #content-->

        <!--*********************************************************************************************************-->
        <!--************ FOOTER *************************************************************************************-->
        <!--*********************************************************************************************************-->
        <footer id="ts-footer">
            <section id="contact" class="ts-separate-bg-element" data-bg-image="assets/img/bg-desk.jpg"
                data-bg-image-opacity=".1" data-bg-color="#1b1464">
                <div class="container">
                    <div class="text-center text-white py-4">
                        <small>© 2021 Seroja Match Scheduler, All Rights Reserved</small>
                    </div>
                </div>
                <!--end container-->
            </section>

        </footer>
        <!--end #footer-->
    </div>
@stop
