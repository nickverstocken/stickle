
<div id="editParentModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Kind Wijzigen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="editParentForm" name="editKidForm"  method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <h4>Naam</h4>
                        <input class="input" type="text" id="firstname" placeholder="Voornaam*" value="{{Auth::user()->firstname}}" name="firstname" autocorrect="off" autocapitalize="off" spellcheck="off" required>
                        <input class="input" type="text" id="lastname" placeholder="Achternaam*" value="{{Auth::user()->lastname}}" name="lastname" autocorrect="off" autocapitalize="off" spellcheck="off" required>
                    </div>
                    <div class="card">
                        <h4>Email</h4>
                        <input class="input" type="email" id="email" placeholder="Email" name="email" autocorrect="off" autocapitalize="off" spellcheck="off" required >
                        <input class="input" type="password" id="password" placeholder="Wachtwoord" name="password">
                        <input class="input" type="password" id="password_comfirmation" placeholder="Bevestig wachtwoord" name="password_confirmation">
                        <input class="input" type="hidden" id="pincode" name="pincode" value="" id="pincode">
                    </div>
                    <div class="card">
                        <h4>Wachtwoord</h4>
                        <input type="password" id="password" placeholder="Wachtwoord" name="password">
                        <input type="password" id="password_comfirmation" placeholder="Bevestig wachtwoord" name="password_confirmation">
                        <input type="hidden" id="pincode" name="pincode" value="" id="pincode">
                    </div>


                </form>
                <div class="actions">
                    <button form="editParentForm" class="button">Wijzigen</button>
                    <button id="deleteButton" class="button cancel closeModal">Verwijder</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="editParentModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>