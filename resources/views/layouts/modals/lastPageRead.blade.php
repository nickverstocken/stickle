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
                <form id="lastPageReadForm" name="lastPageReadForm"  method="POST" action="/ouders/boeken/veranderlaatstepagina">
                    {{ csrf_field() }}
                    <div class="card">
                            <h4 id="lastPageText"></h4>
                            <input required name="child_id" type="number" id="child_id" hidden>
                            <input required name="readingBook_id" type="number" id="readingBook_id" hidden>
                            <input required name="lastPageRead" type="number" class="input" id="newLastPageRead" placeholder="Typ de laatste pagina*">
                        </div>
                </form>
                <div id="editActions" class="actions">
                    <button  form="lastPageReadForm" class="button">Gereed</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="lastPageReadModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>