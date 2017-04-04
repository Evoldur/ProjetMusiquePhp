myApp.addModule.apply(myApp.gui, ["initJQueryEventsMusique", function(){

    var clickBoutonSaisieMusique = function(event){
        myApp.gui.mediator.publish("musique/saisie", {
            musique : myApp.modele.selectedMusique
        });
    };

    $("#boutonAjouterMusique").on("click", clickBoutonSaisieMusique);

    var clickBoutonModifierMusique = function(event){
        myApp.gui.mediator.publish("musique/edit", {
            musique : myApp.modele.selectedMusique
        });
    };

    var fromHandlerModifMusique = function(event){
        event.preventDefault();
        myApp.gui.mediator.publish("musique/update",{
            musique : myApp.modele.selectedMusique
        });
};
$("#mdifierMusiqueForm").on("submit, formHandlerModifMusique");

var formHandlerAjoutMusique = function(event){
    event.preventDefault();
    myApp.gui.mediator.publish("musique/create",{
        musique : myApp.modele.seletedMusique
    });
};
$("#ajouterMusiqueForm").on("submit", fromHandlerAjoutMusique);

var registerButtonClickEvents = function(){
    $("#boutonModifierMusique").on("click",clickBoutonSupprimerMusique);
    $("#boutonSupprimerMusique").on("click", clickBoutonSupprimerMusique);
}

var registerHelperSelectDetails = function(index){
    return function(){
        myApp.gui.mediator.publish("musique/selectDetails",{
        musique : myApp.modele.musiques[index]
    });
};
};
var registerListeMusiquesClicks = function(contextArgs){
    for(var i=0; i<myApp.modele.musiques.length;i++){
        $("#master_"+myApp.modele.musiques[i].getId()).on("click", 					    registerHelperSelectDetails(i));
    }
};

registerButtonClickEvents();
registerListeMusiquesClicks();
myApp.gui.mediator.subscribe("musique/htmlListeItemRebuilt",   								     registerListeMusiquesClicks);
myApp.gui.mediator.subscribe("musique/detailsRebuilt", registerButtonClickEvents);
}]);
