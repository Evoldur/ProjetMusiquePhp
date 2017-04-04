myApp.addModule.apply(myApp.gui,["callbacksValidateAjouterForm",function(){

    var updateModel = function(){
        var propertyName, inputId;

        var nouvelleMusique = myApp.metier.perosnne.createInstance(null);
        myApp.modele.personnes.push(nouvelleMusique);

        for (var j=0; j< myApp.metier.personne.getPropertyList().length; ++j){
            propertyName = myApp.metier.personne.getPropertyList()[j];
            if(propertyName != "id"){
                inputId = myApp.gui.getInputId({
                    propertyName: propertyName,
                    formId: "ajouterMusiqueForm"
                });
                nouvelleMusique.setProperty(propertyName,
                    document.getElementById(inputId).value
                );
            }
        }
        myApp.gui.mediator.subscribe("musique/created", {
                                        musique: nouvelleMusique
                                    });
    };
    myApp.gui.mediator.subscribe("musique/create", updateModel);
    }()]);