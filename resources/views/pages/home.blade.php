@section('title', 'Inicio')

<!DOCTYPE html>
<html lang="en">
    <x-head/>
    <body>
        <!-- Body Inner -->
        <div class="body-inner">
            <!-- Header -->
            <x-navbar type="dark"/>
            <!-- end: Header -->
            <!-- Inspiro Slider -->
            <div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-fade="true">
                <!-- Slide 2 -->
                <div class="slide" data-bg-video="video/vatmex-atc.mp4">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="slide-captions text-start text-light">
                            <!-- Captions -->
                            <h1>VATSIM México</h1>
                            <p class="text-small">VATMEX es la división mexicana de VATSIM. Nuestro propósito es brindar servicio de control de tránsito aéreo en México, al igual que proveer constante entrenamiento  y recursos a controladores y pilotos virtuales que deseen participar en la división.</p>
                            <div><a href="{{ route('atcs.apply') }}" class="btn btn-success scroll-to">¡Quiero ser ATC!</a></div>
                            <!-- end: Captions -->
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Inspiro Slider -->
            <!-- BLOG -->
            <section class="content">
                <div class="container">
                    <div class="heading-text heading-section">
                        <h2>PRÓXIMOS EVENTOS</h2>
                        <span class="lead">The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus,
                            orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id
                            molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare
                            orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor. </span>
                    </div>
                    <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
                        @foreach($events as $event)
                            <!-- Post item-->
                            <div class="post-item border">
                                <div class="post-item-wrap">
                                    <div class="post-image">
                                        <a href="{{ url('events') }}/{{ $event->slug }}">
                                            <img alt="{{ $event->name }}" src="{{ url('/storage/'.$event->banner_path) }}">
                                        </a>
                                    </div>
                                    <div class="post-item-description">
                                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{ Carbon\Carbon::parse($event->start)->toDateString() }}</span>
                                        <h2><a href="#">{{ $event->name }}</a></h2>
                                        <p>{{ Str::words($event->description, 25) }}</p>
                                        <a href="{{ url('events') }}/{{ $event->slug }}" class="item-link">Mas Info <i class="icon-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- end: Post item-->
                    </div>
                </div>
            </section>
            <!-- end: BLOG -->
            <!-- PORTFOLIO -->
            <section class="p-b-0 background-grey">
                <div class="container">
                    <div class="heading-text heading-section">
                        <h2>Recent Work</h2>
                        <span class="lead">Lorem ipsum dolor sit amet, coper suscipit lobortis nisl ut aliquip ex ea commodo
                            consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                            consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto.</span>
                    </div>
                </div>
                <div class="portfolio">
                    <!-- Portfolio Items -->
                    <div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="0">
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/1.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Gustavo Valdez" data-lightbox="image" href="images/portfolio/1.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/2.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Paper Pouch!" data-lightbox="image" href="images/portfolio/2.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/3.jpg" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Roberto Galvan" data-lightbox="image" href="images/portfolio/3.jpg"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/4.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Roberto Galvan" data-lightbox="image" href="images/portfolio/4.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/5.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Enrique Amador" data-lightbox="image" href="images/portfolio/5.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/6.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Gustavo Valdez" data-lightbox="image" href="images/portfolio/6.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/7.png" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Gustavo Valdez" data-lightbox="image" href="images/portfolio/7.png"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                        <!-- portfolio item -->
                        <div class="portfolio-item img-zoom ct-photography ct-marketing ct-media">
                            <div class="portfolio-item-wrap">
                                <div class="portfolio-image">
                                    <a href="#"><img src="images/portfolio/8.jpg" style="height: 202.5px;" alt=""></a>
                                </div>
                                <div class="portfolio-description">
                                    <a title="Crédito: Roberto Galvan" data-lightbox="image" href="images/portfolio/8.jpg"><i class="icon-maximize"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: portfolio item -->
                    </div>
                    <!-- end: Portfolio Items -->
                </div>
            </section>
            <!-- end: PORTFOLIO -->
            <!-- TEAM -->
            <section class="content">
                <div class="container">
                    <div class="heading-text heading-section text-center">
                        <h2>MEET OUR TEAM</h2>
                        <p>Nuestro enfoque es brindar un servicio de tránsito aéreo con orden y fluidez dentro del espacio aéreo mexicano, estamos enfocados con la experiencia de vuelo de cada piloto es por eso que estamos comprometidos con la profesionalidad y amabilidad, nos entregamos a este compromiso esforzándonos en la capacitación de nuestros controladores e instructores.</p>
                    </div>
                    <div class="row team-members">
                        @foreach ($team->staff as $staff)
                            <div class="col-lg-3">
                                <div class="team-member">
                                    <div class="team-image">
                                        @if ($staff->user)
                                            <img src="https://www.gravatar.com/avatar/{{ md5($staff->user->email) }}?s=525">
                                        @else
                                            <img src="https://www.gravatar.com/avatar/1?s=525">
                                        @endif
                                    </div>
                                    <div class="team-desc">
                                        <h3>{{ ($staff->user) ? $staff->user->name : 'Vacante'; }}</h3>
                                        <span>{{ $staff->position }}</span>
                                        <p>{{ $staff->description }}</p>
                                        <div class="align-center">
                                            <a class="btn btn-xs btn-slide btn-light" href="mailto:{{ ($staff->user) ? $staff->user->email : ''; }}" data-width="80">
                                                <i class="icon-mail"></i>
                                                <span>Mail</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- end: TEAM -->
            <!-- COUNTERS -->
            <section class="text-light p-t-150 p-b-150 " data-bg-parallax="images/parallax/12.jpg">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="text-center">
                                <div class="icon"><i class="fa fa-3x fa-code"></i></div>
                                <div class="counter"> <span data-speed="3000" data-refresh-interval="50" data-to="12416" data-from="600" data-seperator="true"></span> </div>
                                <div class="seperator seperator-small"></div>
                                <p>LINES OF CODE</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <div class="icon"><i class="fa fa-3x fa-coffee"></i></div>
                                <div class="counter"> <span data-speed="4500" data-refresh-interval="23" data-to="365" data-from="100" data-seperator="true"></span> </div>
                                <div class="seperator seperator-small"></div>
                                <p>CUPS OF COFFEE</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <div class="icon"><i class="fa fa-3x fa-rocket"></i></div>
                                <div class="counter"> <span data-speed="3000" data-refresh-interval="12" data-to="114" data-from="50" data-seperator="true"></span> </div>
                                <div class="seperator seperator-small"></div>
                                <p>FINISHED PROJECTS</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <div class="icon"><i class="fa fa-3x fa-smile-o"></i></div>
                                <div class="counter"> <span data-speed="4550" data-refresh-interval="50" data-to="14825" data-from="48" data-seperator="true"></span> </div>
                                <div class="seperator seperator-small"></div>
                                <p>SATISFIED CLIENTS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end: COUNTERS -->
            <!-- Footer -->
            <x-footer/>
            <!-- end: Footer -->
        </div>
        <!-- end: Body Inner -->
        <!-- Scroll top -->
        <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
        <!--Plugins-->
        <script src="js/jquery.js"></script>
        <script src="js/plugins.js"></script>
        <!--Template functions-->
        <script src="js/functions.js"></script>

        <x-success-flash/>
    </body>
</html>
