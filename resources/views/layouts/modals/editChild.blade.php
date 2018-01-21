
<div id="editChildModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Kind Wijzigen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="editKidForm" name="editKidForm"  method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <h4>Foto kind</h4>
                        <img class="profile inputImage" id="imgChild">
                        <input onchange="handleInputChange(event)"  type="file" name="picture" id="picture" class="input">
                    </div>
                    <div class="card">
                        <h4>Naam</h4>
                        <input required name="firstName" id="firstName" type="text" placeholder="Voornaam*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                        <input required name="lastName" id="lastName" type="text" placeholder="Achternaam*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                    </div>
                    <div class="card">
                        <h4>Geboortedatum</h4>
                        <input required name="dateOfBirth" id="dateOfBirth" type="date" class="input">
                    </div>
                </form>
                <div class="actions">
                    <button form="editKidForm" class="button">Wijzigen</button>
                    <button id="deleteButton" class="button cancel closeModal">Verwijder</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="editChildModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>