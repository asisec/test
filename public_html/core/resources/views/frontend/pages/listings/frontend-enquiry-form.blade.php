@if($user_enquiry_form === true)
    <div class="business-hour enquiry-hour box-shadow1 mt-4">
        <h3 class="head5 enquiry-head d-flex">{{ deepl_translate(__('Enquiry Form')) }} </h3>
        <div class="enquiry-wraper">
            <div class="enquiry_form_submit">
                <form action="{{route('visitor.enquiry.form.submit')}}" method="post">
                    @csrf

                    <input type="hidden" name="listing_id" id="listing_id" value="{{ $listing->id }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $listing->user_id }}">

                    <div class="input-wraper mt-3">
                        <label for="name">{{ deepl_translate(__('Name')) }}</label>
                        <input class="form-control"  type="text" name="name" id="name" placeholder="{{ deepl_translate(__('Name')) }}">
                    </div>
                    <div class="input-wraper mt-3">
                        <label for="email">{{ deepl_translate(__('Email')) }}</label>
                        <input  class="form-control" type="email" name="email" id="email" placeholder="{{ deepl_translate(__('Email')) }}">
                    </div>
                    <div class="input-wraper mt-3">
                        <label for="Phone">{{ deepl_translate(__('Phone')) }}</label>
                        <input  class="form-control" type="number" name="phone" id="phone" placeholder="{{ deepl_translate(__('Phone')) }}">
                    </div>
                    <div class="input-wraper mt-3">
                        <label for="#message">{{ deepl_translate(__('Message')) }}</label>
                        <textarea  class="form-control" type="text" name="message" id="message" placeholder="{{ deepl_translate(__('Message')) }}"></textarea>
                    </div>
                    <div class="save-change-btn mt-3 text-start btn-sm">
                        <button type="submit" class="red-btn">{{ deepl_translate(__('Submit Enquiry')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
