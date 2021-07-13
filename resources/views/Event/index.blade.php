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
                        <div class="col-md-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                           No 
                                        </th>
                                        <th>
                                           ID
                                        </th>
                                        <th>
                                           Event Name
                                        </th>
                                        <th>
                                           Team
                                        </th>
                                        <th>
                                           Type
                                        </th>
                                        <th>
                                           Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>
                                                {{ $event->id }}
                                            </td>
                                            <td>
                                                {{ $event->user_id }}
                                            </td>
                                            <td>
                                                {{ $event->event_name }}
                                            </td>
                                            <td>
                                                {{ $event->number_of_team }}
                                            </td>
                                            <td>
                                                {{ $event->elimination_type }}
                                            </td>
                                            <td>
                                                {{ $event->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
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
