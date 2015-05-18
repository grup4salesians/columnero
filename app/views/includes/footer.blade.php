<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2015 DawColumner | By Grup 4
                </div>

            </div>
        </div>
    </footer>

<script>
$(function () {
    $(".favorito").click(function () {
                
        var cargando = $(this).next(".paco");
        var url="",PonerQuitar=0;
        var ItemSelected = $(this);
         cargando.css('display','block');
         console.log(ItemSelected.data("id"));
        if($(this).hasClass("NotaNoFavorito")){
            url = "afegir/" + ItemSelected.data("id");
            PonerQuitar = 1;
        }
        else{
            url = "treure/" + ItemSelected.data("id");
         }
        
        $.ajax({
            url: url
        }).success(function () {
            cargando.css('display','none');
            PonerQuitarColorFavorito(PonerQuitar,ItemSelected);
        });
    });

    function PonerQuitarColorFavorito(PonerQuitar,Item){
        if (PonerQuitar){
            Item.removeClass("NotaNoFavorito").addClass("NotaFavorito"); 
        }
        else{
            Item.removeClass("NotaFavorito").addClass("NotaNoFavorito"); 
        }
        
    }
});
</script>