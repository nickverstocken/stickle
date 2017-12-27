
<div id="editbookModal" class="modalContainer">
    <div class="modal">

        <div class="modalHeader">
            <div class="close closeModal" onclick="closeModal(this);">
                <img src="{{ URL::asset('images/icons/error.svg') }}" alt="Close">
            </div>
            <h3>Boek wijzigen</h3>
        </div>
        <div class="modalContent">
            <div class="contentContainer">
                <form id="editBookForm" name="editBookForm"  method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                            <h4>Afbeelding van het boek</h4>
                            <input type="file" name="bookCover" id="bookCover" class="input">
                        </div>
                    <div class="card">
                        <h4>Titel</h4>
                        <input required name="title" type="text" class="input" id="title" placeholder="Boek titel*">
                    </div>
                    <div class="card">
                        <h4>Auteur</h4>
                        <input required name="author" type="text" id="author" placeholder="Auteur*" autocorrect="off" autocapitalize="off" spellcheck="off" class="input">
                    </div>                    
                    <div class="card">
                        <h4>Korte samenvatting</h4>
                        <textarea required name="shortDescription" type="text" class="input" id="description" placeholder="Korte beschrijving*" class="input"></textarea>
                    </div>
                    <div class="card">
                        <h4>Aantal bladzijden</h4>
                        <input required name="numberOfPages" type="number" class="input" id="numberOfPages" placeholder="Aantal bladzijden*">
                    </div>
                    
                </form>
                <div class="actions">
                    <button  form="editBookForm" class="button">Wijzig</button>
                    <button  class="button cancel closeModal" onclick="/ouders/boeken/verwijder/{{ $book->readingBook_id }}">Verwijder</button>
                </div>
            </div>
        </div>
    </div>
</div>
<a id="editbookModalBg" onclick="closeModal($event)" class="modalBg closeModal"></a>