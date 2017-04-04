myApp.addModule.apply(myApp.metier, ["musique", function() {

        var propertiesPatern = {
            id: {labelText: "identifiant"},
            nom: {labelText: "nom musique"},
            couvertureAlbum: {labelText: "couverture d'album"}
        }
        var propertyList = function () {
            var list = [];
            for (var propertyName in propertiesPatern) {
                if (propertiesPatern.hasOwnProperty(propertyName)) {
                    list.push(propertyName);
                }
            }
            return list;
        }();
        var publicInterfaceMusique = {
            getPropertyList: function () {
                return propertyList;
            },
            getLabelText: function (propertyName) {
                return propertiesPatern[propertyName].labelText;
            },
            getId: function () {
                return propertyList[0];
            },
            getNom: function () {
                return propertyList[1];
            }

        };


        return publicInterfaceMusique;
    }()]
);






/*
class Musique{
    constructor(id, nomMusique, couvertureAlbum){
        this.id = id;
        this.nomMusique = nomMusique;
        this.couvertureAlbum = couvertureAlbum;
    }
}
*/