myApp.addModule.apply(myApp.gui,["callbacksValidateModifierForm", function(){

    var updateModel = function(){

        var propertyName, inputId;
        for (var j=0; j<myApp.metier.musique.getPropertyList().length;++j){
            propertyName = myApp.metier.musique.getPropertyList()[j];
            if (propertyName != "id"){
                inputId = myApp.gui.getInputId({
                    propertyName : propertyName,
                    formId : "modifierMusiqueForm"
                });
                myApp.modele.selectedMusique.setProperty(propertyName,document.getElementById(inputId).value);
            }
        }
        myApp.gui.mediator.publish("musique/changed", {
            musique : null
        });
    };
}()]);