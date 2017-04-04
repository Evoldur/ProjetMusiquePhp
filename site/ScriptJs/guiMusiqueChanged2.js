myApp.addModule.apply(myApp.gui, ["callbacksMainListUpdate", function(){

    var setHighlighted = function(musique, highlighted){
        if(highlighted){
            $("#master_"+ musique.getId()).css("background-color", "#333")
                .css("color", "#eee")
                .css("border-radius", "4px")
                .css("padding", "2px");
        }
        else{
            $("#master_"+ musique.getId()).css("background-color", "#eee")
                .css("color", "#333")
                .css("border-radius", "4px")
                .css("padding", "2px");
        }
    }

    var getHtmlCodeListeMusiques = function(){
        var htmlCode = "";
        for(musique in myApp.modele.musiques){
            htmlCode +="<p id=\"master_"+musique.getId()
                + "\">"
                + "<strong> nom </strong>" + musique.getNom()
                + "</p>";
        }
        return htmlCode;
    };

    var repaintVue = function(contextArg){
        $("#listeMusiques").empty();
        $("#listeMusiques").html(getHtmlCodeListeMusiques());
        for(var i=0; i< myApp.modele.musiques.length; ++i){
            setHighlighted(myApp.modele.musiques[i],false);
        }
        setHighlighted(myApp.modele.selectedMusique, true);
        myApp.gui.mediator.publish("musique/htmlListeItemRebuilt");
    };

    var selectMusique = function(contextArg){
        setHighlighted(myApp.modele.selectedMusique, false);
        myApp.modele.selectedMusique = contextArg.musique;
        setHighlighted(myApp.modele.selectedMusique, true);
        myApp.gui.mediator.publish("musique/detailsChanged",{
            musique : myApp.modele.selectedMusique
        });
    };

    var selectMusiqueAnRepaint = function(contextArg){
        selectMusique(contextArg);
        repaintVue();
    }

    myApp.gui.mediator.subscribe("musique/changed", repaintVue);
    myApp.gui.mediator.subscribe("musique/created", selectMusiqueAnRepaint);
    myApp.gui.mediator.subscribe("musique/selectDetails", selectMusique);
}()]);
