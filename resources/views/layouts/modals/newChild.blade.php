
<div id="childModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Kind toevoegen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="addKidForm" name="addKidForm">
                    <div class="card">
                        <h4>Naam</h4>
                        <input type="text" placeholder="Voornaam*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                        <input type="text" placeholder="Naam*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                    </div>
                    <div class="card">
                        <h4>Info</h4>
                        <input required name="title" type="text" class="input" id="title" placeholder="Boek titel*" class="input">
                    </div>
                </form>
                <div class="actions">
                    <button  form="addKidForm" class="button">Add</button>
                    <button  class="button cancel closeModal" onclick="closeModal(this);">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="childModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>