myApp.addModule.apply(myApp.metier.musique, ["createInstance", function (inputObj){
    var musique = {};
    var dataError = false;
    var addError = function (propertyName, message) {
        if(dataError == false){
            dataError = {};
        }
        dataError[propertyName] = message;
    }
    var setPropertyOrError = function (propertyName, value) {
        musique[propertyName] = value;
        for(var i=0; i<this.getPropertyList().length; i++){
            var propertyName = this.getPropertyList()[i];
            setPropertyOrError(propertyName, inputObj[propertyName]);
        }
    }

    var publicInterfaceInstance = {
        getModule:function () {
            return myApp.metier.musique;
        },
        getProperty:function (propertyName) {
            return musique[propertyName];
        },
        hasError: function () {
            if(dataError == false){
                return false;
            }
            for(var propertyName in dataError){
                if(dataError.hasOwnProperty(propertyName)){
                    return true;
                }
            }
            return false;
        },

        getErrorMessage: function (propertyName) {
            return dataError[propertyName];
        },

        getErrorList: function () {
            var errorList = [];
            for(var propertyName in dataError){
                if(dataError.hasOwnProperty(propertyName)){
                    errorList.push(propertyName);
                }
            }
        return errorList;
        }
    };
    return publicInterfaceInstance;
}]);
