<div class="contact-form contents">

    <form class="contents" id="contact-form" method="POST" action="{{route('front_contact_form')}}">

        {{ csrf_field() }}
    
        <div class="form-group grid-column-1 grid-row-2">
            <div class="form-label">
                <label for="email" class="label-highlight">Email</label>
            </div>
            <div class="form-input">
                <input type="email" class="input-highlight" value="" name="email">
            </div>
        </div>
    
        <div class="form-group grid-column-1 grid-row-3">
            <div class="form-label">
                <label for="name" class="label-highlight">Nombre</label>
            </div>
            <div class="form-input">
                <input type="name" class="input-highlight" name="name">
            </div>
        </div>
    
        <div class="form-group grid-column-2 grid-row-span-2">
            <div class="form-label">
                <label for="message" class="label-highlight">Mensaje</label>
            </div>
            <div class="form-input">
                <textarea class="input-highlight" name="message"></textarea>
            </div>
        </div>

        <div class="form-group grid-column-1 grid-row-4">
            <div class="form-input">
                <input type="checkbox" id="privacy" name="privacy">
                <label for="privacy">He leído y acepto la información básica sobre protección de datos.</label>
            </div>
        </div>
    
        <div class="form-group form-submit grid-column-2 grid-row-4">
            <button type="submit">
                @lang('front/contact.send')
            </button>
        </div>
    </form>

    <div class="login-errors">
        @include('front.components.desktop.errors')
    </div>    
</div>
