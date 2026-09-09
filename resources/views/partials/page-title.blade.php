<div class="tf-page-title-3 flat-spacing-10" style="background-image:url('{{ asset('assets/images/item/page-title-bg.jpg') }}');background-size:cover;background-position:center;">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs d-flex align-items-center justify-content-center flex-wrap gap-2 text-caption">
                    <li><a href="{{ route('home') }}" class="link">Startseite</a></li>
                    <li><i class="icon icon-ArrowRight"></i></li>
                    @isset($crumbParent)
                        <li><a href="{{ $crumbParent['url'] }}" class="link">{{ $crumbParent['label'] }}</a></li>
                        <li><i class="icon icon-ArrowRight"></i></li>
                    @endisset
                    <li class="js-page-title">{{ $pageTitle }}</li>
                </ul>
                <h3 class="heading text-center js-page-title">{{ $pageTitle }}</h3>
            </div>
        </div>
    </div>
</div>
