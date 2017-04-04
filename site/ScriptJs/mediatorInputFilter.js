var myApp = {
    addModule : function(moduleName, moduleObject){
        if(typeof moduleName == "string" && /^[a-z]{1,}[a-z0-9\_]*$/i.test(moduleName)){
            this[moduleName] = moduleObject;
        }
        else{
            throw{
                name : "IllegalArgumentException",
                messsage : "Impossible d'ouvrir le module : nom" + moduleName + "illégal"
            };
        }
    },

    init : function(spec){
        for(propertyName in spec){
            if (spec.hasOwnProperty(propertyName)){
                this.addModule(propertyName, spec[propertyName]);
            }
        }
    }
};

myApp.init({
    metier : {}
});

myApp.addModule.apply(myApp, ["ctrl",{}]);

myApp.addModule.apply(myApp.ctrl,["mediatorInputFilter",function(){
	var m_subscriptionlists;
	
	var init = function(){
		m_subscriptionLists = {};
	};
	
	init();
	
	var publicInterfaceMediator =  {
		addForm : function(formId){
			m_subscriptionLists[formId] = {}
		},
		
		removeForm : function(formId){
			if(!m_subscriptionLists.hasOwnProperty(formId)){
				return false;
			}
			delete m_subscriptionLists[formId];
			return true;
		},
		
		subscribe : function(formId,inputName,callbackFunction){
			if(m_subscriptionLists.hasOwnProperty(formId)){
				m_subscriptionLists[formId][inputName] = {callback : callbackFunction};
			}else{
				throw { name : "illlegalArgumentException ",
					message : "Catgorie d'événement " + eventCateg + " inconnue du médiateur"
				};
			}
		},
		
		publish : function(formId,inputName){
			if(m_subscriptionLists.hasOwnProperty(formId)){
				if(m_subscriptionLists[formId].hasOwnProperty(inputName)){
					m_subscriptionLists[formId][inputName].callback();
				}
			}else{
				throw { name : "IllegalArgumentException",
					message : "Formulaire d'ID " + formId + " inconnu du médiateur"
				};
			}
		},
		
		empty : function(){
			init();
		}
	};	
	
	return publicInterfaceMediator;
}()]);
