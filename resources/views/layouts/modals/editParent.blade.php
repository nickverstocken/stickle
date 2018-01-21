
<div id="editParentModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Account Wijzigen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="editParentForm" name="editParentForm"  method="POST" enctype="multipart/form-data" action="/accountwijzigen">
                    {{ csrf_field() }}
                    <div class="card">
                        <h4>Naam</h4>
                        <input class="input" type="text" id="firstname" placeholder="Voornaam*" value="{{Auth::user()->firstname}}" name="firstname" autocorrect="off" autocapitalize="off" spellcheck="off" required>
                        <input class="input" type="text" id="lastname" placeholder="Achternaam*" value="{{Auth::user()->lastname}}" name="lastname" autocorrect="off" autocapitalize="off" spellcheck="off" required>
                    </div>
                    <div class="card">
                        <h4>Email</h4>
                        <input class="input" type="email" id="email" placeholder="Email" value="{{Auth::user()->email}}" name="email" autocorrect="off" autocapitalize="off" spellcheck="off" required >
                    </div>
                    <div class="card">
                        <h4>Wachtwoord</h4>
                        <input type="password" id="password" placeholder="Wachtwoord" name="password">
                        <input type="password" id="password_comfirmation" placeholder="Bevestig wachtwoord" name="password_confirmation">
                        <input type="hidden" id="oldPincode" name="pincode" value="{{Auth::user()->parentPincode}}" id="pincode">
                    </div>
                </form>
                
                <div class="actions">
                    <button onclick="showEditKeyPad()" class="button orange">Pin Wijzigen</button>
                    <button form="editParentForm" class="button">Wijzigen</button>
                    <a id="deleteButton" href="/verwijderaccount" class="button cancel closeModal">Verwijder</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
<a id="editParentModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>