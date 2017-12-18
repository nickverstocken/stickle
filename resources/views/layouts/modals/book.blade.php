
<div id="bookModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Boek toevoegen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="addStopForm" name="addBookFrm" class="signup-form">
                    <div class="card">
                        <h4>Auteur</h4>
                        <input type="text" placeholder="Auteur*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                    </div>
                    <div class="card">
                        <h4>Titel</h4>
                        <input required name="title" type="text" class="input" id="title" placeholder="Boek titel*" class="input">
                    </div>
                    <div class="card">
                        <h4>Korte samenvatting</h4>
                        <textarea required name="description" type="text" class="input" id="description" placeholder="Korte beschrijving*" class="input"></textarea>
                    </div>
                </form>
                <div class="actions">
                    <button  form="addBookFrm" class="button">Add</button>
                    <button  class="button cancel closeModal" onclick="closeModal(this);">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="bookModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>