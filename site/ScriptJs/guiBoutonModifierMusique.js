myApp.addModule.apply(myApp.gui,["callbacksClickModifierMusique", function(){

    var getHtmlFormInputs = function(){
        return "<span style=\"width:360px; display:inline-block; vertical-align:top;\">"
        + myApp.gui.getHtmlFormInputs(myApp.modele.selectedMusique,"modifierMusiqueForm")
        + "<label></label>"
        + "<input type=\"submit\" value=\"Valider\"/>"
        + "</span>";
    }

    var repaintFormInputs = function(contextArg){
        $("#modifierMusiqueForm").empty();
        $("#ajouterMusiqueForm").empty();

        $("#modifierMusiqueForm").append(getHtmlFormInputs());
    };

    myApp.gui.mediator.subscribe("musique/edit", repaintFormInputs);
}()]);