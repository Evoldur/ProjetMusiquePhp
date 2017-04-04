myApp.addModule.apply(myApp.gui, ["callbacksUpdateDetails", function(){

    var getHtmlCodeDetail = function(){
        var htmlCode = "<span class=\"panel\">" +
        "<p><strong>Nom</strong>"+ myApp.modele.selectedMusique.getNom() + "</p>"
            + "<button id=\"boutonModifierMusique\">Modifier</button><br/>"+
            "<button id=\"boutonSupprimerMusique\">Supprimer</button><br/>";
        htmlCode += "</span>";
        return htmlCode;
    };

    var repaintDetail = function(contextArg){
        $("#modifierMusiqueForm").empty();
        $("#ajouterMusiqueFrom").empty();

        $("#vueDetail").empty();
        $("#vueDetail").html(getHtmlCodeDetail());

        myApp.gui.mediator.publish("musique/detailsRebuilt");
    };

    myApp.gui.mediator.subscribe("musique/detailsChanged", repaintDetail);
    myApp.gui.mediator.subscribe("musique/changed", repaintDetail);
}()]);