@extends('_layouts.master')

@section('content')

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> <span class="light">Dealer</span> Inspire Challenge
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#coffee">Coffee</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Challenge</h1>
                        <p class="intro-text">Code Something Awesome.
                            <br>We &lt;3 PHP Developers.</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About This Challenge</h2>
                <p>We make awesome things at Dealer Inspire.  We'd like you to join us.  That's why we made this page.  Are you ready to join the team?</p>
                <p>To take the code challenge, visit <a href="https://bitbucket.org/dealerinspire/php-contact-form">this Git Repo</a> to clone it and start your work.</p>
            </div>
        </div>
    </section>

    <section id="coffee" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Coffee Break?</h2>
                    <p>Take a coffee break.  You deserve it.</p>
                    <a href="https://www.youtube.com/dealerinspire" class="btn btn-default btn-lg">or Watch YouTube</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" id="contact-form">
                <div>
                    <h3 v-if="hasContacted"><i class="fa fa-check-circle"></i> Thanks! Mr. Smiley will be in touch soon.</h3>
                    <div v-else>
                        <h2>Contact Guy Smiley</h2>
                        <p>Remember Guy Smiley?  Yeah, he wants to hear from you.</p>
                        <p class="bg-primary">
                            
                            <div class="form-group">
                                <input v-model="contact.full_name" type="text" name="full_name" class="form-control{{ $errors->has('full_name') ? ' has-error' : '' }}" placeholder="Full Name *" value="{{ old('full_name') }}" required>
                                <div class="text-danger text-left" v-if="errors.full_name">
                                    <small>@{{errors.full_name[0]}}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <input v-model="contact.email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Email *" value="{{ old('email') }}" required>
                                <div class="text-danger text-left" v-if="errors.email">
                                    <small>@{{errors.email[0]}}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <input v-model="contact.phone" type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' has-error' : '' }}" placeholder="Phone" value="{{ old('phone') }}">
                                <div class="text-danger text-left" v-if="errors.phone">
                                    <small>@{{errors.phone[0]}}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea v-model="contact.message" name="message" cols="30" rows="10" class="form-control{{ $errors->has('message') ? ' has-error' : '' }}" placeholder="Message *" required>{{ old('message') }}</textarea>
                                <div class="text-danger text-left" v-if="errors.message">
                                    <small>@{{errors.message[0]}}</small>
                                </div>
                            </div> 

                            <div class="form-group">
                                <button class="btn btn-default btn-lg" @click="submitForm()">Send</button>
                            </div>

                            
                        </p>
                    </div>
                <div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div id="map"></div>

@stop

@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var contactFormApp = new Vue({
        el: '#contact-form',
        data() {
            return {
                hasContacted: false,
                contact: {
                    full_name: '',
                    email: '',
                    phone: '',
                    message: '',
                },
                errors: {}
            };
        },
        methods: {
            submitForm() {
                axios.post('/contact', {
                    full_name: this.contact.full_name,
                    email: this.contact.email,
                    phone: this.contact.phone,
                    message: this.contact.message,
                })
                    .then((response) => {
                        this.hasContacted = response.data.success;
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    })
</script>
@endpush
