
function grab_data(val, targetVisible, targetHidden) {
	//pass data from the main list of fund to what you want to allocate
	var result = [];
	var a = document.getElementById(val.id).value;
	var options = val && val.options;
	var opt;
	var targetCount = 0;
	//var targetField = document.getElementsByName("userselectedfunds");
	var targetField = document.getElementById(targetVisible.id);
	var targetHiddenField = document.getElementById(targetHidden.id);
	for (var i=0, iLen=options.length; i<iLen; i++) {
		opt = options[i];
    	if (opt.selected) {
    		result.push("'" + opt.value + "'" || "'" + opt.text + "'");
    		targetField.options[targetCount] = new Option(opt.text, opt.value, i);
    		targetCount++;
    	}
  	}
  	targetHiddenField.value = result;
  	return result;
}

function clear_data(val, targetVisible, targetHidden) {
	//remove some or all of the items you have selected
	var result = [];
	var a = document.getElementById(val.id).value;
	var options = val && val.options;
	var opt;
	var targetCount = 0;
	var newTargetCount = 0;
	//var targetField = document.getElementsByName("userselectedfunds");
	var targetField = document.getElementById(targetVisible.id);
	var targetHiddenField = document.getElementById(targetHidden.id);
	for (var i=0, iLen=options.length; i<iLen; i++) {	
    	opt = options[i];
    	if (opt.selected) {
    		result.push(opt.value || opt.text);
    		targetField.options[i] = new Option("", "", i-targetCount);
    		targetCount++;
    	}
  	}
  	//Now cycle through the list so we can repopulate the hidden field with what is left
	/*for (var j=0, jLen=options.length; j<jLen; j++) {
		opt = options[j];
    	if (opt.selected) {
    		result.push("'" + opt.value + "'" || "'" + opt.text + "'");
    		targetField.options[newTargetCount] = new Option(opt.text, opt.value, j);
    		newTargetCount++;
    	}
  	}*/
  	//targetHiddenField.value = result;
  	grab_data(val, targetField, targetHiddenField)
  	return result;
}