<div id="openbookModal" class="modalContainer">
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
                           <img id="bookImage">
                        </div>
                    <div class="card">
                        <h4 id="bookTitletext">Titel</h4>
                        <h4 id="author">Auteur</h4>
                        <h4 id="pages">Aantal bladzijden</h4>
                    </div>
                    <div class="card">
                        <h4>Korte samenvatting</h4>
                        <div id="description"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
<a id="openbookModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>