<div id="lastPageReadModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3 id="bookTitle"></h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                    <div class="card">
                            <h4 id="lastPageText"></h4>
                            <input required name="lastPageRead" type="number" class="input" id="newLastPageRead" placeholder="Typ de laatste pagina*">
                        </div>
                <div id="editActions" class="actions">
                    <button id="changeLastPage" class="button">Gereed</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="lastPageReadModalBg" onclick="closeModal(this)" class="modalBg closeModal"></a>