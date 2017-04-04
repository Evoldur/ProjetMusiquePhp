myApp.addModule.apply(myApp, ["gui", {}]);

myApp.addModule.apply(myApp.gui, ["getInputId", function(inputSpec){
    return inputSpec.formId  + "_" + inputSpec.propertyName;
}]);

myApp.addModule.apply(myApp.gui, ["publishInputChange", function(formId, propertyName){
    myApp.ctrl.mediatorInputFilter.publish(formId, propertyName);
}]);

myApp.addModule.apply(myApp.gui, ["getInputCode", function(inputSpec){
    var inputId = myApp.gui.getInputId(inputSpec);
    var propertyValue = inputSpec.objetMetier.getProperty(inputSpec.propertyName)||"";
    var errorMessage = inputSpec.objetMetier.getErrorMessage(inputSpec.propertyName)!= undefined ? InputSpec.objetMetier.getErrorMessage(inputSpec.propertyName) + 	"<br/>" : "";

    myApp.ctrl.mediatorInputFilter.subscribe(inputSpec.formId, inputSpec.propertyName, function() {
        var resultatTestRegex = inputSpec.objetMetier.testRegex(inputSpec.propertyName,
            document.getElementById(inputId).value);
        if(resultatTestRegex !== true){
            document.getElementById("error_"+inputId).innerHTML = resultatTestRegex +"<br/>";
        }
        else{
            document.getElementById("error_"+inputId).innerHTML = "";
        }
    });

    var inputType = inputSpec.inputType==undefined ? "text":inputSpec.inputType;
    var inputSize = inputSpec.inputSize==undefined ? "10":inputSpec.inputSize;
    var labelText = inputSpec.objetMetier.getLabelText(inputSpec.propertyName);

    return "<span class=\"error_"+inputId+"\">+errorMessage+</span>"
        +  "<label for=\""+inputSpec.propertyName+"\">" + labelText+ "</label>"
        +  "<input type=\"" + inputType +"\" name=\"" + inputSpec.PropertyName +
	"\" id=\"" + inputId + "\" " + " value=\"" + propertyValue + "\" " +
	" size=\"" + inputSize + "\" " +
	" onchange=\"myApp.gui.publishInputChange('" + inputSpec.formId + "' , '"
     + inputSpec.propertyName + "') \" "+ "/>" ;
}]);

myApp.addModule.apply(myApp.gui,["getHtmlFormInputs", function(objetMetier,formId){

    var metierCommonInstanceMethods = new Interface (
        [ "getPropertyList" , "getLabelText" , "testRegex" , "getProperty" ,
          "setProperty" , "hasError" , "getErrorMessage" , "getErrorList"]);
    var testInterface = metierCommonInstanceMethods.isImplementedBy(objetMetier);
    var message ;
    if ( testInterface != true ) {
        throw new Error (testInterface);
    }
    myApp.ctrl.mediatorInputFilter.addForm(formId);
    var htmlCode = "" ;
    var propertyList = objetMetier.getPropertyList() ;

    for (var i=0 ; i < propertyList.length ; i++){
        var propertyName = propertyList[i] ;

        if ( propertyName != "id" ) {
            htmlCode += myApp.gui.getInputCode ({
                    objetMetier : objetMetier ,
                    propertyName : propertyList[i] ,
                    labelText : objetMetier.getLabelText(propertyList[i]),
                    formId : formId
                }) + "" ;
        }
    }

    htmlCode += "<input type=\"hidden\" id=\"" + formId + "_id\" value=\"" +
        objetMetier.getProperty("id") + "\"/>" ;
    return htmlCode;
}]);