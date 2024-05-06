@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div id="section-1">
        <div class="py-1">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <img title="" class="rounded w-100" src="assets/img/plan1.png" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title my-5 display-5 fw-bold ls-tight">
                                    Every trip <br />
                                    <span class="text-primary">in one place</span>
                                </h1>
                                <p class="card-text card-text-main mb-5">YouTravel helps you keep track of your flights,
                                    hotels, car rentals, confirmation numbers, and other details–all in one place–so you
                                    don’t have to search through multiple emails or apps to find what you need. </p>
                                <a href="/signup" class="btn button">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="section-2">
        <div class="py-1">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-1 fw-semibold ls-tight mb-5">Know where to be <br>and when</h5>
                                <p class="card-text card-text-main mb-5">YouTravel creates a schedule showing you where to
                                    be and when. Whether it’s a business trip, a family vacation, or a quick weekend
                                    getaway, YouTravel will organize all your information so you can access your trip
                                    details on the go. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="aos-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="aos-item__inner">
                                <img title="" class="rounded w-100" src="assets/img/plan4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-3">
        <div id="section-3-start"></div>
        <div class="py-1">
            <div class="container py-5">
                <h2 class="pb-4 fw-bold">How It Works</h2>
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-4 g-4">
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="aos-item__inner d-block bg-light p-4 text-center rounded">
                            <i class="fa-solid fa-1 display-4 p-2 mb-2"></i>
                            <h4 class="pt-2">Create an account</h4>
                            <p>Aenean id ornare velit, quis condimentum augue.</p>
                        </div>
                    </div>
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="aos-item__inner d-block bg-light p-4 text-center rounded">
                            <i class="fa-solid fa-2 display-4 p-2 mb-2"></i>
                            <h4 class="pt-2">Add your trips</h4>
                            <p>Aenean id ornare velit, quis condimentum augue.</p>
                        </div>
                    </div>
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="600">
                        <div class="aos-item__inner d-block bg-light p-4 text-center rounded">
                            <i class="fa-solid fa-3 display-4 p-2 mb-2"></i>
                            <h4 class="pt-2">Start planning</h4>
                            <p>Aenean id ornare velit, quis condimentum augue.</p>
                        </div>
                    </div>
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="800">
                        <div class="aos-item__inner d-block bg-light p-4 text-center rounded">
                            <i class="fa-solid fa-4 display-4 p-2 mb-2"></i>
                            <h4 class="pt-2">See the world</h4>
                            <p>Aenean id ornare velit, quis condimentum augue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-4">
        <div class="py-2">
            <div class="container py-5 text-center">
                <p class="fs-1 fw-semibold">Try the travel app that keeps up with you </p>
                <p class="fs-5">So many trips, so little time. Let YouTravel worry about the details, so you don't have to.
                </p>
                <a href="/signup" class="btn button mt-5">Sign Up–It’s Free!</a>
            </div>
        </div>
    </section>
    <section>
        <div class="py-5">
            <div class="container py-5">
                <h2 class="fw-bold pb-4">Contact us</h2>
                <div class="row g-5">
                    <div class="col-xl-6">
                        <div class="row row-cols-md-2 g-4">
                            <div class="aos-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="aos-item__inner">
                                    <div class="bg-light d-block p-3 rounded">
                                        <div class="d-flex justify-content-start">
                                            <i class="fa-solid fa-envelope h3 pe-2"></i>
                                            <span class="h5">Email</span>
                                        </div>
                                        <span>example@domain.com</span>
                                    </div>
                                </div>
                            </div>
                            <div class="aos-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="aos-item__inner">
                                    <div class="bg-light d-block p-3 rounded">
                                        <div class="d-flex justify-content-start">
                                            <i class="fa-solid fa-phone h3 pe-2"></i>
                                            <span class="h5">Phone</span>
                                        </div>
                                        <span>+0123456789, +9876543210</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aos-item mt-4" data-aos="fade-up" data-aos-delay="600">
                            <div class="aos-item__inner">
                                <div class="bg-light d-block p-3 rounded">
                                    <div class="d-flex justify-content-start">
                                        <i class="fa-solid fa-location-pin h3 pe-2"></i>
                                        <span class="h5">Office location</span>
                                    </div>
                                    <span>#007, Street name, Bigtown BG23 4YZ, England</span>
                                </div>
                            </div>
                        </div>
                        <div class="aos-item" data-aos="fade-up" data-aos-delay="800">
                            <div class="mt-4 w-100 aos-item__inner">
                                <iframe class="rounded" width="100%" height="345" frameborder="0" scrolling="no"
                                    marginheight="0" marginwidth="0"
                                    src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                                        href="https://www.maps.ie/distance-area-calculator.html">measure acres/hectares
                                        on map</a></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <h2 class="pb-4">Leave a message</h2>
                        <div class="row g-4">
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Fname</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lname</label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Phone</label>
                            <input type="tel" class="form-control" placeholder="+1234567890">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Country</label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">USA</option>
                                <option value="2">Non USA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="button" class="btn" style="background-color: #de5285;color:white">Send
                            Message</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3 col-sm-12">
                        <h5 class="pb-3"><i class="fa-solid fa-user-group pe-1"></i> About us</h5>
                        <span class="text-secondary">This is a wider card with supporting text below as a natural
                            lead-in to
                            additional content.</span>
                    </div>
                    <div class="col-md-6 col-xl-3 col-sm-12">
                        <h5 class="pb-3"><i class="fa-solid fa-link pe-1"></i> Important links</h5>
                        <ul>
                            <li><a href="#" class="text-decoration-none link-secondary">About us</a></li>
                            <li><a href="#" class="text-decoration-none link-secondary">Privacy policy</a></li>
                            <li><a href="#" class="text-decoration-none link-secondary">Terms of services</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xl-3 col-sm-12">
                        <h5 class="pb-3"><i class="fa-solid fa-location-dot pe-1"></i> Our location</h5>
                        <span class="text-secondary">
                            Milannagar bazar<br>
                            Tamluk, East Medinipore, West Bengal<br>
                            720001, India<br>
                        </span>
                    </div>
                    <div class="col-md-6 col-xl-3 col-sm-12">
                        <h5 class="pb-3"><i class="fa-solid fa-paper-plane pe-1"></i> Stay updated</h5>
                        <form>
                            <input type="text" class="w-100 mb-2 form-control" name="" placeholder="Email ID">
                            <button class="w-100 btn" style="background-color: #de5285;color:white">Subscribe
                                now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
