var Interface = function ( methods ) {

    if ( methods.length == undefined ) {
        throw {
            name : " IllegalArgument ",
            message : "Une interface nécessite un array ( ou array−like ) de noms de méthodes ."
        };
    }

    this.methods = [];

    for(var i = 0; i<methods.length; i++){
        if(typeof methods[i] != 'string'){
            throw {
                name : "IllegalArgument",
                message : "Les noms de méthodes d ’une interface doivent être de type string. "
            };
        }
        this.methods.push(methods[i]);
    }
};

Interface.prototype.isImplementedBy = function(objet){
    for(var i=0; i<this.methods.length ; i++){
        var methodName = this.methods[i];
        if(!objet[methodName] || typeof objet[methodName] !== 'function'){
            return "L’objet n’implémente pas la méthode " + methodName ;
        }
    }
    return true;
};
