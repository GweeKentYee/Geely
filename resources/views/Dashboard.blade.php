@extends('layouts.app')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    @if($Dash->count()>0)
        <div class="carousel-inner">
            @for ($i=0;$i<$Dash->count();$i++)
                @if ($i==0)
                        <a class="carousel-item active" href="{{$Dash->get($i)->title}}" target="_blank">
                            <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="First slide">
                        </a>
                    @else
                        <a class="carousel-item" href="{{$Dash->get($i)->title}}" target="_blank">
                            <img class="d-block w-100" src="{{$Dash->get($i)->image}}" alt="Second slide">
                        </a>
                @endif
            @endfor
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    @endif
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>
                Cars of the day
            </h1>
        </div>

        <div class="col-md-8" style="display:flex; justify-content: center;">
            @php($i=0)
            @foreach ($usedcar as  $usedcars)
                @php($i++)
                <a href="/catalogue" class="cata-card" style="width: 15rem; display: inline-block;">
                    <div style="display:flex; justify-content: center; margin:5px;">
                        <div class="cata-card-image" style="width: 12.5rem;height: 12.5rem;justify-content:center;">
                            @if (!empty($usedcars->usedCarImages->get(0)->image))
                                <img src="{{$usedcars->usedCarImages->get(0)->image}}" alt="" width="200" height="200">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="black" class="bi bi-images" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                </svg>
                                <span class="overlay-text">Image Unavailable</span>
                            @endif  
                        </div>
                    </div>
                    <div class="cata-card-title">CAR MODEL : </div>
                    <div class="cata-card-subtitle">{{$usedcars->car->carModel->model}}</div>
                    <div class="cata-card-title">PRICE : </div>
                    <div class="cata-card-subtitle">RM {{$usedcars->min_price}} to RM {{$usedcars->max_price}}</div>
                </a>
                @if ($i ==3)
                    @break
                @endif

            @endforeach
        </div>

        <div class="col-md-8">
            <h1>
                About our system
            </h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla commodo, massa laoreet dictum lacinia, enim nunc imperdiet diam, id cursus dolor metus et tortor. Maecenas varius augue in enim sodales, eu rhoncus orci pretium. Praesent eros ex, faucibus ullamcorper tincidunt a, varius vitae lorem. Nam et velit eget augue faucibus pharetra ac sit amet sem. Praesent lectus urna, varius a erat ac, semper finibus dolor. Nullam rhoncus orci a porta interdum. Etiam pretium non urna ut ultricies. Vestibulum volutpat arcu et arcu auctor, non dapibus ipsum hendrerit. Vivamus placerat tincidunt turpis, sed semper massa hendrerit at. Phasellus pretium est vitae enim volutpat, vitae finibus tellus laoreet. Morbi nisl enim, pellentesque quis luctus eu, tempus vitae velit. Vestibulum non augue at tellus iaculis vehicula sit amet vitae ipsum. Duis sit amet rhoncus dui. Suspendisse eu eros eget nunc hendrerit aliquam a vel ante.
            </p>
        </div>

        <div class="col-md-8">
            <svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 800 600" overflow="visible" xml:space="preserve">
                <g id="Layer_2">
                    <rect fill="#BFBFBF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" width="800" height="600"></rect>
                </g>
                <g id="Layer_1">
                    <g id="general">
                        <g id="top">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M408.1,208.8c-6.7-0.1-12.1,0.8-12,1.9
                                c0.1,1.1,5.6,2.1,12.3,2.2c6.7,0.1,12.1-0.8,12-1.9C420.3,209.9,414.8,208.9,408.1,208.8z M530.3,374.2c-0.4-0.4-1-1-1.8-1.9
                                c0,0-0.1,0-0.1-0.1c-1.8-1.9-4.5-4.8-7.6-8.2l-0.9-1l-9.6-10.4c-18.4,0.2-37.3,0.8-56.8,1.7c-26.4,1.4-51.6,3.4-75.7,5.9
                                c-0.5-6.6-0.9-13.3-1.2-20.2c-0.7-13.8-0.9-27.2-0.9-40.1c-0.1-12.9,0.2-26.3,0.9-40.4c0.3-6.8,0.7-13.6,1.2-20.2
                                c24.1,2.6,49.3,4.8,75.7,6.1c2.4,0.1,4.8,0.2,7.2,0.3c2.1,0.1,4.2,0.2,6.3,0.3c4.8,0.2,9.5,0.4,14.2,0.5c1.4,0,2.9,0.1,4.3,0.1
                                c4.6,0.1,9.2,0.2,13.7,0.3c3,0.1,5.9,0.1,8.9,0.1h1.7l9.9-10.3l0.2-0.2c4.8-5.3,8.9-9.6,10.4-11.2c0.7-0.8,1.4-1.5,1.9-2.1
                                l-3.8-0.2l0.1-0.1c-26.9-2.6-55.3-4.6-85-5.9l-9.7-0.3h-0.1l-10-0.4c-3.7-0.1-7.4-0.2-11.2-0.3c-33.8-0.7-66-0.3-96.5,1
                                c-5,0.2-9.9,0.5-14.8,0.7c0,0,0,0,0,0c-0.4,0-0.9,0-1.3,0.1c0.2,0,0.3,0.1,0.5,0.1c-10.6,2.1-22.9,4.7-34.1,7.4
                                c-9,2.2-17.9,4.5-26.4,6.9c5-3.4,10.1-6.9,15.2-10.2c-4-0.6-9.9-1-16.9,0c-3,0.4-6.3,1.1-9.7,2.1c-16.6,5-26.5,15.8-30.8,21.4
                                c0,0,0,0,0,0c-0.4,0.5-0.8,1-1.1,1.5c0.2-0.1,0.3-0.1,0.5-0.2c-0.7,1.4-1.7,3.3-2.3,4.7c0,0,0,0,0,0c0,0-0.1,0.1-0.1,0.2
                                c0,0.1-0.1,0.2-0.1,0.3c0,0,0,0,0,0.1c-1.6,4.1-3.2,8.7-4.5,13.7c-3.5,13.4-3.5,24.6-3.4,34.1c-0.1,9.5,0,20.7,3.4,34.1
                                c1.2,4.8,2.7,9.3,4.3,13.2c0,0,0,0.1,0,0.1c0,0.1,0.1,0.2,0.1,0.1c0.6,1.7,1.6,3.8,2.2,5.3c0,0,0,0-0.1,0c0,0,0.1,0.1,0.1,0.1
                                c3.6,5,13.8,17.3,31.8,23c3.5,1,6.8,1.7,9.9,2.2c6.9,0.9,12.7,0.5,16.7-0.1c-5.2-3.5-10.3-7-15.4-10.4c8.5,2.4,17.5,4.8,26.6,6.9
                                c11.3,2.8,23.4,5.3,34.1,7.4c-0.1,0-0.3,0.1-0.5,0.1c5.3,0.3,10.7,0.6,16.2,0.8c30.5,1.3,62.7,1.7,96.5,1
                                c3.8-0.1,7.5-0.2,11.2-0.3l9.9-0.4h0.1l9.7-0.3l0-0.2c28-1.2,55-3,80.5-5.3l8.5-0.7C531.9,376,531.1,375.1,530.3,374.2z
                                M514.6,214.3c6.7,0,12.1-0.8,12-1.9c-0.1-1.1-5.6-2.1-12.3-2.2c-6.7-0.1-12.1,0.8-12,1.9C502.4,213.2,507.9,214.2,514.6,214.3z
                                M514.6,385.7c-6.7,0.1-12.2,1.1-12.3,2.2c-0.1,1.1,5.3,2,12,1.9c6.7-0.1,12.2-1.1,12.3-2.2C526.7,386.5,521.3,385.7,514.6,385.7
                                z M408.4,387.1c-6.7,0.1-12.2,1.1-12.3,2.2c-0.1,1.1,5.3,2,12,1.9c6.7-0.1,12.2-1.1,12.3-2.2C420.5,387.9,415.1,387,408.4,387.1z
                                M544.2,229.2c-0.4-0.4-0.9-0.8-1.4-1.2c0,0,0,0-0.1-0.1c-1.7-1.4-3.7-2.5-5.8-3.3l-12.8,11c6.2-0.3,12.3-0.7,18.2-1.2
                                C545.1,234.3,546.2,231,544.2,229.2z M542.3,365.6c-5.9-0.5-12-0.9-18.2-1.2l12.8,11c2.1-0.8,4.1-1.9,5.8-3.3
                                c0.1-0.1,0.1-0.1,0.1-0.1c0.5-0.4,1-0.8,1.4-1.2C546.2,369,545.1,365.7,542.3,365.6z M600.6,226.8c-0.5-0.5-1-0.9-1.5-1.4
                                c-4.6-4.2-9.5-7.3-13.3-9.5s-6.7-3.4-7.3-3.7l5.4,9.4c-1.6-0.1-3.2-0.1-4.6,0c-0.1,0-0.2-0.1-0.3-0.1c-0.4,0-0.9,0.1-1.4,0.2
                                c-2,0.3-4.6,1.1-7.3,2.5c-5.3,2.6-8.4,6.5-9.8,8.6c0,0,0.1,0,0.2,0c-1.1,1.7-2.4,3.9-3.5,6.8c-0.8,2.4-1.4,5.4-1.7,7.4h0.2
                                l0.1,53l-0.1,51.5v0.1c0.1,1.9,0.5,5.8,1.5,8.7c0.9,2.5,2.2,5,3.4,6.9h-0.1c0.2,0.4,0.5,0.8,0.9,1.2c1.6,2.2,4.5,5.2,8.9,7.4
                                c3.4,1.7,6.5,2.3,8.6,2.5c1.4,0.1,3.2,0.1,5,0.1l-5.6,9.8h0.1c0,0,12-4.9,22.3-14.6c26.5-25.1,24.4-67.3,24.4-73.5
                                C625,293.9,627.1,251.6,600.6,226.8z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M324.2,210.6c2,3.3,8.1,4.5,11.9,2.4
                                c1.4-0.8,2.1-1.9,5.4-10.5c3.5-9.2,3.6-10.4,3-11.1c-1.8-2-8,0.4-12.1,3.4C327.5,198.3,321.4,205.9,324.2,210.6z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M431.9,208.2l1.8,8.2
                                c1.1,2.6,2.3,5.4,3.4,8.2c1.4,3.8,2.7,7.5,3.7,11"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M524.6,207.7c-0.1-0.1-0.2-0.1-0.3-0.2"></path>
                            <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="517.3" y1="236" x2="524.7" y2="235.6"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="251.1" y1="208.4" x2="250.8" y2="208.7"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="238.2" y1="222.1" x2="238.1" y2="222.2"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M301.2,217.8c-0.3,0.1-0.6,0.1-0.9,0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M239.9,232.3c-0.1,0-0.3,0.1-0.4,0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M313,209c0-0.1-0.1-0.1-0.1-0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M316.1,217.2
                                C316.1,217.2,316.1,217.1,316.1,217.2"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M599.6,236.9c-6.1-1.8-13.8-3.4-22.6-4.1
                                c-6-0.5-11.6-0.4-16.4,0c-0.1,0-0.1,0-0.2,0c1.4-2.1,4.5-6,9.8-8.6c2.7-1.4,5.3-2.2,7.3-2.5c0.5-0.1,1-0.2,1.4-0.2
                                c0.1,0,0.2,0.1,0.3,0.1c2.6,1.1,5.4,2.6,8.5,4.7C593.2,229.8,597,233.8,599.6,236.9z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M599.7,225.7c-0.2-0.1-0.4-0.2-0.6-0.3l0,0
                                c-3-1.3-7.2-2.9-12.4-3.5c-0.9-0.1-1.9-0.2-2.9-0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M579.2,221.6c-0.6,0-1.2,0-1.7,0.1
                                c0,0,0,0-0.1,0"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="578.4" y1="212.3" x2="578.2" y2="211.8"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="583.9" y1="221.7" x2="583.8" y2="221.7"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.1,232c-0.2,0.2-0.4,0.5-0.5,0.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M555.4,247c-0.1,0.4-0.1,0.9-0.1,1.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M292.8,229.4c-0.4,0-0.8,0.1-1.2,0.1l0,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M194.7,251.6c-0.2,0.1-0.5,0.1-0.7,0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M420.4,211c0.1,1.1-5.3,2-12,1.9
                                c-6.7-0.1-12.2-1.1-12.3-2.2c-0.1-1.1,5.3-2,12-1.9C414.8,208.9,420.3,209.9,420.4,211z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M526.6,212.4c0.1,1.1-5.3,1.9-12,1.9
                                c-6.7-0.1-12.2-1.1-12.3-2.2c-0.1-1.1,5.3-2,12-1.9C521,210.3,526.5,211.3,526.6,212.4z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M324.2,389.4c2-3.3,8.1-4.5,11.9-2.4
                                c1.4,0.8,2.1,1.9,5.4,10.5c3.5,9.2,3.6,10.4,3,11.1c-1.8,2-8-0.4-12.1-3.4C327.5,401.7,321.4,394.1,324.2,389.4z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M431.9,391.8l1.8-8.2
                                c1.1-2.6,2.3-5.4,3.4-8.2c1.4-3.8,2.7-7.5,3.7-11"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M524.8,392.6c-0.3,0.2-0.5,0.3-0.7,0.5"></path>
                            <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="517.3" y1="364" x2="524.7" y2="364.4"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M194.5,252.2c-0.1,0.1-0.1,0.2-0.1,0.3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M194.7,251.6c-0.1,0.2-0.2,0.3-0.2,0.5"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M197.7,245.6c-0.2,0.3-0.4,0.8-0.6,1.3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M196.9,353.4c-0.1-0.1-0.1-0.3-0.2-0.4
                                c0,0,0-0.1-0.1-0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M194.4,347.6c0-0.1-0.1-0.2-0.1-0.3
                                c0,0,0,0,0,0"></path>
                            <g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M196.6,247.1c8-3.2,16.5-6.3,25.4-9.2c6-2,11.8-3.8,17.6-5.4
                                        c5.1-3.5,10.3-7,15.5-10.4c-5.8-0.8-15.4-1.3-26.6,2.1C210.3,229.7,200.1,242.2,196.6,247.1z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M196.6,352.9c8,3.2,16.5,6.3,25.4,9.2c6,2,11.8,3.8,17.6,5.5
                                        c5.1,3.5,10.3,7,15.5,10.5c-5.8,0.8-15.4,1.3-26.6-2.1C210.3,370.3,200.1,357.8,196.6,352.9z"></path>
                                </g>
                                <g>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M196.6,247.1c8-3.2,16.5-6.3,25.4-9.2
                                        c6-2,11.8-3.8,17.6-5.4c5.1-3.5,10.3-7,15.5-10.4c-5.8-0.8-15.4-1.3-26.6,2.1C210.3,229.7,200.1,242.2,196.6,247.1z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M196.6,352.9c8,3.2,16.5,6.3,25.4,9.2
                                        c6,2,11.8,3.8,17.6,5.5c5.1,3.5,10.3,7,15.5,10.5c-5.8,0.8-15.4,1.3-26.6-2.1C210.3,370.3,200.1,357.8,196.6,352.9z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M255.1,222.1
                                        c-5.1,3.3-10.2,6.8-15.2,10.2c-0.1,0.1-0.2,0.1-0.3,0.2c-5.8,1.6-11.6,3.4-17.6,5.4c-8.7,2.8-17.1,5.9-25,9
                                        c-0.1,0.1-0.3,0.1-0.5,0.2c0.3-0.4,0.7-0.9,1.1-1.5c0,0,0,0,0,0c4.3-5.6,14.2-16.4,30.8-21.4c3.4-1,6.6-1.7,9.7-2.1
                                        C245.2,221.1,251,221.5,255.1,222.1z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M255.1,378.1c-4,0.6-9.8,1-16.7,0.1
                                        c-3.1-0.4-6.4-1.1-9.9-2.2c-18-5.7-28.2-18-31.8-23c0,0-0.1-0.1-0.1-0.1c0,0,0,0,0.1,0c8,3.2,16.5,6.3,25.3,9.2
                                        c6,2,11.8,3.8,17.6,5.5c0,0,0.1,0,0.1,0.1C244.8,371.1,249.9,374.6,255.1,378.1z"></path>
                                </g>
                            </g>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="250.7" y1="391.2" x2="250.6" y2="391.1"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="238.4" y1="378.1" x2="238.1" y2="377.8"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M300.9,382.1c-0.2,0-0.3-0.1-0.5-0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M239.7,367.6c-0.1,0-0.1,0-0.2,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M313,390.9c0,0.1-0.1,0.2-0.1,0.3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M316.2,382.6c0,0.1-0.1,0.2-0.1,0.2"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M599.6,363.1c-2.6,3.1-6.4,7.1-11.9,10.6
                                c-3.2,2.1-6.2,3.5-8.9,4.6l0,0c-2.1-0.2-5.2-0.8-8.6-2.5c-4.4-2.2-7.3-5.2-8.9-7.4c-0.3-0.4-0.6-0.8-0.9-1.2h0.1
                                c4.9,0.4,10.5,0.5,16.5,0C585.8,366.5,593.5,364.9,599.6,363.1z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M433.3,235.7
                                c-7.1-0.4-14.3-0.8-21.6-1.4c-11.6-0.9-22.9-2.1-33.8-3.4c-28.1-3.4-54.1-7.9-77.5-12.9c-0.2,0-0.3-0.1-0.5-0.1
                                c0.4,0,0.9-0.1,1.3-0.1c0,0,0,0,0,0c4.9-0.3,9.9-0.5,14.8-0.7c30.5-1.3,62.7-1.7,96.5-1c3.8,0.1,7.5,0.2,11.2,0.3L433.3,235.7z"></path>
                            <g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M528.5,223c-26.9-2.6-55.3-4.6-85-5.9l4.6,19.3
                                        c24.6,0.9,47.7,0.6,69.2-0.4L528.5,223z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M544.2,229.2c-0.4-0.4-0.9-0.8-1.4-1.2c0,0,0,0-0.1-0.1
                                        c-1.7-1.4-3.7-2.5-5.8-3.3l-12.8,11c6.2-0.3,12.3-0.7,18.2-1.2C545.1,234.3,546.2,231,544.2,229.2z"></path>
                                </g>
                                <g>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M528.5,223c-26.9-2.6-55.3-4.6-85-5.9
                                        l4.6,19.3c24.6,0.9,47.7,0.6,69.2-0.4L528.5,223z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M544.2,229.2c-0.4-0.4-0.9-0.8-1.4-1.2
                                        c0,0,0,0-0.1-0.1c-1.7-1.4-3.7-2.5-5.8-3.3l-12.8,11c6.2-0.3,12.3-0.7,18.2-1.2C545.1,234.3,546.2,231,544.2,229.2z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6165" stroke-linejoin="round" d="M528.5,223L528.5,223l-11.2,13
                                        c-21.5,1-44.6,1.3-69.2,0.4l-4.6-19.3C473.2,218.4,501.6,220.4,528.5,223z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6165" stroke-linejoin="round" d="M542.3,234.4
                                        c-5.9,0.5-12,0.9-18.2,1.2l12.8-11c2.1,0.8,4.1,1.9,5.8,3.3c0.1,0.1,0.1,0.1,0.1,0.1c0.5,0.4,1,0.8,1.4,1.2
                                        C546.2,231,545.1,234.3,542.3,234.4z"></path>
                                </g>
                            </g>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M433.3,364.3l-9.5,19.3
                                c-3.7,0.1-7.4,0.2-11.2,0.3c-33.8,0.7-66,0.3-96.5-1c-5.5-0.2-10.8-0.5-16.2-0.8c0.1,0,0.3-0.1,0.5-0.1
                                c23.5-5,49.4-9.5,77.5-12.9c10.9-1.3,22.2-2.5,33.8-3.4C419,365.1,426.2,364.7,433.3,364.3z"></path>
                            <g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M528.5,377c-26.9,2.6-55.3,4.6-85,5.9l4.6-19.3
                                        c24.6-0.9,47.7-0.6,69.2,0.4L528.5,377z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-miterlimit="10" d="M544.2,370.8c-0.4,0.4-0.9,0.8-1.4,1.2c0,0,0,0-0.1,0.1
                                        c-1.7,1.4-3.7,2.5-5.8,3.3l-12.8-11c6.2,0.3,12.3,0.7,18.2,1.2C545.1,365.7,546.2,369,544.2,370.8z"></path>
                                </g>
                                <g>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M528.5,377c-26.9,2.6-55.3,4.6-85,5.9
                                        l4.6-19.3c24.6-0.9,47.7-0.6,69.2,0.4L528.5,377z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M544.2,370.8c-0.4,0.4-0.9,0.8-1.4,1.2
                                        c0,0,0,0-0.1,0.1c-1.7,1.4-3.7,2.5-5.8,3.3l-12.8-11c6.2,0.3,12.3,0.7,18.2,1.2C545.1,365.7,546.2,369,544.2,370.8z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6165" stroke-linejoin="round" d="M528.5,377c-1.5,0.1-3,0.3-4.5,0.4
                                        c-25.5,2.4-52.5,4.1-80.5,5.3c-0.1,0-0.1,0-0.2,0l4.8-19.2c24.6-0.9,47.7-0.6,69.2,0.4L528.5,377z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6165" stroke-linejoin="round" d="M544.2,370.8
                                        c-0.4,0.4-0.9,0.8-1.4,1.2c0,0,0,0-0.1,0.1c-1.7,1.4-3.7,2.5-5.8,3.3l-12.8-11c6.2,0.3,12.3,0.7,18.2,1.2
                                        C545.1,365.7,546.2,369,544.2,370.8z"></path>
                                </g>
                            </g>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M607.1,300c0,3.1,1.4,50.4-19.3,59.3
                                c-1.8,0.8-3.8,1.3-6,1.4c1.1-1.8,2.1-3.6,3.1-5.5c9.8-19.2,11.4-39,11.4-55.1s-1.6-35.9-11.4-55.1c-1-1.9-2-3.8-3.1-5.6
                                c2.3,0.1,4.3,0.6,6,1.4C608.5,249.6,607.1,296.9,607.1,300z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M599.7,363.1c0.5-0.7,1.2-1.7,1.9-3
                                c4.5-7.7,6.5-15.5,8-28.9c0.9-8.2,1.4-18.8,1.4-31.2c0-12.4-0.5-23-1.4-31.2c-1.5-13.4-3.5-21.2-8-28.9c-0.8-1.3-1.5-2.4-1.9-3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M583.8,378.3c0.9,0,1.9-0.1,2.9-0.2
                                c5.5-0.7,9.9-2.4,13-3.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M578.8,378.3c-0.1,0-0.3,0-0.4,0"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="578.2" y1="388.1" x2="578.1" y2="388.4"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="583.9" y1="378.2" x2="583.8" y2="378.3"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.6,369c-0.1-0.2-0.2-0.4-0.4-0.5
                                c-0.2-0.4-0.5-0.8-0.8-1.2"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="555.6" y1="351.6" x2="555.6" y2="351.5"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M294.6,370.7c-0.6-0.1-1.1-0.1-1.7-0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M194.4,347.6c-0.3-0.1-0.6-0.2-0.9-0.3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M420.4,389c-0.1,1.1-5.6,2.1-12.3,2.2
                                c-6.7,0.1-12.1-0.8-12-1.9c0.1-1.1,5.6-2.1,12.3-2.2C415.1,387,420.5,387.9,420.4,389z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M526.6,387.6c-0.1,1.1-5.6,2.1-12.3,2.2
                                c-6.7,0.1-12.1-0.8-12-1.9c0.1-1.1,5.6-2.1,12.3-2.2C521.3,385.7,526.7,386.5,526.6,387.6z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M581.7,239.3c-2.4-1.5-5.9-3.4-10.3-4.8
                                c-4.3-1.3-8.2-1.7-11-1.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M581.7,360.7c-2.4,1.5-5.9,3.4-10.3,4.8
                                c-4.3,1.3-8.2,1.7-11,1.8"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M376.7,340.1c0.3,6.9,0.7,13.6,1.2,20.2
                                c-25.8,3.5-51.7,7-77.5,10.5c-2.2,0.3-4.5,0.2-6.6-0.1c-0.3,0-0.6-0.1-0.9-0.2s-0.7-0.2-1-0.2c-5-1.3-9.4-4.5-12.3-8.9
                                c-1.9-3-3.8-6.5-5.5-11.2c-7-19-6.5-31.9-6.5-50.2c0-18.3-0.5-31.1,6.5-50.2c1.7-4.7,3.6-8.2,5.5-11.2c2.7-4.1,6.7-7.1,11.2-8.7
                                c0.3-0.1,0.6-0.2,0.9-0.3l0,0c2.8-0.8,5.8-1.1,8.7-0.7c25.8,3.5,51.6,7,77.4,10.5h0.1c-0.5,6.6-0.9,13.4-1.2,20.2
                                c-0.7,14.1-1,27.5-0.9,40.4C375.8,312.9,376,326.3,376.7,340.1z"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="377.8" y1="239.6" x2="377.8" y2="239.4"></line>
                        </g>
                        <g id="left">
                            <g>
                                <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M208,530.2c0.7,2.4-0.9,4.8-3.4,5
                                    l-12.6,1.1c-1.8,0.2-3.4-0.9-4-2.6c-0.1-0.4-0.3-0.8-0.4-1.2c-0.1-0.4-0.2-0.8-0.2-1.3c0-1.8,1.2-3.5,3-3.9l12.1-2.8
                                    c2-0.5,3.9,0.7,4.6,2.7L208,530.2z"></path>
                                <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M590.2,482.6l0.2,0.2
                                    C590.4,482.8,590.3,482.7,590.2,482.6L590.2,482.6z"></path>
                                <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M621.8,494.6c-3.9,0-18.8-0.5-31.3-11.8
                                    c-8.3-7.7-12.2-17.2-13.4-21.4c-12.9,0.4-26.7,1.2-40,1.8c-3.1,11.2-14.3,31.8-47.4,69.8c-15.3,0.4-38.5,0.7-56.7,1v0.1
                                    c-37.8,0.7-75.6,1.4-113.5,2.1c-3.6-15.1-6.1-33.7-4.4-54.7c0-0.7,0.1-1.4,0.2-2.1c0.4-4.7,1-9.2,1.8-13.5c-4,0.3-8,0.7-12,1.1
                                    c-2.2,0.2-3.8-1.5-3.9-3.3c-15.2,2.8-27.6,4.3-36.1,5.2c-4.2,0.4-8.3,0.8-14.8,1.6c-9.3,1.1-18.9,2.9-25,4.1
                                    c6.8,0.8,13.5,1.6,20.2,2.5c1,0.1,1.2,1.6,0.2,2c-3.8,1.5-7.8,2.9-12,4.2c-9.3,3-19.7,5.6-31,7.5c-4.9,0.8-9.7,1.4-14.3,1.9
                                    c-1.1,0.1-1.6-1.3-0.7-1.9c1.3-0.9,2.7-1.8,4.1-2.7l-5.4-3.2c9.3-5.4,20.6-11,33.7-15.8c17.2-6.3,32.7-9.5,45.1-11.1
                                    c2,0,4.3-0.1,7-0.3c2.7-0.2,5.6-0.5,8.9-1c3.5-0.5,7.3-1.3,11.3-2.3c19.8-5.1,28.8-13.4,51.4-23.9c7.9-3.6,19.7-8.6,35-13.1
                                    c-0.9-1.3-1.8-2.6-2.7-3.9c24.8-5.3,65.1-11.8,111.2-9.9c8.5,0.4,40.5,2,81,10.8c6.1,1.3,11.2,2.5,14.8,3.4
                                    c-1.2,2.1-6.9,11.6-8.5,14.2c9.5,5.5,16.1,10.9,20.3,14.8c3.6,3.4,5.7,5.9,7.6,8.7c0.2,0.3,0.4,0.6,0.6,0.9
                                    c0.8,1.3,1.6,2.8,2.4,4.4c1.1,2.4,1.9,4.8,2.5,6.8c0.2,4,1.2,13.7,8.4,21.8c1.3,1.4,2.6,2.6,3.9,3.6
                                    C620.8,493.5,621.4,494,621.8,494.6z"></path>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M434.5,414.3l-1.5,4l-7,34.7v3.4
                                c-36.3,3.2-72.5,6.3-108.9,9.5c-4,0.3-8,0.7-12,1.1c-2.2,0.2-3.8-1.5-3.9-3.3c-0.1-1.2,0.3-2.6,1.6-3.4
                                c23.5-15.2,61.8-35.2,112.7-43.5C422,415.8,428.3,414.9,434.5,414.3z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M550.4,430.7c-1.1,2.2-2.6,4.7-4.6,7.2
                                c-2.7,3.5-5.5,6.2-7.9,8.1c-0.6,0.5-1.2,0.7-2,0.8c-0.4,0-0.7,0.1-1.1,0.1c-29.9,2.6-59.8,5.2-89.7,7.8l0.4-3.4h-0.2l3.5-34.6
                                h0.1l0.2-3.4c27.6-1.3,51.8,1.5,71.1,5.3c11,2.2,20.4,4.6,27.9,6.9C550.4,426.2,551.4,428.6,550.4,430.7z"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M594.9,446.7c3.6,3.3,5.8,5.8,7.6,8.7
                                    c0.2,0.3,0.4,0.6,0.6,0.9c-2.8-6.3-6.9-13.8-13-21.3c-3.6-4.5-7.3-8.1-10.8-11.1c-1.6,2.6-3.2,5.3-4.8,8
                                    C584.1,437.4,590.7,442.9,594.9,446.7z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M343.7,430.4c7.9-3.6,19.7-8.6,35-13.1
                                    c-0.9-1.3-1.8-2.6-2.7-3.9c-15.2,5.6-31.2,12.2-47.8,19.7c-17,7.7-32.7,15.7-47.2,23.5c3.5-0.5,7.3-1.3,11.3-2.3
                                    C312.1,449.2,321.1,440.9,343.7,430.4z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M433.1,417.9l-0.1,0.4l-7,34.7l0,0
                                    l-121,10.7h-0.1c0,0-0.1,0-0.2-0.2s0-0.2,0.1-0.3c33.6-21.7,72.1-36.6,111.4-43C421.7,419.2,427.4,418.5,433.1,417.9z"></path>
                                <g>
                                    <g>
                                        <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M547.4,428.9c0-0.1-0.1-0.1-0.2-0.2
                                            c-6.9-2.1-13.9-3.9-20.9-5.5l10.4,19.3c2.4-2,4.5-4.3,6.5-6.8C544.8,433.6,546.2,431.3,547.4,428.9
                                            C547.4,429.1,547.5,429,547.4,428.9z"></path>
                                        <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M517.7,421.5c-18-3.4-36.4-5.2-54.8-5.2
                                            c-4.7,0-9.4,0.1-14.1,0.4l-3.5,34.6l82-7.2L517.7,421.5z"></path>
                                    </g>
                                    <g>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M547.4,428.9c0-0.1-0.1-0.1-0.2-0.2
                                            c-6.9-2.1-13.9-3.9-20.9-5.5l10.4,19.3c2.4-2,4.5-4.3,6.5-6.8C544.8,433.6,546.2,431.3,547.4,428.9
                                            C547.4,429.1,547.5,429,547.4,428.9z"></path>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M517.7,421.5
                                            c-18-3.4-36.4-5.2-54.8-5.2c-4.7,0-9.4,0.1-14.1,0.4l-3.5,34.6l82-7.2L517.7,421.5z"></path>
                                    </g>
                                    <g>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M547.4,428.9c0-0.1-0.1-0.1-0.2-0.2
                                            c-6.9-2.1-13.9-3.9-20.9-5.5l10.4,19.3c2.4-2,4.5-4.3,6.5-6.8C544.8,433.6,546.2,431.3,547.4,428.9
                                            C547.4,429.1,547.5,429,547.4,428.9z"></path>
                                        <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M527.3,444.1l-81.8,7.2h-0.2l3.5-34.6
                                            h0.1c4.7-0.3,9.3-0.4,14-0.4c18.4,0,36.8,1.8,54.8,5.2L527.3,444.1z"></path>
                                    </g>
                                </g>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M418.3,474c0.1,1.1-5.2,2.5-11.9,2.9
                                c-6.7,0.4-12.1-0.1-12.2-1.2s5.3-2.4,11.9-2.9C412.8,472.4,418.2,472.9,418.3,474z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M527.2,465.5c0.1,1.1-5.2,2.4-11.9,2.9
                                c-6.7,0.4-12.1-0.1-12.2-1.2s5.3-2.4,11.9-2.9C521.7,463.9,527.1,464.4,527.2,465.5z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M441.8,413.7L441.8,413.7"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M317.1,465.9L317.1,465.9"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M433,534c-4.2,0.1-8.1,0.2-11.7,0.2"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M534.8,446.9c-1.3-2.7-3-6-4.5-9
                                c-4.2-8.2-7.6-14.8-10-19.3c-0.1-0.2-0.2-0.5-0.4-0.7"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M183.7,515c1.3-1.4,1.8-3.3,1.5-5.1
                                    c-0.7-3.5-2.1-8-5.3-12.5c-1.3-1.8-2.6-3.2-3.9-4.4c-0.8,5.2-1.2,11.5-0.9,18.5c0.2,3.1,0.5,6.1,0.9,8.9
                                    c1.4-0.6,3.4-1.6,5.4-3.2C182.3,516.4,183.1,515.7,183.7,515z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M204.6,535.2l-12.6,1.1
                                    c-1.8,0.2-3.4-0.9-4-2.6c-0.1-0.4-0.3-0.8-0.4-1.2c-0.1-0.4-0.2-0.8-0.2-1.3c0-1.8,1.2-3.5,3-3.9l12.1-2.8
                                    c2-0.5,3.9,0.7,4.6,2.7l0.9,3C208.7,532.6,207.1,535,204.6,535.2z"></path>
                            </g>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="251.3" y1="500.4" x2="251.1" y2="500.2"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="233.7" y1="483.3" x2="233.5" y2="483.1"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="186.4" y1="484.9" x2="186.1" y2="484.7"></line>
                            <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="192" y1="488.2" x2="191.8" y2="488.1"></line>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M565.2,501.4
                                c1.2-1.2,20.8-15.6,24.5-18.4L565.2,501.4L565.2,501.4C565.1,501.5,565.1,501.5,565.2,501.4z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M549.8,410.6c0.8,2.8,1.9,6,3.4,9.3
                                c2.5,5.5,5.6,9.8,8.2,13"></path>
                            <g>
                                <g>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M561.4,432.9c5.8,3,12.7,7.1,19.7,12.9
                                        c10.7,8.8,17.9,18.2,22.5,25.3c-8.8-3.3-17.7-6.5-26.5-9.8L561.4,432.9z"></path>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M225.3,474.6c-0.1,0-0.2,0-0.4,0c-5.7,1.3-12.5,3.3-20,6.6
                                        c-6.8,3-12.5,6.4-17.2,9.6c-0.9,0.6-0.4,2,0.7,1.9c4.6-0.5,9.4-1.1,14.3-1.9c16.4-2.7,30.8-7,43-11.7c1-0.4,0.8-1.9-0.2-2
                                        C238.8,476.2,232.1,475.4,225.3,474.6z"></path>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M204.9,529.5c0-2.1-0.7-3.8-1.6-3.8c-0.9,0-1.6,1.7-1.6,3.8
                                        s0.7,3.9,1.6,3.9C204.1,533.4,204.9,531.6,204.9,529.5z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.4,432.9
                                        c5.8,3,12.7,7.1,19.7,12.9c10.7,8.8,17.9,18.2,22.5,25.3c-8.8-3.3-17.7-6.5-26.5-9.8L561.4,432.9z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M225.3,474.6c-0.1,0-0.2,0-0.4,0
                                        c-5.7,1.3-12.5,3.3-20,6.6c-6.8,3-12.5,6.4-17.2,9.6c-0.9,0.6-0.4,2,0.7,1.9c4.6-0.5,9.4-1.1,14.3-1.9c16.4-2.7,30.8-7,43-11.7
                                        c1-0.4,0.8-1.9-0.2-2C238.8,476.2,232.1,475.4,225.3,474.6z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M204.9,529.5c0-2.1-0.7-3.8-1.6-3.8
                                        c-0.9,0-1.6,1.7-1.6,3.8s0.7,3.9,1.6,3.9C204.1,533.4,204.9,531.6,204.9,529.5z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.4,432.9
                                        c5.8,3,12.7,7.1,19.7,12.9c10.7,8.8,17.9,18.2,22.5,25.3c-8.8-3.3-17.7-6.5-26.5-9.8L561.4,432.9z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M245.7,479.1c-3.8,1.5-7.8,2.9-12,4.2
                                        c-9.3,3-19.7,5.6-31,7.5c-4.9,0.8-9.7,1.4-14.3,1.9c-1.1,0.1-1.6-1.3-0.7-1.9c1.3-0.9,2.7-1.8,4.1-2.7
                                        c3.8-2.4,8.1-4.7,13.1-6.9c6.7-2.9,12.8-4.9,18.1-6.2c0.6-0.2,1.3-0.3,1.9-0.5h0.4c6.8,0.8,13.5,1.6,20.2,2.5
                                        C246.5,477.2,246.7,478.7,245.7,479.1z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M204.9,529.5c0-2.1-0.7-3.8-1.6-3.8
                                        c-0.9,0-1.6,1.7-1.6,3.8s0.7,3.9,1.6,3.9C204.1,533.4,204.9,531.6,204.9,529.5z"></path>
                                </g>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M301.3,463.7c0,0-0.1,0-0.1,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M225.3,474.6c-0.8,0.2-1.6,0.3-2.3,0.4"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M621.9,494.6
                                C621.9,494.6,621.8,494.6,621.9,494.6"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M590.5,482.9
                                c12.5,11.3,27.4,11.7,31.3,11.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M537.1,463.2c-0.1,0-0.1,0-0.2,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M577.6,461.4c-0.2,0-0.3,0-0.5,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M315.1,481.5c-11.5,1.4-22.7,2.8-33.3,4.3"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M325.4,461.2l6.1,4.1
                                    c-2.5,2-5,4-7.5,6.1c-0.2,0-1.9,0.4-3.3-0.9c-1.1-1.1-1.2-2.5-1.2-2.7L325.4,461.2"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M340.8,452.5c-1.6-0.2-3.6-0.2-5.2-0.2
                                    c-4.5,0.1-9.3,0.2-11.1,3c-1.4,2.2-0.4,5,0.9,6.6c2.6,3.3,8.4,4.3,12.4,2.9C338.6,460.7,339.6,456.5,340.8,452.5z"></path>
                            </g>
                        </g>
                        <g id="right">
                            <g>
                                <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M503.1,132.8c0.1-1.1,5.5-1.6,12.2-1.2
                                    c6.7,0.5,12,1.8,11.9,2.9c-0.1,1.1-5.5,1.6-12.2,1.2C508.4,135.2,503,133.9,503.1,132.8z"></path>
                                <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M406.4,123.1c-6.7-0.5-12.1,0.1-12.2,1.2
                                    c-0.1,1.1,5.3,2.4,11.9,2.9c6.7,0.5,12.1-0.1,12.2-1.2C418.4,124.9,413.1,123.6,406.4,123.1z M406.4,123.1
                                    c-6.7-0.5-12.1,0.1-12.2,1.2c-0.1,1.1,5.3,2.4,11.9,2.9c6.7,0.5,12.1-0.1,12.2-1.2C418.4,124.9,413.1,123.6,406.4,123.1z
                                    M537.2,148.3c-0.2,0.6-1.2,2.4-2.4,4.8c-33.5-2.9-67-5.8-100.5-8.8c-39.1-3.4-78.1-6.8-117.2-10.3c-0.8-4.3-1.4-8.8-1.8-13.5
                                    c-0.1-0.7-0.1-1.4-0.2-2.1c-1.6-20.9,0.8-39.5,4.4-54.6c36.1,0.7,72.1,1.3,108.1,2c0.1,0,0.2,0,0.2,0c1.7,0,3.4,0.1,5.2,0.1
                                    c18,0.4,39.6,0.7,56.7,1.1c33.4,38.2,44.5,58.8,47.5,70C538.9,143.1,538.1,146.4,537.2,148.3z M406.4,123.1
                                    c-6.7-0.5-12.1,0.1-12.2,1.2c-0.1,1.1,5.3,2.4,11.9,2.9c6.7,0.5,12.1-0.1,12.2-1.2C418.4,124.9,413.1,123.6,406.4,123.1z
                                    M190.4,72.7l12.1,2.8c2,0.5,3.9-0.7,4.6-2.7l0.9-3c0.7-2.4-0.9-4.8-3.4-5.1L192,63.6c-1.8-0.2-3.4,0.9-4,2.6
                                    c-0.1,0.4-0.3,0.8-0.4,1.2c-0.1,0.4-0.2,0.9-0.2,1.3C187.4,70.6,188.6,72.3,190.4,72.7z M406.4,123.1
                                    c-6.7-0.5-12.1,0.1-12.2,1.2c-0.1,1.1,5.3,2.4,11.9,2.9c6.7,0.5,12.1-0.1,12.2-1.2C418.4,124.9,413.1,123.6,406.4,123.1z
                                    M406.4,123.1c-6.7-0.5-12.1,0.1-12.2,1.2c-0.1,1.1,5.3,2.4,11.9,2.9c6.7,0.5,12.1-0.1,12.2-1.2
                                    C418.4,124.9,413.1,123.6,406.4,123.1z M590.1,117.4L590.1,117.4c-8.5,7.9-11.8,16.9-13,21.2c-12.8-0.4-26.7-1-39.9-1.6
                                    c-3-11.2-14.1-31.8-47.5-70c-17.1-0.4-38.7-0.7-56.7-1.1c-1.8,0-3.5-0.1-5.2-0.1c-0.1,0-0.2,0-0.2,0c-36-0.7-72-1.3-108.1-2
                                    c-3.6,15.1-6,33.7-4.4,54.7h0c0.1,0.7,0.1,1.3,0.2,2c0.4,4.7,1,9.2,1.8,13.5c-4-0.3-7.9-0.7-11.9-1c-2.3-0.2-3.8,1.5-4,3.4
                                    c-15.2-2.8-27.7-4.4-36.1-5.3c-4.2-0.4-8.3-0.8-14.8-1.6c-9.6-1.2-18.8-3-24.8-4.1c6.7-0.8,13.4-1.6,20-2.5c1-0.1,1.2-1.6,0.2-2
                                    c-3.8-1.5-7.8-2.9-12-4.2c-9.3-3-19.7-5.6-31-7.5c-4.9-0.8-9.7-1.5-14.3-1.9c-1.1-0.1-1.6,1.3-0.7,1.9c1.3,0.9,2.7,1.8,4.1,2.7
                                    l-5.4,3.2c9.3,5.4,20.6,10.9,33.7,15.8c17.2,6.3,32.7,9.5,45.1,11.1c2,0,4.3,0.1,7,0.3s5.6,0.5,8.9,1c3.5,0.5,7.3,1.3,11.3,2.3
                                    c19.8,5.1,28.8,13.4,51.4,23.9c7.9,3.6,19.7,8.6,35,13.1c-0.9,1.3-1.8,2.6-2.7,3.9c24.8,5.3,65.1,11.8,111.2,9.9
                                    c8.5-0.4,40.5-2,81-10.8c6.1-1.3,11.2-2.5,14.8-3.4c-1.2-2.1-6.9-11.6-8.5-14.2c9.5-5.5,16.1-10.9,20.3-14.8
                                    c3.6-3.4,5.7-5.9,7.6-8.7c0.2-0.3,0.4-0.6,0.6-0.9c0.8-1.3,1.6-2.8,2.4-4.4c1.1-2.4,1.9-4.8,2.5-6.8c0.2-4,1.2-13.7,8.4-21.8
                                    c1.3-1.4,2.6-2.6,3.9-3.6c0.6-0.5,1.1-1.1,1.6-1.7C618.1,105.3,602.8,105.7,590.1,117.4z"></path>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M433.7,185.6c-5.9-0.6-12-1.4-18.1-2.4
                                c-50.9-8.3-89.2-28.3-112.7-43.5c-1.3-0.8-1.8-2.1-1.7-3.3c0.1-1.9,1.7-3.6,4-3.4c4,0.3,7.9,0.7,11.9,1c0,0,0.1,0,0.1,0
                                c36.1,3.2,72.1,6.3,108.2,9.5v0l0.6,3.4h0.2l7.1,35.1c-0.3,0.1-0.4,0.1-0.4,0.1L433.7,185.6z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M548.2,174.5c-7.5,2.3-17,4.8-27.9,6.9
                                c-19.3,3.8-43.6,6.6-71.2,5.3l-0.1-3.4h-0.1l-3.5-34.6h0.2l-0.5-3.4c30,2.6,59.9,5.2,89.9,7.8c0.4,0,0.7,0.1,1.1,0.1
                                c0.8,0.1,1.4,0.3,2,0.8c2.4,1.9,5.2,4.6,7.9,8.1c2,2.5,3.5,5,4.6,7.2C551.4,171.4,550.4,173.8,548.2,174.5z"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M594.9,153.3c3.6-3.3,5.8-5.8,7.6-8.7
                                    c0.2-0.3,0.4-0.6,0.6-0.9c-2.8,6.3-6.9,13.8-13,21.3c-3.6,4.4-7.3,8.1-10.8,11.1c-1.6-2.6-3.2-5.3-4.8-8
                                    C584.1,162.6,590.7,157.1,594.9,153.3z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M343.7,169.6c7.9,3.6,19.7,8.6,35,13.1
                                    c-0.9,1.3-1.8,2.6-2.7,3.9c-15.2-5.6-31.2-12.2-47.8-19.7c-17-7.7-32.7-15.7-47.2-23.5c3.5,0.5,7.3,1.3,11.3,2.3
                                    C312.1,150.8,321.1,159.1,343.7,169.6z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M433.1,182.1c-0.1,0-0.2,0-0.2,0
                                    c-5.6-0.6-11.2-1.3-16.8-2.3c-39.3-6.4-77.8-21.3-111.4-43c-0.1-0.1-0.2-0.1-0.1-0.3s0.2-0.2,0.2-0.2h0.1L425.8,147h0.2
                                    L433.1,182.1z"></path>
                                <g>
                                    <g>
                                        <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M547.4,171.1c0,0.1-0.1,0.1-0.2,0.2
                                            c-6.9,2.1-13.9,3.9-20.9,5.5l10.4-19.3c2.4,2,4.5,4.3,6.5,6.8c1.6,2.1,3,4.4,4.2,6.7C547.4,170.9,547.5,171,547.4,171.1z"></path>
                                        <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M517.7,178.5c-18,3.4-36.4,5.2-54.8,5.2
                                            c-4.7,0-9.4-0.1-14.1-0.4l-3.5-34.6l82,7.2L517.7,178.5z"></path>
                                    </g>
                                    <g>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M547.4,171.1c0,0.1-0.1,0.1-0.2,0.2
                                            c-6.9,2.1-13.9,3.9-20.9,5.5l10.4-19.3c2.4,2,4.5,4.3,6.5,6.8c1.6,2.1,3,4.4,4.2,6.7C547.4,170.9,547.5,171,547.4,171.1z"></path>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M517.7,178.5
                                            c-18,3.4-36.4,5.2-54.8,5.2c-4.7,0-9.4-0.1-14.1-0.4l-3.5-34.6l82,7.2L517.7,178.5z"></path>
                                    </g>
                                    <g>
                                        <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M547.4,171.1c0,0.1-0.1,0.1-0.2,0.2
                                            c-6.9,2.1-13.9,3.9-20.9,5.5l10.4-19.3c2.4,2,4.5,4.3,6.5,6.8c1.6,2.1,3,4.4,4.2,6.7C547.4,170.9,547.5,171,547.4,171.1z"></path>
                                        <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M527.3,155.9l-9.6,22.6
                                            c-18,3.4-36.4,5.2-54.8,5.2c-4.7,0-9.3-0.1-14-0.4h-0.1l-3.5-34.6h0.2L527.3,155.9z"></path>
                                    </g>
                                </g>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M418.3,126c-0.1,1.1-5.5,1.7-12.2,1.2
                                c-6.6-0.5-12-1.8-11.9-2.9s5.5-1.7,12.2-1.2S418.4,124.9,418.3,126z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M527.2,134.5c-0.1,1.1-5.5,1.6-12.2,1.2
                                c-6.6-0.5-12-1.8-11.9-2.9c0.1-1.1,5.5-1.6,12.2-1.2C522,132.1,527.3,133.4,527.2,134.5z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M441.8,186.3L441.8,186.3"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M317.1,134.1L317.1,134.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M427.8,65.8c1.7,0,3.4,0.1,5.2,0.1l0,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M519.9,182.1c0.1-0.2,0.2-0.5,0.4-0.7
                                c2.4-4.5,5.8-11.1,10-19.3c1.5-3,3.2-6.3,4.5-9"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M183.7,85c1.3,1.4,1.8,3.3,1.5,5.1
                                    c-0.7,3.5-2.1,8.1-5.3,12.5c-1.3,1.8-2.6,3.2-3.9,4.4c-0.8-5.2-1.2-11.5-0.9-18.5c0.2-3.1,0.5-6.1,0.9-8.9
                                    c1.4,0.6,3.4,1.6,5.4,3.2C182.3,83.6,183.1,84.3,183.7,85z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M208,69.8l-0.9,3
                                    c-0.7,2-2.6,3.2-4.6,2.7l-12.1-2.8c-1.8-0.4-3-2.1-3-4c0-0.4,0.1-0.9,0.2-1.3c0.1-0.4,0.3-0.8,0.4-1.2c0.6-1.7,2.2-2.8,4-2.6
                                    l12.6,1.1C207.1,65,208.7,67.4,208,69.8z"></path>
                            </g>
                            <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="251.4" y1="99.5" x2="251.1" y2="99.8"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="233.7" y1="116.7" x2="233.5" y2="116.9"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="186.4" y1="115.1" x2="186.1" y2="115.3"></line>
                            <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="192" y1="111.8" x2="191.8" y2="111.9"></line>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M565.1,98.6L565.1,98.6L565.1,98.6
                                C565.1,98.6,565.1,98.6,565.1,98.6z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M565.1,98.6l24.6,18.4
                                C585.8,114.2,565.3,99.1,565.1,98.6z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M549.8,189.4c0.8-2.8,1.9-5.9,3.4-9.3
                                c2.5-5.5,5.6-9.8,8.2-13"></path>
                            <g>
                                <g>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M561.4,167.1c5.8-3,12.7-7.1,19.7-12.9
                                        c10.7-8.8,17.9-18.2,22.5-25.3c-8.8,3.3-17.7,6.5-26.5,9.8L561.4,167.1z"></path>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M225.3,125.4c-0.1,0-0.2,0-0.4,0c-5.7-1.3-12.5-3.3-20-6.6
                                        c-6.8-3-12.5-6.4-17.2-9.6c-0.9-0.6-0.4-2,0.7-1.9c4.6,0.4,9.4,1.1,14.3,1.9c16.4,2.7,30.8,7,43,11.7c1,0.4,0.8,1.9-0.2,2
                                        C238.8,123.8,232.1,124.6,225.3,125.4z"></path>
                                    <path fill="#A5A4A4" stroke="#000000" stroke-miterlimit="10" d="M204.9,70.5c0,2.1-0.7,3.8-1.6,3.8c-0.9,0-1.6-1.7-1.6-3.8
                                        c0-2.1,0.7-3.9,1.6-3.9C204.1,66.6,204.9,68.4,204.9,70.5z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.4,167.1
                                        c5.8-3,12.7-7.1,19.7-12.9c10.7-8.8,17.9-18.2,22.5-25.3c-8.8,3.3-17.7,6.5-26.5,9.8L561.4,167.1z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M225.3,125.4c-0.1,0-0.2,0-0.4,0
                                        c-5.7-1.3-12.5-3.3-20-6.6c-6.8-3-12.5-6.4-17.2-9.6c-0.9-0.6-0.4-2,0.7-1.9c4.6,0.4,9.4,1.1,14.3,1.9c16.4,2.7,30.8,7,43,11.7
                                        c1,0.4,0.8,1.9-0.2,2C238.8,123.8,232.1,124.6,225.3,125.4z"></path>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M204.9,70.5c0,2.1-0.7,3.8-1.6,3.8
                                        c-0.9,0-1.6-1.7-1.6-3.8c0-2.1,0.7-3.9,1.6-3.9C204.1,66.6,204.9,68.4,204.9,70.5z"></path>
                                </g>
                                <g>
                                    <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M561.4,167.1
                                        c5.8-3,12.7-7.1,19.7-12.9c10.7-8.8,17.9-18.2,22.5-25.3c-8.8,3.3-17.7,6.5-26.5,9.8L561.4,167.1z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M245.5,122.9c-6.6,0.9-13.3,1.7-20,2.5
                                        c-0.1,0-0.1,0-0.2,0h-0.4c-5.7-1.3-12.5-3.3-20-6.6c-4.9-2.2-9.3-4.5-13.1-6.9c-1.5-0.9-2.8-1.8-4.1-2.7
                                        c-0.9-0.6-0.4-2,0.7-1.9c4.6,0.4,9.4,1.1,14.3,1.9c11.3,1.9,21.7,4.5,31,7.5c4.2,1.3,8.2,2.8,12,4.2
                                        C246.7,121.3,246.5,122.8,245.5,122.9z"></path>
                                    <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M204.9,70.5c0,2.1-0.7,3.8-1.6,3.8
                                        c-0.9,0-1.6-1.7-1.6-3.8c0-2.1,0.7-3.9,1.6-3.9C204.1,66.6,204.9,68.4,204.9,70.5z"></path>
                                </g>
                            </g>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M301.4,136.4c0,0-0.1,0-0.1,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M225.5,125.4c-0.6-0.1-1.1-0.2-1.7-0.3"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="621.9" y1="105.3" x2="621.9" y2="105.3"></line>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M536.5,137c0.2,0,0.4,0,0.7,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M577.3,138.6c-0.1,0-0.2,0-0.2,0"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M315.1,118.5c-11.5-1.4-22.7-2.8-33.3-4.3"></path>
                            <g>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-miterlimit="10" d="M325.4,138.8l6.1-4.1
                                    c-2.5-2-5-4-7.5-6.1c-0.2,0-1.9-0.4-3.3,0.9c-1.1,1.1-1.2,2.5-1.2,2.7L325.4,138.8"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M340.8,147.6c-1.6,0.2-3.6,0.2-5.2,0.2
                                    c-4.5-0.1-9.3-0.2-11.1-3.1c-1.4-2.2-0.4-4.9,0.9-6.6c2.6-3.3,8.4-4.3,12.4-2.9C338.6,139.3,339.6,143.4,340.8,147.6z"></path>
                            </g>
                        </g>
                        <g id="front">
                            
                                <rect x="153.3" y="220.7" fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" width="11" height="158.6"></rect>
                            
                                <rect x="154.5" y="246.7" fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" width="12.7" height="106.6"></rect>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M160.3,368.6h15.2c3.4,0,6.1,2.7,6.1,6.1
                                v12.6c0,3.4-2.7,6.1-6.1,6.1h-57L160.3,368.6z"></path>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M118.4,206.6h57c3.4,0,6.1,2.7,6.1,6.1
                                v12.6c0,3.4-2.7,6.1-6.1,6.1h-15.2L118.4,206.6z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M111.2,394.4c-7.4-0.1-17-1-27.7-4.2
                                c-5.9-1.8-11-3.9-15.3-6c-8.3-3-17.1-6.6-26.3-10.9c-3.7-1.8-7.3-3.6-10.8-5.4c-5.4-2.8-9-8.1-9.8-14.1c-0.6-4.9-1.1-10-1.6-15.3
                                c-1.2-13.8-1.2-26.7-1.2-38.5s0-24.7,1.2-38.5c0.4-5.2,1-10.4,1.6-15.3c0.7-6,4.4-11.3,9.8-14.1c3.5-1.8,7.1-3.6,10.8-5.4
                                c9.2-4.3,18.1-7.9,26.3-10.9c4.3-2.1,9.4-4.2,15.3-6c10.6-3.2,20.1-4.1,27.4-4.2c-2.4,1.5-5.9,4.1-9.1,8.3
                                c-2.5,3.2-3.9,6.6-4.7,8.9c0.8,0.6,1.6,1.2,2.5,2c9.9,9.1,9.8,22.9,9.7,25.1v0.3l-0.6,4.1c-0.3,1.8-2.5,2.4-3.6,0.8l-2.2-3.1
                                c-0.5,3.5-1,7-1.4,10.5c-1.5,13.3-1.6,25.9-1.6,37.5s0.1,24.2,1.6,37.5c0.4,3.7,0.9,7.1,1.4,10.5l2.2-3.1c1.1-1.6,3.3-1,3.6,0.8
                                l0.6,4.1v0.3c0.1,2.2,0.2,16-9.7,25.1c-0.8,0.7-1.5,1.3-2.3,1.9c0.8,2.3,2.2,5.9,4.5,9C105.1,390.4,108.8,392.9,111.2,394.4z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M129.8,300c0.3,11.7-0.6,25.6-4,40.6
                                c-0.4,2.1-0.9,4.1-1.4,6c-0.7,2.5-3.3,3.5-5.2,2c-1.4-1.2-2.9-2.7-4.5-4.4l-0.1-0.1c-4.5-5.1-7.1-12.2-7.3-19.5V323
                                c-0.2-8,0-15.6,0-23s-0.2-15.1,0-23v-1.6c0.1-7.3,2.7-14.3,7.3-19.5l0.1-0.1c1.5-1.8,3.1-3.2,4.5-4.4c1.9-1.5,4.5-0.5,5.2,2
                                c0.5,1.9,0.9,3.9,1.4,5.9C129.2,274.4,130,288.3,129.8,300z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M137.2,226.4c-0.4-2.1,0.8-4.2,2.8-4.9
                                l4-1.4c2.9-1.1,5.9,1.1,5.8,4.2l-0.7,18.1c-0.1,1.5-0.9,2.8-2.2,3.6l-0.2,0.1c-2.6,1.5-5.9,0-6.3-2.9L137.2,226.4z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M149.1,357.6l0.7,18.1
                                c0.1,3.1-2.9,5.3-5.8,4.2l-4-1.4c-2-0.7-3.2-2.8-2.8-4.9l3.2-16.8c0.4-2.9,3.7-4.4,6.3-2.9l0.2,0.1
                                C148.2,354.8,149,356.1,149.1,357.6z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M150.7,300c0,12.9-0.3,25.7-0.9,38.6
                                c-0.1,1.4-1.7,2.2-2.8,1.5c-0.9-0.6-1.8-1.2-2.7-1.7c-0.5-0.3-0.8-0.9-0.8-1.5c0.5-12.3,0.8-24.6,0.8-36.9s-0.3-24.6-0.8-36.9
                                c0-0.6,0.3-1.2,0.8-1.5c0.9-0.6,1.8-1.2,2.7-1.7c1.2-0.7,2.7,0.1,2.8,1.5C150.4,274.3,150.7,287.1,150.7,300z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M99.6,375.2c-0.8,0.7-1.5,1.3-2.3,1.9
                                c-2.6,1.8-5.1,2.9-7.2,3.6c-1.5,0.5-2.9-1-2.4-2.7c1.3-4.7,3.8-12.6,4.4-14.4c0.1-0.2,0.2-0.5,0.3-0.7l10.3-14.5l0.2-0.3l2.2-3.1
                                c1.1-1.6,3.3-1,3.6,0.8l0.6,4.1v0.3C109.4,352.3,109.5,366.1,99.6,375.2z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M149.8,375.7c0.1,3.1-2.9,5.3-5.8,4.2
                                l-4-1.4c-2-0.7-3.2-2.8-2.8-4.9l3.2-16.8c0.4-2.9,3.7-4.4,6.3-2.9l0.2,0.1c1.3,0.8,2.1,2.1,2.2,3.6L149.8,375.7z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M143.4,368.6c-2.2,0-3.9,1.8-3.9,4
                                s1.8,4,3.9,4s3.9-1.8,3.9-4S145.6,368.6,143.4,368.6z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M74.3,387.4c-3.9,0-7.1,4.9-7.1,11
                                s3.2,11,7.1,11s7.1-4.9,7.1-11S78.2,387.4,74.3,387.4z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M97.3,377.1c-0.1-0.2-0.1-0.3-0.2-0.5"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M87.6,380.2c-1.9,1.1-4.5,2.4-7.7,3.3
                                c-4.9,1.3-9.1,1.1-11.7,0.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M79.9,383.5c-7.1-1.7-14.5-3.7-22.3-6.2
                                c-10.4-3.3-19.9-6.9-28.5-10.5"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M72.6,300c0,18.4-0.5,37.8-2.2,58.1
                                c-0.5,5.3-1,10.5-1.6,15.6c0,0.1,0,0.2,0,0.3c-0.2,0-0.4-0.1-0.6-0.1c-5.9-1.1-12.4-2.8-19.3-4.9c-5.8-1.8-11.1-3.8-15.9-5.8
                                c-0.7-7.8-1.3-15.8-1.8-24.1c-0.8-13.6-1.1-26.6-1-39.1c0-12.4,0.2-25.5,1-39.1c0.5-8.3,1.1-16.3,1.8-24.1c4.8-2,10.1-4,15.9-5.8
                                c6.9-2.2,13.5-3.8,19.5-5c0.1,0,0.3-0.1,0.4-0.1c0,0.1,0,0.1,0,0.2c0.6,5.1,1.1,10.4,1.6,15.7C72.2,262.2,72.6,281.6,72.6,300z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M109.3,249.9v0.3l-0.6,4.1
                                c-0.3,1.8-2.5,2.4-3.6,0.8l-2.2-3.1l-0.2-0.3l-10.3-14.5c-0.1-0.2-0.2-0.5-0.3-0.7c-0.6-1.8-3.1-9.7-4.4-14.4
                                c-0.5-1.7,0.9-3.2,2.4-2.7c2,0.7,4.5,1.8,7,3.5c0.8,0.6,1.6,1.2,2.5,2C109.5,233.9,109.4,247.7,109.3,249.9z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M125.8,340.6c-0.4,2.1-0.9,4.1-1.4,6
                                c-0.7,2.5-3.3,3.5-5.2,2c-1.4-1.2-2.9-2.7-4.5-4.4l-0.1-0.1c-4.5-5.1-7.1-12.2-7.3-19.5V323c-0.2-8,0-15.6,0-23s-0.2-15.1,0-23
                                v-1.6c0.1-7.3,2.7-14.3,7.3-19.5l0.1-0.1c1.5-1.8,3.1-3.2,4.5-4.4c1.9-1.5,4.5-0.5,5.2,2c0.5,1.9,0.9,3.9,1.4,5.9
                                c3.4,15.1,4.2,29,4,40.7C130.1,311.7,129.2,325.6,125.8,340.6z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M149.8,224.3l-0.7,18.1
                                c-0.1,1.5-0.9,2.8-2.2,3.6l-0.2,0.1c-2.6,1.5-5.9,0-6.3-2.9l-3.2-16.8c-0.4-2.1,0.8-4.2,2.8-4.9l4-1.4
                                C146.9,219,149.9,221.2,149.8,224.3z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M143.4,231.4c-2.2,0-3.9-1.8-3.9-4
                                s1.8-4,3.9-4s3.9,1.8,3.9,4S145.6,231.4,143.4,231.4z"></path>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M150.7,300c0-12.9-0.3-25.7-0.9-38.6
                                c-0.1-1.4-1.6-2.2-2.8-1.5c-0.9,0.5-1.8,1.1-2.7,1.7c-0.5,0.3-0.8,0.9-0.8,1.5c0.5,12.3,0.8,24.6,0.8,36.9s-0.3,24.6-0.8,36.9
                                c0,0.6,0.3,1.2,0.8,1.5c0.9,0.5,1.8,1.1,2.7,1.7c1.1,0.7,2.7-0.1,2.8-1.5C150.4,325.7,150.7,312.9,150.7,300z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M150.7,300c0,12.9-0.3,25.7-0.9,38.6
                                c-0.1,1.4-1.7,2.2-2.8,1.5c-0.9-0.6-1.8-1.2-2.7-1.7c-0.5-0.3-0.8-0.9-0.8-1.5c0.5-12.3,0.8-24.6,0.8-36.9s-0.3-24.6-0.8-36.9
                                c0-0.6,0.3-1.2,0.8-1.5c0.9-0.6,1.8-1.2,2.7-1.7c1.2-0.7,2.7,0.1,2.8,1.5C150.4,274.3,150.7,287.1,150.7,300z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M80,203c0.3,0.1,7.3,5.8,7.3,5.8
                                l-4.6,5.1l-4.1-3.7L80,203z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M74.3,212.6c-3.9,0-7.1-4.9-7.1-11
                                s3.2-11,7.1-11s7.1,4.9,7.1,11C81.4,207.6,78.2,212.6,74.3,212.6z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M111.1,205.5c-0.1,0-0.1,0.1-0.2,0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M97.1,222.8v0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M87.6,219.8c-1.9-1.1-4.5-2.4-7.7-3.3
                                c-4.9-1.3-9.1-1.1-11.7-0.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M79.9,216.5c-7.1,1.7-14.5,3.7-22.3,6.2
                                c-10.4,3.3-19.9,6.9-28.5,10.5"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M102.9,348
                                C102.9,348.1,102.9,348.1,102.9,348c0,0.1,0,0.1,0,0.2C102.9,348.2,102.9,348.2,102.9,348C102.9,348.1,102.9,348,102.9,348
                                c0-0.2,0.1-0.5,0-0.5c0,0-0.1,0-0.1,0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M68.8,373.7c-0.2,0.1-0.4,0.1-0.6,0.2
                                c-0.1,0-0.2,0.1-0.3,0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M68.2,225.9c0.1,0,0.1,0.1,0.2,0.1
                                s0.3,0.1,0.4,0.1"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M102.8,252.2
                                C102.9,252.2,102.9,252.2,102.8,252.2c0.1,0.1,0.1-0.1,0.1-0.2v-0.1c0-0.1,0-0.1,0-0.1v0.1c0,0,0,0,0,0.1"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M80.3,397c0.3-0.1,7.3-5.8,7.3-5.8
                                l-4.6-5.1l-4.1,3.7L80.3,397z"></path>
                        </g>
                        <g id="back">
                            
                                <rect x="639.8" y="224.4" fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" width="10.9" height="156.8"></rect>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M644.3,231.1l-19.2-0.1c-3.3,0-6-2.7-6-6
                                v-12.5c0-3.3,2.7-6,6-6h62.8L644.3,231.1z"></path>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M644.3,369l-19.2,0.1c-3.3,0-6,2.7-6,6
                                v12.5c0,3.3,2.7,6,6,6h62.8L644.3,369z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M658.2,255.6v88.8
                                c0,7.8-3.3,15.2-9.1,20.3l-4.7,4.2V231.3l4.7,4C654.9,240.5,658.2,247.8,658.2,255.6z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M670.1,364.6c0.5,1.9,1.5,6.7-0.4,12.1
                                c-1.2,3.3-3.1,5.5-4.3,6.8v-10.6c0-1,0.3-1.9,0.8-2.7L670.1,364.6z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" d="M669.7,223.3c1.9,5.4,0.9,10.2,0.4,12.1
                                l-3.9-5.6c-0.5-0.8-0.8-1.7-0.8-2.7v-10.6C666.6,217.8,668.5,220,669.7,223.3z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M780.8,299.9c-0.1,14.2-1,29.5-3.2,45.8
                                c-0.2,2-0.5,4-0.8,5.9c-1,6.5-4.8,12.2-10.5,15.6c-4.1,2.5-8.5,4.9-13.3,7.3c-7.8,3.9-15.2,7.1-22,9.6c-4.2,1.9-9.4,3.9-15.5,5.5
                                c-4.1,1.1-7.9,1.9-11.4,2.3c-1.4,0.2-2.8,0.3-4.1,0.5c-2.4,0.6-6.1,1.3-10.6,1.2c-2,0-3.7-0.2-6.4-0.7c2.4-0.7,5.5-1.8,8.7-3.4
                                c-7.1-2.8-11.2-10.3-9.9-17.7V228.3c-1.3-7.4,2.8-14.8,9.9-17.7c-3.4-1.7-6.8-2.8-9.3-3.6c3-0.6,4.8-0.8,7-0.8
                                c4.5-0.1,8.2,0.6,10.6,1.2c0.7,0.1,1.4,0.2,2.2,0.3c4,0.5,8.4,1.3,13.3,2.5c6,1.6,11.2,3.6,15.5,5.5c6.6,3.8,11.7,7.1,15.2,9.4
                                c4.3,2.9,6.9,4.9,11.2,6.5c4.4,1.7,8.4,2.2,11,2.4c4.5,3.4,7.6,8.5,8.4,14.2c0.3,2,0.5,3.9,0.8,5.9
                                C779.8,270.4,780.7,285.8,780.8,299.9z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M776.3,245.4c-1.4,0.5-2.9,0.9-4.7,1.3
                                c-2.8,0.6-5.3,0.8-7.4,0.8"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M691.7,210.6c3.8,1.9,7.7,4.4,10.9,7.8
                                c3.2,3.4,5.2,6.8,6.5,9.5"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M682.4,207.1c-1.4-0.4-2.5-0.7-3.4-0.9"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M703.9,207.5c-0.5,0-1.1,0.1-1.7,0.2
                                c-2.6,0.4-5.7,1.4-9.1,2.4c-0.1,0.1-0.2,0.1-0.2,0.1c-0.4,0.1-0.8,0.3-1.2,0.4"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M681.8,228.3c0.1,0.7,0.3,1.5,0.6,2.2
                                c0.6,1.7,1.2,3.1,1.8,4.3c0.9,1.9,2,3.7,3.3,6.9c1.9,5,2.6,9.4,2.8,12.4"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M768.5,300.1c0,10.1-0.2,20.5-0.6,31.3
                                c-0.1,2.1-0.2,4.3-0.3,6.5c-0.6,12.7-6.9,24.5-17.1,32.1l-2.9,1.9l-0.8,0.5l0,0c0.1-0.2,0.3-0.3,0.5-0.5c1.2-1.2,3.1-2.9,4-4.6
                                c0.4-0.7,0.9-2.2,1.4-3.6c0.3-1,0.6-2,0.8-2.5l-0.7-123.8c-0.1-0.3-0.2-0.7-0.4-1.1c-0.3-1.1-0.7-2.6-1.2-3.5
                                c-1-1.7-2.8-3.5-4-4.8c-0.2-0.2-0.3-0.4-0.5-0.5l0,0l0.7,0.5l3,2.1c10.2,7.6,16.5,19.4,17.1,32.1c0.1,2.1,0.2,4.3,0.3,6.5
                                C768.3,279.6,768.5,290,768.5,300.1z"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M776.3,354.6c-1.4-0.5-2.9-0.9-4.7-1.3
                                c-2.8-0.6-5.3-0.8-7.4-0.8"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M713.5,238.4c-0.3,0.2-0.6,0.4-0.9,0.6"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M721.3,376.5l-14.8-5.4
                                c-7.1-2.6-12.6-8.3-14.9-15.4l0,0c-0.9-2.8-1.4-5.8-1.4-8.8V300v-46.9c0-3,0.5-5.9,1.4-8.8l0,0c2.3-7.2,7.8-12.9,14.9-15.4
                                l14.8-5.4"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M691.7,389.5c3.7-1.9,7.6-4.4,10.9-7.9
                                c3.2-3.4,5.2-6.8,6.5-9.5"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M683,392.9c-1.1,0.3-2.1,0.6-2.8,0.7"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M704.9,392c-0.3,0-0.5,0-0.8-0.1
                                c-3-0.2-7.1-0.9-11-2c-0.1,0-0.2,0-0.2,0c-0.4-0.1-0.8-0.3-1.2-0.4"></path>
                            <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M681.8,371.8c0.1-0.7,0.3-1.5,0.6-2.2
                                c0.6-1.7,1.2-3.1,1.8-4.3c0.9-1.9,2-3.7,3.3-6.9c1.9-5,2.6-9.4,2.8-12.4"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M716,258.9V341l-8.5-5.5
                                c-3.5-2.3-5.7-6.2-5.7-10.4v-50.3c0-4.2,2.1-8.1,5.7-10.4L716,258.9z"></path>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="644.4" y1="231.3" x2="643.7" y2="230.8"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="644.4" y1="368.9" x2="643.7" y2="369.5"></line>
                            <polygon fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" points="764.7,300 764.7,316.8 
                                768.1,316.8 768.1,300 768.1,283.2 764.7,283.2 			"></polygon>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M747.8,228.1c-0.1,0-0.2,0-0.3,0h-0.2
                                c-4.2,0.1-9.7,0.7-16,2.5c-8.4,2.4-14.7,6.2-18.7,9.1c0-0.2,0.1-0.5,0.1-0.7c0.4-2.6,1.5-6.5,4.1-10.5c1.4-2.2,3-3.8,4.4-5
                                c3.1-0.4,7.1-0.6,11.8,0c5.9,0.8,10.5,2.5,13.8,4.1l0,0C747.2,227.8,747.5,227.9,747.8,228.1z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M747.8,371.9c-0.3,0.2-0.6,0.3-1,0.5
                                l0,0c-3.3,1.6-7.9,3.3-13.8,4.1c-4.7,0.6-8.7,0.4-11.8,0c-1.4-1.2-3-2.8-4.4-5c-2.7-4.1-3.7-8-4.1-10.6c0-0.2-0.1-0.4-0.1-0.6
                                c4,2.9,10.3,6.7,18.7,9.1c6.2,1.8,11.7,2.4,16,2.5h0.3C747.7,371.9,747.7,371.9,747.8,371.9z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M670.1,235.4l-3.9-5.6
                                c-0.5-0.8-0.8-1.7-0.8-2.7v-10.6c1.2,1.3,3.1,3.5,4.3,6.8C671.6,228.7,670.6,233.5,670.1,235.4z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M669.7,376.7c-1.2,3.3-3.1,5.5-4.3,6.8
                                v-10.6c0-1,0.3-1.9,0.8-2.7l3.9-5.6C670.6,366.5,671.6,371.3,669.7,376.7z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M761.8,268.5v63
                                c0,11.4-3.1,22.5-8.9,32.3c-0.1,0-0.1,0-0.2-0.1c-5.7-2.3-10.5-6.3-13.8-11.2c-3.4-5-5.3-10.9-5.3-17.2v-70.8
                                c0-12.4,7.4-23.5,18.9-28.2c0.1-0.1,0.3-0.1,0.4-0.2c2.9,4.9,5.1,10.1,6.6,15.6C761,257.2,761.8,262.8,761.8,268.5z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M757.5,231.8c4.4,1.7,8.4,2.2,11,2.4
                                c-0.7-0.5-1.3-0.9-2-1.4c-4.1-2.4-8.5-4.9-13.3-7.3c-7.8-3.9-15.2-7.1-22-9.6c6.6,3.8,11.7,7.1,15.2,9.4
                                C750.6,228.2,753.2,230.2,757.5,231.8z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M757.5,368.2c4.4-1.7,8.4-2.2,11-2.4
                                c-0.7,0.5-1.3,1-2,1.4c-4.1,2.4-8.5,4.9-13.3,7.3c-7.8,3.9-15.2,7.1-22,9.6c6.6-3.8,11.7-7.1,15.2-9.5
                                C750.6,371.8,753.2,369.8,757.5,368.2z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M718.3,202.9
                                c-0.4,0.1-11.7,5.8-11.7,5.8l7.4,5l6.5-3.7L718.3,202.9z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M725.3,212.3c3.9,0,7-4.9,7-10.9
                                s-3.1-10.9-7-10.9s-7,4.9-7,10.9S721.5,212.3,725.3,212.3z"></path>
                            
                                <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="725.3" cy="201.5" rx="4.5" ry="8.3"></ellipse>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M718.3,397.1
                                c-0.4-0.1-11.7-5.8-11.7-5.8l7.4-5l6.5,3.7L718.3,397.1z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M725.3,387.7c3.9,0,7,4.9,7,10.9
                                s-3.1,10.9-7,10.9s-7-4.9-7-10.9S721.5,387.7,725.3,387.7z"></path>
                            
                                <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="725.3" cy="398.5" rx="4.5" ry="8.3"></ellipse>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="681.8" y1="377.3" x2="681.8" y2="371.8"></line>
                            
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="681.8" y1="228.3" x2="681.8" y2="222.8"></line>
                            <path fill="#A5A4A4" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M653.5,349.6V332c0-2-1.7-3.7-3.7-3.7
                                h-8c-2,0-3.7,1.7-3.7,3.7v17.5c0,2,1.7,3.7,3.7,3.7h8C651.8,353.3,653.5,351.6,653.5,349.6z"></path>
                            <path fill="#636060" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M645.8,345c2.3,0,4.1-1.9,4.1-4.2
                                s-1.8-4.2-4.1-4.2s-4.1,1.9-4.1,4.2S643.5,345,645.8,345z"></path>
                        </g>
                    </g>
                    <g id="segmented">
                        <g id="Bonnet">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M292.9,370.5c-15.5-1.8-33.3-4.6-51.6-9
                                c-17-4-33-9.1-46.9-13.9c0,0,0-0.1-0.1-0.1c0,0,0-0.1,0-0.1c-1.6-3.9-3.1-8.4-4.3-13.2c-3.4-13.4-3.5-24.6-3.4-34.1
                                c-0.1-9.5-0.1-20.7,3.4-34.1c1.3-5.1,2.9-9.6,4.5-13.7c0,0,0-0.1,0-0.1c0-0.1,0.1-0.2,0.1-0.3c0-0.1,0.1-0.2,0.1-0.2c0,0,0,0,0,0
                                c13.9-4.8,29.5-9,46.6-13c18.5-4.4,34.8-7.1,50.4-8.9c-4.9,1.4-9.2,4.5-12.1,8.9c-1.9,3-3.8,6.5-5.5,11.2
                                c-7,19.1-6.5,31.9-6.5,50.2s-0.5,31.2,6.5,50.2c1.7,4.7,3.6,8.2,5.5,11.2C282.7,366.1,287.5,369.3,292.9,370.5z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M101.5,337.5c0.4,3.5,0.8,6.8,1.3,10.1
                                c-6.6,4.4-11.6,9.4-14.6,12.5c-3.6,3.6-6.9,7.7-13.2,11.2c-2.1,1.2-4.5,1.9-6.2,2.4c0.6-5.1,1.1-10.3,1.6-15.6
                                c1.7-20.3,2.2-39.7,2.2-58.1s-0.4-37.8-2.2-58.2c-0.5-5.3-1-10.5-1.6-15.7c1.5,0.5,4,1.4,6.2,2.6c6.3,3.5,9.6,7.6,13.2,11.2
                                c3,3,7.9,7.9,14.6,12.3c-0.5,3.4-1,6.8-1.3,10.3c-1.5,13.3-1.6,25.9-1.6,37.5S100,324.2,101.5,337.5z"></path>
                        </g>
                        <g id="Roof_Panel">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M555.7,300l-0.1,51.5v1.4
                                c-14.6-0.3-29.7-0.4-45.2-0.2c-18.4,0.2-37.3,0.8-56.8,1.7c-26.4,1.4-51.6,3.4-75.7,5.9c-0.5-6.6-0.9-13.3-1.2-20.2
                                c-0.7-13.8-0.9-27.2-0.9-40.1c-0.1-12.9,0.2-26.3,0.9-40.4c0.3-6.8,0.7-13.6,1.2-20.2c24.1,2.6,49.3,4.8,75.7,6.1
                                c2.4,0.1,4.8,0.2,7.2,0.3c2.1,0.1,4.2,0.2,6.3,0.3c4.8,0.2,9.5,0.4,14.2,0.5c1.4,0,2.9,0.1,4.3,0.1c4.6,0.1,9.2,0.2,13.7,0.3
                                c3,0.1,5.9,0.1,8.9,0.1c0.6,0,1.1,0,1.7,0c15.6,0.2,30.8,0.1,45.5-0.2h0.2L555.7,300z"></path>
                        </g>
                        <g id="Trunk">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M738.9,352.6c-3.4-5-5.3-10.9-5.3-17.2
                                v-70.8c0-12.4,7.4-23.5,18.9-28.2c-0.3-1.1-0.7-2.6-1.2-3.5c-1-1.7-2.8-3.5-4-4.8c-4.2,0.1-9.7,0.7-16,2.5
                                c-8.4,2.4-14.7,6.2-18.7,9.1c0-0.2,0.1-0.5,0.1-0.7c-2.7,2-6,5-8.5,7.1c-2,1.6-3.8,3.2-5.7,4.7c-0.6,0.4-1.6,1.2-2.4,2.7
                                c-0.5,1.1-0.8,2.3-0.8,3.5v86c0,1.3,0.3,2.4,0.8,3.5c0.8,1.5,1.9,2.3,2.4,2.7c1.9,1.4,3.7,3.1,5.7,4.7c2.9,2.3,5.8,5.1,8.5,7
                                c0-0.2-0.1-0.4-0.1-0.6c4,2.9,10.3,6.7,18.7,9.1c6.2,1.8,11.7,2.4,16,2.5c1.2-1.2,3.1-2.9,4-4.6c0.4-0.7,0.9-2.2,1.4-3.6
                                C747,361.4,742.2,357.5,738.9,352.6z M716,341l-8.5-5.5c-3.5-2.3-5.7-6.2-5.7-10.4v-50.3c0-4.2,2.1-8.1,5.7-10.4l8.5-5.5V341z"></path>
                        </g>
                        <g id="Screen_Pillar">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M377.9,360.3v8.8c-28.3,3.4-54.4,8-78,13
                                l-8-11.9c0.3,0.1,0.7,0.2,1,0.2c0.3,0.1,0.6,0.1,0.9,0.2c2.2,0.4,4.4,0.4,6.6,0.1C326.2,367.3,352.1,363.8,377.9,360.3z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M377.9,230.9l-0.1,8.5
                                c-25.8-3.5-51.6-7-77.4-10.5c-3-0.4-5.9-0.2-8.7,0.7l0,0c-0.3,0.1-0.6,0.2-0.9,0.3L300,218C323.5,223,349.6,227.5,377.9,230.9z"></path>
                        </g>
                        <g id="Rear_Quarter_Pillar">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M578.4,212.3c-0.1,0-0.1-0.1-0.1-0.1
                                c-4.9-2-13-4.6-36.9-4.8c-4.9-0.1-10.5,0-16.8,0.3c1.8,1.1,4.2,2.6,7.2,4.3c3.7,2.1,4.6,2.4,5,3.6c0.7,2.1-1.5,4.6-6.5,10
                                c-1.5,1.6-5.5,5.8-10.4,11.2l-0.2,0.2l-9.9,10.3c15.6,0.2,30.8,0.1,45.5-0.2c0.2-2,0.9-5,1.7-7.4c1-2.9,2.3-5.2,3.5-6.8
                                c-0.1,0-0.1,0-0.2,0c1.4-2.1,4.5-6,9.8-8.6c2.7-1.4,5.3-2.2,7.3-2.5c0.5-0.1,1-0.2,1.4-0.2c0.1,0,0.2,0.1,0.3,0.1
                                c1.4,0,3,0,4.6,0L578.4,212.3z M542.3,234.4c-5.9,0.5-12,0.9-18.2,1.2l12.8-11c2.1,0.8,4.1,1.9,5.8,3.3c0.1,0.1,0.1,0.1,0.1,0.1
                                c0.5,0.4,1,0.8,1.4,1.2C546.2,231,545.1,234.3,542.3,234.4z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M578.8,378.3L578.8,378.3
                                c-2.1-0.2-5.2-0.8-8.6-2.5c-4.4-2.2-7.3-5.2-8.9-7.4c-0.3-0.4-0.6-0.8-0.9-1.2h0.1c-1.1-1.9-2.5-4.4-3.4-6.9
                                c-1-2.9-1.4-6.8-1.5-8.7v1.3c-14.6-0.3-29.7-0.4-45.2-0.2l9.6,10.4l0.9,1c4.5,4.9,8,8.8,9.5,10.3c5,5.5,7.2,7.9,6.5,10
                                c-0.4,1.2-1.3,1.5-5,3.6c-2.8,1.6-5.2,3.5-7,4.6c6.2,0.3,11.7,0.3,16.6,0.3c23.8-0.3,31.9-2.8,36.8-4.8l5.6-9.8
                                C582,378.4,580.3,378.3,578.8,378.3z M544.2,370.8c-0.4,0.4-0.9,0.8-1.4,1.2c0,0,0,0-0.1,0.1c-1.7,1.4-3.7,2.5-5.8,3.3l-12.8-11
                                c6.2,0.3,12.3,0.7,18.2,1.2C545.1,365.7,546.2,369,544.2,370.8z"></path>
                        </g>
                        <g id="Sill_Plate">
                            <g id="Left_Sill_Plate">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M185.5,540.8c19.7,4,39.3,8,59,12
                                    l325.7-2.4c10.3-4.9,20.7-9.8,31-14.8c-3.7-24.1-22-42.6-43.8-45.6c-26.5-3.7-54,16.2-58.9,46.5c-62.7,0.8-125.4,1.7-188.1,2.5
                                    c2-26.3-19.4-48.5-44.5-48.1c-25,0.4-45.5,23-43.1,49C210.5,540.2,198,540.5,185.5,540.8z"></path>
                            </g>
                            <g id="Right_Sill_Plate">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M185.5,59.2c19.7-4,39.3-8,59-12
                                    l325.7,2.4c10.3,4.9,20.7,9.8,31,14.8c-3.7,24.1-22,42.6-43.8,45.6c-26.5,3.7-54-16.2-58.9-46.5c-62.7-0.8-125.4-1.7-188.1-2.5
                                    c2,26.3-19.4,48.5-44.5,48.1c-25-0.4-45.5-23-43.1-49C210.5,59.8,198,59.5,185.5,59.2z"></path>
                            </g>
                        </g>
                        <g id="Rear_Bumper">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M681.8,371.8V228.3
                                c-1.3-7.4,2.8-14.8,9.9-17.7c-3.4-1.7-6.8-2.8-9.3-3.6c-2.2,0.4-4.9,1-8.9,2c-5.2,1.1-9.4,2.1-12.2,2.8c-2.3-0.1-6,0.1-10.2,1.8
                                l-1.5,0.6c-3.2,1.5-5.2,4.8-5.2,8.3v8.8l4.7,4c5.8,5.2,9.1,12.5,9.1,20.3v88.8c0,7.8-3.3,15.2-9.1,20.3l-4.7,4.2v8.4
                                c0,3.5,2,6.8,5.2,8.3l1.5,0.6c4.2,1.7,8,1.9,10.2,1.8c2.8,0.6,7,1.6,12.2,2.8c4.4,1,7.3,1.7,9.5,2.1c2.4-0.7,5.5-1.8,8.7-3.4
                                C684.7,386.6,680.5,379.2,681.8,371.8z M669.7,376.7c-1.2,3.3-3.1,5.5-4.3,6.8v-10.6c0-1,0.3-1.9,0.8-2.7l3.9-5.6
                                C670.6,366.5,671.6,371.3,669.7,376.7z M670.1,235.4l-3.9-5.6c-0.5-0.8-0.8-1.7-0.8-2.7v-10.6c1.2,1.3,3.1,3.5,4.3,6.8
                                C671.6,228.7,670.6,233.5,670.1,235.4z"></path>
                            <path fill="#F8F8F8" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M625.2,87.1c-0.2,2.2-0.2,4.7-0.4,7.4
                                s-0.7,5.1-1.2,7.2c-0.3,1.3-0.9,2.5-1.7,3.6c-3.8,0-19.1,0.4-31.8,12.1l-0.1-0.1l-0.3-0.2l-24.6-18.4c12-7.7,19.5-22.4,18.8-39.4
                                c15.4-0.9,21.5,2.5,24.6,5.7c1.4,1.4,2.4,3,5.7,6.6c2.5,2.8,4.9,5.1,7,7C623.6,80.7,625,83.8,625.2,87.1z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M625.2,512.9c-0.2,3.3-1.6,6.4-4,8.6
                                c-2.1,1.9-4.5,4.2-7,7c-3.3,3.6-4.3,5.2-5.7,6.6c-3.1,3.2-9.2,6.6-24.6,5.7c0.7-17-6.7-31.6-18.7-39.4l24.5-18.4l0.3-0.2l0.2-0.2
                                c0.1,0.1,0.2,0.1,0.2,0.2c12.5,11.3,27.4,11.7,31.3,11.8c0.8,1.1,1.5,2.3,1.8,3.7c0.5,2.1,1,4.6,1.2,7.2
                                C625,508.2,625,510.7,625.2,512.9z"></path>
                        </g>
                        <g id="Front_Bumper">
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M140,221.5l4-1.4c2.9-1.1,5.9,1.1,5.8,4.2
                                l-0.7,18.1c-0.1,1.5-0.9,2.8-2.2,3.6l-0.2,0.1c-2.6,1.5-5.9,0-6.3-2.9l-3.2-16.8C136.8,224.3,138,222.2,140,221.5z M125.8,340.6
                                c-0.4,2.1-0.9,4.1-1.4,6c-0.7,2.5-3.3,3.5-5.2,2c-1.4-1.2-2.9-2.7-4.5-4.4l-0.1-0.1c-4.5-5.1-7.1-12.2-7.3-19.5V323
                                c-0.2-8,0-15.6,0-23s-0.2-15.1,0-23v-1.6c0.1-7.3,2.7-14.3,7.3-19.5l0.1-0.1c1.5-1.8,3.1-3.2,4.5-4.4c1.9-1.5,4.5-0.5,5.2,2
                                c0.5,1.9,0.9,3.9,1.4,5.9c3.4,15.1,4.2,29,4,40.7C130.1,311.7,129.2,325.6,125.8,340.6z M144,379.9l-4-1.4
                                c-2-0.7-3.2-2.8-2.8-4.9l3.2-16.8c0.4-2.9,3.7-4.4,6.3-2.9l0.2,0.1c1.3,0.8,2.1,2.1,2.2,3.6l0.7,18.1
                                C149.9,378.8,146.9,381,144,379.9z M149.8,338.6c-0.1,1.4-1.7,2.2-2.8,1.5c-0.9-0.6-1.8-1.2-2.7-1.7c-0.5-0.3-0.8-0.9-0.8-1.5
                                c0.5-12.3,0.8-24.6,0.8-36.9s-0.3-24.6-0.8-36.9c0-0.6,0.3-1.2,0.8-1.5c0.9-0.6,1.8-1.2,2.7-1.7c1.2-0.7,2.7,0.1,2.8,1.5
                                c0.6,12.9,0.9,25.7,0.9,38.6S150.4,325.7,149.8,338.6z M160.5,243.4c-0.1-8.3-0.3-16.5-0.4-24.7c-0.1-3.9-3-7.1-6.8-7.6
                                c-14-1.8-28.1-3.7-42.1-5.5c-0.1,0-0.2,0-0.3,0c-2.4,1.5-5.9,4.1-9.1,8.3c-2.5,3.2-3.9,6.6-4.7,8.9c0.8,0.6,1.6,1.2,2.5,2
                                c9.9,9.1,9.8,22.9,9.7,25.1v0.3l-0.6,4.1c-0.3,1.8-2.5,2.4-3.6,0.8l-2.2-3.1l0,0c0,0.1,0,0.2,0,0.3c-0.5,3.4-1,6.8-1.3,10.3
                                c-1.5,13.3-1.6,25.9-1.6,37.5s0.1,24.2,1.6,37.5c0.4,3.5,0.8,6.8,1.3,10.1c0,0.1,0,0.3,0.1,0.4l0,0l2.2-3.1
                                c1.1-1.6,3.3-1,3.6,0.8l0.6,4.1v0.3c0.1,2.2,0.2,16-9.7,25.1c-0.8,0.7-1.5,1.3-2.3,1.9c0.8,2.3,2.2,5.9,4.5,9
                                c3.3,4.3,7,6.8,9.4,8.3c14-1.8,28.1-3.7,42.1-5.5c3.8-0.5,6.7-3.7,6.8-7.6c0.2-8.2,0.3-16.5,0.4-24.7c0.3-19.1,0.4-37.9,0.4-56.6
                                S160.8,262.5,160.5,243.4z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M251.1,500.2l-17.4-16.8
                                c-9.3,3-19.7,5.6-31,7.5c-4.9,0.8-9.7,1.4-14.3,1.9c-1.1,0.1-1.6-1.3-0.7-1.9c1.3-0.9,2.7-1.8,4.1-2.7l-5.4-3.2
                                c-3.6,2.1-7,4.2-10,6.1c-0.1,0.7-0.2,1.3-0.3,2c1.3,1.2,2.6,2.7,3.9,4.4c3.2,4.4,4.6,9,5.3,12.5c0.4,1.8-0.2,3.7-1.5,5.1
                                c-0.6,0.7-1.4,1.4-2.3,2.2c-2,1.6-4,2.6-5.4,3.2c1,6.7,2.6,12.5,4.2,17.3c1.1,3.3,4.1,5.6,7.6,5.8c13.8,0.8,27.7,1.6,41.5,2.5
                                C226.7,525.5,236,507.7,251.1,500.2z M204.6,535.2l-12.6,1.1c-1.8,0.2-3.4-0.9-4-2.6c-0.1-0.4-0.3-0.8-0.4-1.2
                                c-0.1-0.4-0.2-0.8-0.2-1.3c0-1.8,1.2-3.5,3-3.9l12.1-2.8c2-0.5,3.9,0.7,4.6,2.7l0.9,3C208.7,532.6,207.1,535,204.6,535.2z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M229.4,54c-13.8,0.9-27.7,1.7-41.5,2.5
                                c-3.5,0.2-6.5,2.5-7.6,5.8c-1.6,4.8-3.2,10.6-4.2,17.3c1.4,0.6,3.4,1.6,5.4,3.2c0.9,0.8,1.7,1.5,2.3,2.2c1.3,1.4,1.9,3.3,1.5,5.1
                                c-0.7,3.5-2.1,8.1-5.3,12.5c-1.3,1.7-2.6,3.2-3.9,4.4c0.1,0.7,0.2,1.3,0.3,2c3,2,6.4,4,10,6.1l5.4-3.2c-1.5-0.9-2.8-1.8-4.1-2.7
                                c-0.9-0.6-0.4-2,0.7-1.9c4.6,0.4,9.4,1.1,14.3,1.9c11.3,1.9,21.7,4.5,31,7.5l17.4-16.8C236,92.3,226.7,74.5,229.4,54z M208,69.8
                                l-0.9,3c-0.7,2-2.6,3.2-4.6,2.7l-12.1-2.8c-1.8-0.4-3-2.1-3-4c0-0.4,0.1-0.9,0.2-1.3c0.1-0.4,0.3-0.8,0.4-1.2
                                c0.6-1.7,2.2-2.8,4-2.6l12.6,1.1C207.1,65,208.7,67.4,208,69.8z"></path>
                            <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M238.4,378.2l12.2,13
                                c-27.1-2.7-35.2-7.4-38.3-9.3c-11.8-7.3-18-16.8-22.3-23.6c-14.5-22.7-15-45.6-14.9-58.3c-0.1-12.7,0.4-35.6,14.9-58.3
                                c4.3-6.8,10.6-16.3,22.3-23.6c3.1-1.9,11.2-6.6,38.5-9.3l-12.7,13.4c-3,0.4-6.3,1.1-9.7,2.1c-16.6,5-26.5,15.8-30.8,21.4
                                c0,0,0,0,0,0c-0.4,0.5-0.8,1-1.1,1.5c0.2-0.1,0.3-0.1,0.5-0.2c-0.7,1.4-1.7,3.3-2.3,4.7c0,0,0,0,0,0c0,0-0.1,0.1-0.1,0.2
                                c0,0.1-0.1,0.2-0.1,0.3c0,0,0,0,0,0.1c-1.6,4.1-3.2,8.7-4.5,13.7c-3.5,13.4-3.5,24.6-3.4,34.1c-0.1,9.5,0,20.7,3.4,34.1
                                c1.2,4.8,2.7,9.3,4.3,13.2c0,0,0,0.1,0,0.1c0,0.1,0.1,0.2,0.1,0.1c0.6,1.7,1.6,3.8,2.2,5.3c0,0,0,0-0.1,0c0,0,0.1,0.1,0.1,0.1
                                c3.6,5,13.8,17.3,31.8,23C232,377,235.3,377.7,238.4,378.2z"></path>
                        </g>
                        <g id="Wheels">
                            <g id="Rear_Left_Wheel">
                                
                                    <ellipse fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" cx="544.5" cy="533.5" rx="34.2" ry="33.4"></ellipse>
                                
                                    <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="544.5" cy="533.5" rx="26" ry="25.3"></ellipse>
                                <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linecap="round" stroke-linejoin="round" d="M547.2,533.2
                                    c0,1.5-1.2,2.7-2.7,2.7s-2.7-1.2-2.7-2.7s1.2-2.7,2.7-2.7C546,530.6,547.2,531.8,547.2,533.2z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M544.5,556.3c0.8,0,1.8,0,2.9-0.2
                                    c0.4-0.1,0.7-0.1,1.1-0.2c0.4-0.1,0.8-0.3,1.1-0.7l1.4-1.8c0.5-0.7,0.5-1.7,0-2.4l-5-6.2c-0.8-1-2.2-1-3,0l-5,6.2
                                    c-0.5,0.7-0.5,1.7,0,2.4l1.4,1.8c0.3,0.3,0.7,0.6,1.1,0.7c0.3,0.1,0.7,0.2,1.1,0.2C542.7,556.3,543.7,556.4,544.5,556.3z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M566.3,540.5c0.3-0.8,0.5-1.7,0.7-2.8
                                    c0.1-0.4,0.1-0.7,0.1-1.1c0-0.4-0.1-0.9-0.3-1.2l-1.3-1.9c-0.5-0.7-1.4-1-2.2-0.7l-7.5,2.8c-1.1,0.4-1.6,1.8-0.9,2.8l4.4,6.7
                                    c0.5,0.7,1.4,1,2.2,0.7l2.2-0.8c0.4-0.2,0.8-0.4,1-0.8c0.2-0.3,0.4-0.6,0.5-1C565.8,542.2,566.1,541.3,566.3,540.5z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M558.4,515c-0.7-0.5-1.5-1.1-2.4-1.6
                                    c-0.3-0.2-0.7-0.3-1-0.5c-0.4-0.2-0.8-0.2-1.3-0.1l-2.2,0.6c-0.9,0.2-1.4,1-1.4,1.9l0.2,8c0,1.2,1.2,2.1,2.4,1.8l7.7-2
                                    c0.9-0.2,1.5-1,1.4-1.9l-0.1-2.3c0-0.4-0.2-0.8-0.5-1.2c-0.2-0.3-0.5-0.5-0.7-0.8C559.8,516.2,559,515.5,558.4,515z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M530.8,515.1c-0.7,0.5-1.4,1.1-2.2,1.9
                                    c-0.3,0.3-0.5,0.5-0.7,0.8c-0.3,0.3-0.4,0.8-0.5,1.2l-0.1,2.3c0,0.9,0.6,1.7,1.4,1.9l7.7,2c1.2,0.3,2.3-0.6,2.4-1.8l0.2-8
                                    c0-0.9-0.6-1.7-1.4-1.9l-2.2-0.6c-0.4-0.1-0.9-0.1-1.3,0.1c-0.3,0.1-0.7,0.3-1,0.5C532.2,514,531.4,514.6,530.8,515.1z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M522.6,540.5c0.2,0.8,0.6,1.7,1.1,2.7
                                    c0.2,0.3,0.3,0.7,0.5,1c0.2,0.4,0.6,0.7,1,0.8l2.2,0.8c0.8,0.3,1.8,0,2.2-0.7l4.4-6.7c0.7-1,0.2-2.4-0.9-2.8l-7.5-2.8
                                    c-0.8-0.3-1.8,0-2.2,0.7l-1.3,1.9c-0.2,0.4-0.3,0.8-0.3,1.2c0,0.3,0.1,0.7,0.1,1.1C522.1,538.8,522.3,539.7,522.6,540.5z"></path>
                            </g>
                            <g id="Front_Left_Wheel">
                                
                                    <ellipse fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" cx="267.9" cy="533.3" rx="34.2" ry="33.4"></ellipse>
                                
                                    <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="267.9" cy="533.3" rx="26" ry="25.3"></ellipse>
                                <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linecap="round" stroke-linejoin="round" d="M270.6,533.1
                                    c0,1.5-1.2,2.7-2.7,2.7s-2.7-1.2-2.7-2.7s1.2-2.7,2.7-2.7S270.6,531.7,270.6,533.1z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M267.9,556.2c0.8,0,1.8,0,2.9-0.2
                                    c0.4-0.1,0.7-0.1,1.1-0.2c0.4-0.1,0.8-0.3,1.1-0.7l1.4-1.8c0.5-0.7,0.5-1.7,0-2.4l-5-6.2c-0.8-1-2.2-1-3,0l-5,6.2
                                    c-0.5,0.7-0.5,1.7,0,2.4l1.4,1.8c0.3,0.3,0.6,0.6,1.1,0.7c0.3,0.1,0.7,0.2,1.1,0.2C266.1,556.2,267.1,556.3,267.9,556.2z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M289.7,540.4c0.3-0.8,0.5-1.7,0.7-2.8
                                    c0.1-0.4,0.1-0.7,0.1-1.1c0-0.4-0.1-0.9-0.3-1.2l-1.3-1.9c-0.5-0.7-1.4-1-2.2-0.7l-7.5,2.8c-1.1,0.4-1.6,1.8-0.9,2.8l4.4,6.7
                                    c0.5,0.7,1.4,1,2.2,0.7l2.1-0.8c0.4-0.2,0.8-0.4,1-0.8c0.2-0.3,0.4-0.6,0.5-1C289.1,542.1,289.5,541.2,289.7,540.4z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M281.8,515c-0.6-0.5-1.5-1.1-2.4-1.6
                                    c-0.3-0.2-0.7-0.3-1-0.5c-0.4-0.2-0.8-0.2-1.3-0.1l-2.2,0.6c-0.9,0.2-1.4,1-1.4,1.9l0.2,8c0,1.2,1.2,2.1,2.4,1.8l7.7-2
                                    c0.9-0.2,1.5-1,1.4-1.9l-0.1-2.3c0-0.4-0.2-0.8-0.5-1.2c-0.2-0.3-0.5-0.5-0.7-0.8C283.2,516.1,282.4,515.4,281.8,515z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M254.1,515c-0.7,0.5-1.4,1.1-2.2,1.9
                                    c-0.3,0.3-0.5,0.5-0.7,0.8c-0.3,0.3-0.4,0.8-0.4,1.2l-0.1,2.3c0,0.9,0.6,1.7,1.4,1.9l7.7,2c1.2,0.3,2.3-0.6,2.4-1.8l0.2-8
                                    c0-0.9-0.6-1.7-1.4-1.9l-2.2-0.6c-0.4-0.1-0.9-0.1-1.3,0.1c-0.3,0.1-0.6,0.3-1,0.5C255.6,514,254.8,514.5,254.1,515z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M246,540.4c0.2,0.8,0.6,1.7,1.1,2.7
                                    c0.2,0.3,0.4,0.7,0.5,1c0.2,0.4,0.6,0.7,1,0.8l2.1,0.8c0.8,0.3,1.8,0,2.2-0.7l4.4-6.7c0.7-1,0.2-2.4-0.9-2.8l-7.5-2.8
                                    c-0.8-0.3-1.8,0-2.2,0.7l-1.3,1.9c-0.2,0.4-0.4,0.8-0.3,1.2c0,0.3,0.1,0.7,0.1,1.1C245.4,538.7,245.7,539.6,246,540.4z"></path>
                            </g>
                            <g id="Rear_Right_Wheel">
                                
                                    <ellipse fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" cx="544.5" cy="66.6" rx="34.2" ry="33.4"></ellipse>
                                
                                    <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="544.5" cy="66.6" rx="26" ry="25.3"></ellipse>
                                <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linecap="round" stroke-linejoin="round" d="M547.2,66.8
                                    c0-1.5-1.2-2.7-2.7-2.7s-2.7,1.2-2.7,2.7s1.2,2.7,2.7,2.7C546,69.4,547.2,68.2,547.2,66.8z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M544.5,43.7c0.8,0,1.8,0,2.9,0.2
                                    c0.4,0.1,0.7,0.1,1.1,0.2c0.4,0.1,0.8,0.3,1.1,0.7l1.4,1.8c0.5,0.7,0.5,1.7,0,2.4l-5,6.2c-0.8,1-2.2,1-3,0l-5-6.2
                                    c-0.5-0.7-0.5-1.7,0-2.4l1.4-1.8c0.3-0.3,0.7-0.6,1.1-0.7c0.3-0.1,0.7-0.2,1.1-0.2C542.7,43.7,543.7,43.6,544.5,43.7z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M566.3,59.5c0.3,0.8,0.5,1.7,0.7,2.8
                                    c0.1,0.4,0.1,0.7,0.1,1.1c0,0.4-0.1,0.9-0.3,1.2l-1.3,1.9c-0.5,0.7-1.4,1-2.2,0.7l-7.5-2.8c-1.1-0.4-1.6-1.8-0.9-2.8l4.4-6.7
                                    c0.5-0.7,1.4-1,2.2-0.7l2.2,0.8c0.4,0.2,0.8,0.4,1,0.8c0.2,0.3,0.4,0.6,0.5,1C565.8,57.8,566.1,58.7,566.3,59.5z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M558.4,84.9c-0.7,0.5-1.5,1.1-2.4,1.6
                                    c-0.3,0.2-0.7,0.3-1,0.5c-0.4,0.2-0.8,0.2-1.3,0.1l-2.2-0.6c-0.9-0.2-1.4-1-1.4-1.9l0.2-8c0-1.2,1.2-2.1,2.4-1.8l7.7,2
                                    c0.9,0.2,1.5,1,1.4,1.9l-0.1,2.3c0,0.4-0.2,0.8-0.5,1.2c-0.2,0.3-0.5,0.5-0.7,0.8C559.8,83.8,559,84.5,558.4,84.9z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M530.8,84.9c-0.7-0.5-1.4-1.1-2.2-1.9
                                    c-0.3-0.3-0.5-0.6-0.7-0.8c-0.3-0.3-0.4-0.8-0.5-1.2l-0.1-2.3c0-0.9,0.6-1.7,1.4-1.9l7.7-2c1.2-0.3,2.3,0.6,2.4,1.8l0.2,8
                                    c0,0.9-0.6,1.7-1.4,1.9l-2.2,0.6c-0.4,0.1-0.9,0.1-1.3-0.1c-0.3-0.1-0.7-0.3-1-0.5C532.2,85.9,531.4,85.4,530.8,84.9z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M522.6,59.5c0.2-0.8,0.6-1.7,1.1-2.7
                                    c0.2-0.3,0.3-0.7,0.5-1c0.2-0.4,0.6-0.7,1-0.8l2.2-0.8c0.8-0.3,1.8,0,2.2,0.7l4.4,6.7c0.7,1,0.2,2.4-0.9,2.8l-7.5,2.8
                                    c-0.8,0.3-1.8,0-2.2-0.7l-1.3-1.9c-0.2-0.4-0.3-0.8-0.3-1.2c0-0.3,0.1-0.7,0.1-1.1C522.1,61.2,522.3,60.3,522.6,59.5z"></path>
                            </g>
                            <g id="Front_Right_Wheel">
                                
                                    <ellipse fill="#A5A4A4" stroke="#000000" stroke-width="1.2" stroke-linejoin="round" cx="267.9" cy="66.7" rx="34.2" ry="33.4"></ellipse>
                                
                                    <ellipse fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" cx="267.9" cy="66.7" rx="26" ry="25.3"></ellipse>
                                <path fill="none" stroke="#000000" stroke-width="0.6782" stroke-linecap="round" stroke-linejoin="round" d="M270.6,66.9
                                    c0-1.5-1.2-2.7-2.7-2.7s-2.7,1.2-2.7,2.7s1.2,2.7,2.7,2.7S270.6,68.3,270.6,66.9z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M267.9,43.8c0.8,0,1.8,0,2.9,0.2
                                    c0.4,0.1,0.7,0.1,1.1,0.2c0.4,0.1,0.8,0.3,1.1,0.7l1.4,1.8c0.5,0.7,0.5,1.7,0,2.4l-5,6.2c-0.8,1-2.2,1-3,0l-5-6.2
                                    c-0.5-0.7-0.5-1.7,0-2.4l1.4-1.8c0.3-0.3,0.6-0.6,1.1-0.7c0.3-0.1,0.7-0.2,1.1-0.2C266.1,43.8,267.1,43.7,267.9,43.8z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M289.7,59.6c0.3,0.8,0.5,1.7,0.7,2.8
                                    c0.1,0.4,0.1,0.7,0.1,1.1c0,0.4-0.1,0.9-0.3,1.2l-1.3,1.9c-0.5,0.7-1.4,1-2.2,0.7l-7.5-2.8c-1.1-0.4-1.6-1.8-0.9-2.8l4.4-6.7
                                    c0.5-0.7,1.4-1,2.2-0.7l2.1,0.8c0.4,0.2,0.8,0.4,1,0.8c0.2,0.3,0.4,0.6,0.5,1C289.1,57.9,289.5,58.8,289.7,59.6z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M281.8,85.1c-0.6,0.5-1.5,1.1-2.4,1.6
                                    c-0.3,0.2-0.7,0.3-1,0.5c-0.4,0.2-0.8,0.2-1.3,0.1l-2.2-0.6c-0.9-0.2-1.4-1-1.4-1.9l0.2-8c0-1.2,1.2-2.1,2.4-1.8l7.7,2
                                    c0.9,0.2,1.5,1,1.4,1.9l-0.1,2.3c0,0.4-0.2,0.8-0.5,1.2c-0.2,0.3-0.5,0.5-0.7,0.8C283.2,83.9,282.4,84.6,281.8,85.1z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M254.1,85c-0.7-0.5-1.4-1.1-2.2-1.9
                                    c-0.3-0.3-0.5-0.6-0.7-0.8c-0.3-0.3-0.4-0.8-0.4-1.2l-0.1-2.3c0-0.9,0.6-1.7,1.4-1.9l7.7-2c1.2-0.3,2.3,0.6,2.4,1.8l0.2,8
                                    c0,0.9-0.6,1.7-1.4,1.9l-2.2,0.6c-0.4,0.1-0.9,0.1-1.3-0.1c-0.3-0.1-0.6-0.3-1-0.5C255.6,86.1,254.8,85.5,254.1,85z"></path>
                                <path fill="#DBDBDB" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M246,59.6c0.2-0.8,0.6-1.7,1.1-2.7
                                    c0.2-0.3,0.4-0.7,0.5-1c0.2-0.4,0.6-0.7,1-0.8l2.1-0.8c0.8-0.3,1.8,0,2.2,0.7l4.4,6.7c0.7,1,0.2,2.4-0.9,2.8l-7.5,2.8
                                    c-0.8,0.3-1.8,0-2.2-0.7l-1.3-1.9c-0.2-0.4-0.4-0.8-0.3-1.2c0-0.3,0.1-0.7,0.1-1.1C245.4,61.3,245.7,60.4,246,59.6z"></path>
                            </g>
                        </g>
                        <g id="Doors">
                            <g id="Rear_Left_Door">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M515.3,468.4
                                    c-6.7,0.4-12.1-0.1-12.2-1.2s5.3-2.4,11.9-2.9c6.7-0.4,12.1,0.1,12.2,1.2C527.3,466.6,522,467.9,515.3,468.4z M434,469.9
                                    c-0.4,0-0.8,0.1-1.2,0.1c-2,24-1.4,45.6,0.2,64c18.2-0.3,41.4-0.6,56.7-1c33.2-38,44.4-58.5,47.4-69.8c0-0.1,0-0.1,0.1-0.2
                                    C503.9,464.6,469.5,466.8,434,469.9z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M537.2,463
                                    c-33.3,1.6-67.7,3.8-103.2,6.9c-0.4,0-0.8,0.1-1.2,0.1c0.2-3,0.5-6,0.9-9.1c0.2-1.8,0.4-3.5,0.6-5.2c33.5-2.9,67-5.8,100.5-8.8
                                    c1.2,2.4,2.1,4.2,2.4,4.8C538.1,453.6,538.8,456.9,537.2,463z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M536.5,381.9c-0.1-0.1-0.1-0.2-0.2-0.3
                                    c-0.7-1.2-1.9-2.8-3.8-4.9l-8.5,0.7c-25.5,2.4-52.5,4.1-80.5,5.3l0,0.2l-9.7,0.3h-0.1l-1.8,8.4c23-0.1,45.7-0.5,68.1-1.1
                                    c9,1,17.3,1.5,24.7,1.8c1.8-1.2,4.2-3.1,7-4.6c3.7-2.1,4.6-2.4,5-3.6C537,383.5,536.9,382.8,536.5,381.9z M514.3,389.8
                                    c-6.7,0.1-12.1-0.8-12-1.9c0.1-1.1,5.6-2.1,12.3-2.2c6.7,0,12.1,0.8,12,1.9C526.5,388.7,521,389.7,514.3,389.8z"></path>
                            </g>
                            <g id="Front_Left_Door">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M406.4,476.9
                                    c-6.7,0.4-12.1-0.1-12.2-1.2s5.3-2.4,11.9-2.9c6.7-0.4,12.1,0.1,12.2,1.2S413.1,476.5,406.4,476.9z M432.8,470
                                    c-38.3,3.3-80,7.1-117.7,11.5c-1.7,21,0.8,39.6,4.4,54.7c37.9-0.7,75.7-1.4,113.5-2.1V534C431.4,515.6,430.8,494,432.8,470z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M434.3,455.7c-0.2,1.7-0.4,3.5-0.6,5.2
                                    c-0.3,3.1-0.6,6.1-0.9,9.1c-38.3,3.3-80,7.1-117.7,11.5c0-0.7,0.1-1.4,0.2-2.1c0.4-4.7,1-9.2,1.8-13.5
                                    C356.2,462.5,395.2,459.1,434.3,455.7z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M408.1,391.2c-6.7,0.1-12.1-0.8-12-1.9
                                    c0.1-1.1,5.6-2.1,12.3-2.2c6.7-0.1,12.1,0.8,12,1.9C420.3,390.1,414.8,391.1,408.1,391.2z M423.8,383.6
                                    c-3.7,0.1-7.4,0.2-11.2,0.3c-33.8,0.7-66,0.3-96.5-1c-0.9,2.5-2,5.5-3.1,8c1.1-0.2,2.2-0.2,3.3-0.2c35.5,0.8,71.8,1.2,108.9,1
                                    c2.3,0,4.5,0,6.8,0l1.8-8.4L423.8,383.6z"></path>
                            </g>
                            <g id="Rear_Right_Door">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M515,135.7c-6.6-0.5-12-1.8-11.9-2.9
                                    c0.1-1.1,5.5-1.6,12.2-1.2c6.7,0.5,12,1.8,11.9,2.9C527.1,135.6,521.7,136.1,515,135.7z M489.7,67c-17.1-0.4-38.7-0.7-56.7-1.1
                                    c-1.6,18.4-2.2,40-0.2,64c0,0,0,0.1,0,0.1h0c0.4,0,0.8,0.1,1.2,0.1c35.3,3.1,69.5,5.3,102.5,6.9c0.2,0,0.4,0,0.7,0
                                    C534.2,125.8,523.1,105.2,489.7,67z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M537.2,148.3c-0.2,0.6-1.2,2.4-2.4,4.8
                                    c-30-2.6-59.9-5.2-89.9-7.8c-3.5-0.3-7.1-0.6-10.6-0.9c-0.2-1.7-0.4-3.5-0.6-5.2c-0.3-3.1-0.6-6.1-0.9-9.1
                                    c0.4,0,0.8,0.1,1.2,0.1c35.5,3.1,69.9,5.3,103.2,6.9C538.8,143.1,538.1,146.4,537.2,148.3z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M536.8,215.4c-0.4-1.2-1.3-1.5-5-3.6
                                    c-3-1.7-5.4-3.2-7.2-4.3c-7.3,0.3-15.5,0.9-24.5,1.8c-22.3-0.5-45.1-0.9-68.1-1.1l1.8,8.5h0.1l9.7,0.3c29.7,1.3,58.1,3.3,85,5.9
                                    l-0.1,0.1l3.8,0.2C535.9,219.3,537.4,217.2,536.8,215.4z M514.6,214.3c-6.7-0.1-12.2-1.1-12.3-2.2c-0.1-1.1,5.3-2,12-1.9
                                    c6.7,0.1,12.2,1.1,12.3,2.2C526.7,213.5,521.3,214.3,514.6,214.3z"></path>
                            </g>
                            <g id="Front_Right_Door">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M434.3,144.3c-3-0.3-5.9-0.5-8.9-0.8
                                    c0,0-0.1,0-0.1,0c-36-3.1-72.1-6.3-108.2-9.5v0c-0.8-4.3-1.4-8.8-1.8-13.5c-0.1-0.7-0.1-1.3-0.2-2c0,0,0-0.1,0-0.1
                                    c37.7,4.5,79.4,8.2,117.7,11.5h0c0,0,0,0.1,0,0.1c0.2,3,0.5,5.9,0.9,9C433.9,140.9,434.1,142.6,434.3,144.3z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M406.1,127.2c-6.6-0.5-12-1.8-11.9-2.9
                                    s5.5-1.7,12.2-1.2s12,1.8,11.9,2.9S412.8,127.7,406.1,127.2z M433,65.9c-1.8,0-3.5-0.1-5.2-0.1c-0.1,0-0.2,0-0.2,0
                                    c-36-0.7-72-1.3-108.1-2c-3.6,15.1-6,33.7-4.4,54.7h0c37.7,4.5,79.4,8.2,117.7,11.5c0,0,0-0.1,0-0.1
                                    C430.8,105.9,431.4,84.3,433,65.9z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M432,208.2c-2.2,0-4.5,0-6.8,0
                                    c-37.1-0.2-73.4,0.2-108.9,1c-1.1,0.1-2.2,0-3.3-0.2c1.1,2.6,2.1,5.5,3.1,8.1c30.5-1.3,62.7-1.7,96.5-1
                                    c3.8,0.1,7.5,0.2,11.2,0.3l10,0.4L432,208.2z M408.4,212.9c-6.7-0.1-12.2-1.1-12.3-2.2c-0.1-1.1,5.3-2,12-1.9
                                    c6.7,0.1,12.2,1.1,12.3,2.2C420.5,212.1,415.1,213,408.4,212.9z"></path>
                            </g>
                        </g>
                        <g id="Center_Pillar">
                            <g id="Left_Center_Pillar">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M441.8,413.7
                                    c-3,12.6-5.6,26.6-7.5,41.9c-2.8,0.2-5.6,0.5-8.4,0.7V453l0,0l7-34.7l1.5-4C437,414.1,439.4,413.9,441.8,413.7z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M449.2,413.3l-0.2,3.4h-0.1l-3.5,34.6
                                    h0.2l-0.4,3.4c-3.6,0.3-7.2,0.6-10.8,0.9c1.9-15.3,4.5-29.4,7.5-41.9C444.3,413.5,446.7,413.4,449.2,413.3z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M448.1,363.6 443.5,382.8 
                                    443.5,382.9 433.8,383.2 433.7,383.2 423.8,383.6 433.3,364.3 437.7,364.1"></path>
                                <polyline fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" points="437.8,363.9 437.7,364.1 
                                    433.7,383.2"></polyline>
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="432" y1="391.7" x2="431.9" y2="392"></line>
                            </g>
                            <g id="Right_Center_Pillar">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M449,186.7c-2.4-0.1-4.8-0.3-7.2-0.4
                                    c-3-12.6-5.6-26.6-7.5-41.9c3.5,0.3,7.1,0.6,10.6,0.9l0.5,3.4h-0.2l3.5,34.6h0.1L449,186.7z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M441.8,186.3c-2.7-0.2-5.4-0.4-8.2-0.7
                                    l-0.8-3.5c0.1,0,0.2,0,0.2,0l-7-35.1h-0.2l-0.6-3.4c3,0.3,6,0.5,9,0.8C436.2,159.7,438.8,173.7,441.8,186.3z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" d="M448.1,236.4 437.8,235.9 
                                    433.3,235.7 423.8,216.4 433.8,216.8 433.8,216.8 443.5,217.1z"></path>
                                
                                    <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="437.8" y1="235.9" x2="433.8" y2="216.8"></line>
                                <line fill="none" stroke="#000000" stroke-width="0.6782" stroke-linejoin="round" x1="432" y1="208.2" x2="431.9" y2="207.9"></line>
                            </g>
                        </g>
                        <g id="Wheel_Arc">
                            <g id="Rear_Left_Wheel_Arc">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M590.2,482.6L590.2,482.6l-0.2,0.2
                                    l-0.3,0.2l-24.5,18.4c-6-3.9-13.2-6-21.2-5.8c-24.7,0.6-43.1,23.2-38.7,50.4h-71.6l-0.7-12c18.2-0.3,41.4-0.6,56.7-1
                                    c33.2-38,44.4-58.5,47.4-69.8c13.3-0.6,27.1-1.4,40-1.8C578.3,465.6,582.1,475,590.2,482.6z"></path>
                            </g>
                            <g id="Front_Left_Wheel_Arc">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M306.4,546c3.5-28-15.1-50.2-39.9-49.6
                                    c-5.6,0.1-10.8,1.4-15.4,3.8l-17.4-16.8c4.2-1.3,8.2-2.8,12-4.2c1-0.4,0.8-1.9-0.2-2c-6.7-0.9-13.4-1.7-20.2-2.5
                                    c6.1-1.2,15.6-3,25-4.1c6.5-0.8,10.6-1.2,14.8-1.6c8.5-0.9,20.8-2.4,36.1-5.2c0.2,1.8,1.7,3.5,3.9,3.3c4-0.4,8-0.8,12-1.1
                                    c-0.8,4.3-1.4,8.8-1.8,13.5c-0.1,0.7-0.2,1.4-0.2,2.1c-1.7,21,0.8,39.6,4.4,54.7c37.9-0.7,75.7-1.4,113.5-2.1V534h0l0.7,12
                                    H306.4z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M316.1,382.9c-0.9,2.5-2,5.5-3.1,8
                                    c-0.4,0-0.8,0.1-1.2,0.2c-2.1,0.4-4.1,0.9-6.2,1.3c-0.9,0.2-1.9,0.3-2.8,0.3c-16.2,0.5-29.9,0-40.1-0.6c-4.4-0.3-8.4-0.6-12.1-1
                                    l-12.2-13c6.9,0.9,12.7,0.5,16.7-0.1c-5.2-3.5-10.3-7-15.4-10.4c8.5,2.4,17.5,4.8,26.6,6.9c11.3,2.8,23.4,5.3,34.1,7.4
                                    c-0.1,0-0.3,0.1-0.5,0.1C305.2,382.4,310.6,382.7,316.1,382.9z"></path>
                            </g>
                            <g id="Rear_Right_Wheel_Arc">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M590.1,117.4L590.1,117.4
                                    c-8.5,7.9-11.8,16.9-13,21.2c-12.8-0.4-26.7-1-39.9-1.6c-3-11.2-14.1-31.8-47.5-70c-17.1-0.4-38.7-0.7-56.7-1.1l0.8-11.9h71.5
                                    c-4.4,27.2,14,49.8,38.7,50.4c7.9,0.2,15.1-1.9,21.1-5.8h0l24.6,18.4l0.3,0.2L590.1,117.4z"></path>
                            </g>
                            <g id="Front_Right_Wheel_Arc">
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M433.8,54L433,65.9
                                    c-1.8,0-3.5-0.1-5.2-0.1c-0.1,0-0.2,0-0.2,0c-36-0.7-72-1.3-108.1-2c-3.6,15.1-6,33.7-4.4,54.7h0c0.1,0.7,0.1,1.3,0.2,2
                                    c0.4,4.7,1,9.2,1.8,13.5c-4-0.3-7.9-0.7-11.9-1c-2.3-0.2-3.8,1.5-4,3.4c-15.2-2.8-27.7-4.4-36.1-5.3c-4.2-0.4-8.3-0.8-14.8-1.6
                                    c-9.6-1.2-18.8-3-24.8-4.1c6.7-0.8,13.4-1.6,20-2.5c1-0.1,1.2-1.6,0.2-2c-3.8-1.5-7.8-2.9-12-4.2l17.4-16.8
                                    c4.7,2.3,9.9,3.6,15.4,3.8c24.8,0.6,43.4-21.6,39.9-49.6H433.8z"></path>
                                <path fill="#FFFFFF" stroke="#000000" stroke-width="0.75" stroke-linejoin="round" d="M316.1,217.1c-5,0.2-9.9,0.5-14.8,0.7
                                    c0,0,0,0,0,0c-0.4,0-0.9,0-1.3,0.1c0.2,0,0.3,0.1,0.5,0.1c-10.6,2.1-22.9,4.7-34.1,7.4c-9,2.2-17.9,4.5-26.4,6.9
                                    c5-3.4,10.1-6.9,15.2-10.2c-4-0.6-9.9-1-16.9,0l12.7-13.4c3.6-0.4,7.6-0.7,11.9-1c10.2-0.7,23.9-1.2,40.1-0.6
                                    c1,0,1.9,0.1,2.8,0.4c2.1,0.4,4.1,0.9,6.2,1.3c0.4,0.1,0.8,0.2,1.2,0.2C314,211.6,315.1,214.5,316.1,217.1z"></path>
                            </g>
                        </g>
                    </g>
                </g>
                </svg>
        </div>
    </div>
</div>
@endsection


