
<div id="videoModal" class="modalContainer">
    <div class="modal">
        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Kijk video</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                    <div class="card">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/o_S4t2b1YBI?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
            </div>
        </div>
    </div>
</div>
<a id="childModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>