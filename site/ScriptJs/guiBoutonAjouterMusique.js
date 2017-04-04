myApp.addModule.apply(myApp.gui, ["callbacksClickAjouter", function(){

    var getHtmlFormInputs = function() {
        return "<span style=\"witdh:360px; display:inline-block;text-align:center;" +
            "padding:15px;\">Saisie d'une nouvelle musique</strong>" +
        myApp.gui.getHtmlFormInputs(myApp.metier.musique.createInstance(null),
            "ajouterMusiqueForm") +
        "<label></label><input type=\"submit\" value=\"Valider\"> </input>" +
        "</span>";
    }

    var repaintFormInputs = function(contextArg){
        $("#modifierMusiqueForm").empty();
        $("#ajouterMusiqueForm").empty();

        $("#ajouterMusiqueForm").append(getHtmlFormInputs());
    };

    myApp.gui.mediator.subscribe("musique/saisie", repaintFormInputs);

}()]);