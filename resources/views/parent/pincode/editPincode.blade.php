<div onkeypress="typeCode($event)" class="parentcode">
    <div class="parentCodeWrap">
        <div class="head">
            <h2>Voer je oude pincode in.</h2>
        </div>
        <div id="codeString" class="code">
            <span></span><span></span><span></span><span></span>
        </div>
        <div class="keyPad">
            <div class="grid">
                <div onclick="pushCode(event,1)" class="key">1</div>
                <div onclick="pushCode(event,2)" class="key">2</div>
                <div onclick="pushCode(event,3)" class="key">3</div>
                <div onclick="pushCode(event,4)" class="key">4</div>
                <div onclick="pushCode(event,5)" class="key">5</div>
                <div onclick="pushCode(event,6)" class="key">6</div>
                <div onclick="pushCode(event,7)" class="key">7</div>
                <div onclick="pushCode(event,8)" class="key">8</div>
                <div onclick="pushCode(event,9)" class="key">9</div>
                <div onclick="pushCode(event,'clear')" class="key">x</div>
                <div onclick="pushCode(event,0)" class="key">0</div>
                <div onclick="pushCode(event,'back')" class="key">&#8592;</div>
            </div>
        </div>
        <div class="codeSubmit">
            <button onclick="pushCode(event,'cancel')">Annuleer</button>  <button id="doneKey" onclick="pushCode(event,'old')">Klaar</button>
        </div>
    </div>
</div>
<div class="backgroundAnimalsCode">
    <img class="animal-bg giraf" src="{{ URL::asset('images/giraf.svg') }}" alt="Giraf">
</div>
