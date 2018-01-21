<div class="errorContainer">
    <div class="modalError">
        <div class="errorHeader">
            <div class="close closeModal" onclick="closeError(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3 class="errorTitle"></h3>
        </div>
        <div class="errorContent">
            <div class="contentContainer">
                <div class="card">
                    <p class="errorMsg">

                    </p>
                </div>
                <div class="actions">
                    <button onclick="closeError(this);" class="button">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a onclick="closeError(this)" class="modalBg errorModalBg closeModal"></a>