@if(isset($show_cookie_consent_banner) && $show_cookie_consent_banner)
    <div id="cookieConsentBanner" class="cookie-banner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="cookie-text" style="display: inline;">This site uses cookies. By continuing to browse the site, you agree to <a href="{{ route('use-of-cookies') }}">our use of cookies</a>.</p>
                    
                    <button onclick="document.getElementById('accept-cookies-form').submit();" class="btn btn-primary" style="display: inline;">Accept</button>
                    
                    <form id="accept-cookies-form" action="{{ route('cookies.accept') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
