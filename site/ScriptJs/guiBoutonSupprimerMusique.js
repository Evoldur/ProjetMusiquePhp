myApp.addModule.apply(myApp.gui, ["callbaksClickSupprimer", function(){

    var deleteMusique = function(contextArg){
        var indexSelectedMusique = myApp.modele.musiques.indexOf(contextArg.musique);
        myApp.modele.musiques.splice(indexSelectedMusique, 1);
        myApp.modele.selectedMusique = myApp.modele.musiques[0];
        myApp.gui.mediator.publish("musique/changed", {
            musique : myApp.modele.selectedMusique
        });
    }
    myApp.gui.mediator.subscribe("musique/delete", deleteMusique);
}()]);