<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ deepl_translate(__('Report')) }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('listing.report.add')}}" method="POST">
                @csrf
                <input type="hidden" name="listing_id" id="listing_id_for_report" value="{{ $listing->id }}">
                <div class="modal-body p-3">
                    <div class="single-input mb-3">
                        <label for="priority" class="label-title">{{ deepl_translate(__('Reason')) }}</label>
                        <select name="reason_id" id="reason_id" class="select2_activation w-100">
                            <option value="">{{ deepl_translate(__('Select Reason')) }}</option>
                            @foreach($report_reasons as $reason)
                                <option value="{{ $reason->id }}">{{ deepl_translate($reason->title) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-form.summernote :title="deepl_translate(__('Description'))" :name="'description'" :id="'description'" />
                </div>
                <div class="modal-footer">
                    <div class="btn-wrapper text-center">
                     <button type="button" class="red-global-close-btn radius-5 mx-3" data-bs-dismiss="modal">{{ deepl_translate(__('Close')) }}</button>
                      <button type="submit" class="red-global-btn radius-5">{{deepl_translate(__('Submit'))}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
