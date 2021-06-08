<div class="contact-form contents">

    <form class="contents form" id="contact-form" action="{{route('front_contact_form')}}">

        {{ csrf_field() }}
    
        <div class="form-group grid-column-1 grid-row-2">
            <div class="form-label">
                <label for="email" class="label-highlight">@Lang('front/contact_form.email')</label>
            </div>
            <div class="form-input">
                <input type="email" class="input-highlight" value="" name="email">
            </div>
        </div>
    
        <div class="form-group grid-column-1 grid-row-3">
            <div class="form-label">
                <label for="name" class="label-highlight">@Lang('front/contact_form.name')</label>
            </div>
            <div class="form-input">
                <input type="name" class="input-highlight" name="name">
            </div>
        </div>
    
        <div class="form-group grid-column-2 grid-row-span-2">
            <div class="form-label">
                <label for="message" class="label-highlight">@Lang('front/contact_form.message')</label>
            </div>
            <div class="form-input">
                <textarea class="input-highlight" name="message"></textarea>
            </div>
        </div>

        <div class="form-group grid-column-1 grid-row-5">
            <div class="form-input">
                <input type="checkbox" id="privacy" name="privacy">
                <label for="privacy">@Lang('front/contact_form.privacy')</label>
            </div>
        </div>
    
        <div class="form-errors grid-column-2 grid-row-4">
            @include('front.components.desktop.form_errors')
        </div>  
        
        <div class="form-sucess grid-column-2 grid-row-4">
            @include('front.components.desktop.form_success')
        </div>  

        <div class="form-group form-submit grid-column-2 grid-row-5">
            <button  id="send-button" >
                @lang('front/contact_form.send')
            </button>
        </div>

    </form>
</div>
