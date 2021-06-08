<div class="page-content">
    <div class="about-us ">
        <div class="about-us-element ">
            <div class="about-us-image ">
                @if ($agent->isDesktop())
                    @isset($business->image_our_business_desktop)
                        <img src="{{ Storage::url($business->image_our_business_desktop->path) }}"
                            alt="{{ $business->image_our_business_desktop->alt }}"
                            title="{{ $business->image_our_business_desktop->title }}">
                    @endisset
                @endif

                @if ($agent->isMobile())
                    {{-- @isset($business->$business->image_our_business_mobile) --}}
                    <img src="{{ Storage::url($business->image_our_business_mobile->path) }}"
                        alt="{{ $business->image_our_products_mobile->alt }}"
                        title="{{ $business->image_our_products_mobile->title }}">
                    {{-- @endisset --}}
                @endif
            </div>
            <div class="about-us-title ">
                <h3>@lang('front/information.ourbusinessTitle')</h3>
            </div>
            <div class="about-us-text ">
                @lang('front/information.ourbusiness')
            </div>

        </div>


        {{-- <div class="about-us-element">
            <div class="about-us-image">
                @if ($agent->isDesktop())
                    @isset($business->image_our_products_desktop)

                        <img src="{{ Storage::url($business->image_our_products_desktop->path) }}"
                            alt="{{ $business->image_our_products_desktop->alt }}"
                            title="{{ $business->image_our_products_desktop->title }}">
                    @endisset
                @endif

                @if ($agent->isMobile())
                    @isset($business->image_our_products_mobile)

                        <img src="{{ Storage::url($business->image_our_products_mobile->path) }}"
                            alt="{{ $business->image_our_products_mobile->alt }}"
                            title="{{ $business->image_our_products_mobile->title }}">
                    @endisset
                @endif
            </div>
            <div class="about-us-title">
                <h3>@lang('front/information.ourproductsTitle')</h3>
            </div>
            <div class="about-us-text">
                @lang('front/information.ourproducts')
            </div>
        </div> --}}
    </div>
</div>
