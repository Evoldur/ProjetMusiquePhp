myApp.addModule.apply(myApp,["modele", {
    selectedMusique : null,
    musiques : []
}]);
myApp.modele.musiques.push(myApp.metier.musique.createInstance({id : "0",
    nomMusique : "The Poet and The Muse",
    couvertureAlbum : "Pas de couverture"
    //A voir ce qu'il manque
}));

myApp.addModule.apply(myApp.metier.musique, ["getteurId", function (musique) {
    var publicGetter = function (musique) {
            return musique.getProperty(musique);
        }
    }
])
