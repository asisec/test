<div class="modal fade" id="premiumRequiredModalResponsive" tabindex="-1" role="dialog" aria-labelledby="premiumRequiredModalResponsiveLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="premiumRequiredModalResponsiveLabel">{{ deepl_translate(__('Membership Required')) }}</h6>
        </div>
        <div class="modal-body">
          <p class="posted" style="color:var(--color-8); text-align: left;">
            {{ deepl_translate(__('Only paid members can see this number. If you want to see the this number, please ')) }}

            <a href="/membership" class="text-decoration-underline" target="_blank">
                {{ deepl_translate(__('purchase a paid membership.'))}}
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>