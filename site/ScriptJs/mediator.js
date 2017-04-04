myApp.addModule.apply(myApp.gui, ["mediator", function(){
    var m_subscriptionLists;

    var init = function(){
        m_subscriptionLists = {
            "musique/read":[],
            "musique/update":[],
            "musique/create":[],
            "musique/delete":[],
            "musique/selectDetails":[],
            "musique/edit":[],
            "musique/saisie":[],
            "musique/changed":[],
            "musique/created":[],
            "musique/detailsChanged":[],
            "musique/htmlListeItemRebuilt":[],
            "musique/detailsRebuilt":[]
        };
    };

    init();

    var publicInterfaceMediator = {

        subscribe : function(eventCateg, callbackFunction){
            if(m_subscriptionLists.hasOwnProperty(eventCateg)){
                m_subscriptionLists[eventCateg].push({callback : callbackFunction});
            }
            else{
                throw new Error("Catégorie d'événements "+eventCateg+" inconnue 				du médiateur");
            }
        },

        publish : function(eventCateg, contextArg){
            var i;
            if (m_subscriptionLists.hasOwnProperty(eventCateg)){
                for (i=0; i<m_subscriptionLists[eventCateg].length; i++){
                    m_subscriptionLists[eventCateg][i].callback(contextArg);
                }
            }
            else{
                throw new Error("Catégorie d'événements "+eventCateg+" inconnue 				du médiateur");
            }
        },

        empty : function(){
            init();
        }
    };
    return publicInterfaceMediator;
}()]);