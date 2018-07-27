// JavaScript Document
// Returns false if the field is empty, null, or has the string "null", and pops up
// the message passed to the function
function isNotNullOrEmptyString(fieldName, message) {
	if (isNullOrEmpty(document.getElementById(fieldName).value)) {	
		alert(message);		
		return false;
	}
	return true;
}

// general purpose function to see if an input value has been
// entered at all or if the input value has a value "null"
function isNullOrEmpty(inputStr) {
	if (isEmpty(inputStr) || inputStr == "null") {
		return true;
	}
	return false;
}

// general purpose function to see if an input value has been
// entered at all
function isEmpty(inputStr) {
	if (inputStr == null || inputStr == "") {
		return true;
	}
	return false;
}

// check whether password fields match
function checkPasswordFields(field1, field2, msg) {
	if (isNullOrEmpty(document.getElementById(field1).value)) {
		document.getElementById(field1).value = "";
		document.getElementById(field2).value = "";
		alert(msg);
		return false;
	} else if (isNullOrEmpty(document.getElementById(field2).value)) {
		document.getElementById(field1).value = "";
		document.getElementById(field2).value = "";
		alert(msg);
		return false;
	} else if (document.getElementById(field1).value != document.getElementById(field2).value) {
		document.getElementById(field1).value = "";
		document.getElementById(field2).value = "";
		alert(msg);
		return false;
	}		
	return true;
}

// check whether password fields match
function setChangedPassword(field1, field2, field3, msg) {	
	if (isNullOrEmpty(document.getElementById(field1).value) && isNullOrEmpty(document.getElementById(field2).value)) {
		return true;
	} else {
		if(checkPasswordFields(field1, field2, msg)) {
			document.getElementById(field3).value = document.getElementById(field1).value;
			return true;
		} else {
			return false;
		  }
	 }
}


// function to ensure that at least one checkbox has been selected
function checkSelection(msg) {
   count = 0;
   for (var i=0; i < document.forms[0].elements.length; i++) {
      if (document.forms[0].elements[i].checked) {
	     count++;
	  }
   }
   if (count == 0) {
      alert(msg);
	  return false;
   }
   return true;
}

// prompts the user whether or not they would like to delete an entity
function deleteEntity(url, entity, name) {
	message = "Are you sure you want to delete " + entity + ": '" + name +"'? \n" + 
					"Press OK to delete the " + entity +"\n" + 
					"Cancel to stay on the current page";
	if (window.confirm(message)) {
		window.location.href=url;
	}
}

// prompts the user whether or not they would like to delete an entity
function confirmAction(url, message) {
	var newmessage = message + "\n" + 
					"Press OK to proceed\n" + 
					"Cancel to stay on the current page";
	if (window.confirm(newmessage)) {
		window.location.href=url;
	}
}

// open a window to display info so that it can be printed
function openPopWindow(width,height,title,type) { 
  if(title == "Financial Report"){
	  var fileName = "../include/popwindow_finance.php?type="+type+"&title="+title;
  } else if(title == "Special Report"){
	  var fileName = "../include/popwindow_special.php?type="+type+"&title="+title;
  } else if(title == "Guard Schedule"){
	  var fileName = "../include/popwindow_schedule.php?type="+type+"&title="+title;
  } else if(title == "Guard Sitrep"){
	  var fileName = "../include/popwindow_sitrep.php?type="+type+"&title="+title;
  } else if(title == "Payslip Report"){
	  var fileName = "../include/popwindow_payslip.php?type="+type+"&title="+title;
  } else {
     var fileName = "../include/popwindow.php?type="+type+"&title="+title;
  }
  // To specify the window characteristics edit the "features" variable below:
  // width - width of the window
  // height - height of the window
  // scrollbar - "yes" for scrollbars, "no" for no scrollbars
  // left - number of pixels from left of screen
  // top - number of pixels from top of screen
  features = "width="+width+",height="+height+",left=100,top=130,resizable=1, scrollbars=1,alwaysRaised=1";
  printwindow = window.open(fileName,"printWin", features);
  printwindow.focus();   
}

// Send information to a div for display
function setDiv(serverPage,object,field,temptxt){
	// If we need to append a value to the searching url, a field value is passed which
	// is added to the url sent to the processing file
	if(field != ""){
		var passedvalue = document.getElementById(field).value;
		serverPage = serverPage + passedvalue + "&field="+field;
		
	}
	//alert("Server Page: "+serverPage);
	showTempText (object, temptxt);
	
	var obj=document.getElementById(object);
	obj.style.visibility="visible";
	obj.style.height = "";
	
	xmlhttp=createObject(); 
	xmlhttp.open("POST", serverPage);
		
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			obj.innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.send(null);	
}

//Function to load another page and also show or hide the div
function showHideSlowLayer(serverPage,object,field,temptxt){
	var obj=document.getElementById(object);
	
	if(obj.style.visibility == "hidden"){
		obj.style.visibility="visible";
		obj.style.height = "";
		setDiv(serverPage,object,field,temptxt);
		
	} else {
		obj.style.visibility="hidden";
		obj.style.height = 0;
	}
}
	
// Show loading text while loading information into a layer
function showTempText (displayArea, text){
	document.getElementById(displayArea).innerHTML = "&nbsp;&nbsp;&nbsp;<span  class=\"label\">"+text+"</span>";
}

//Create http object
function createObject(){
	//Create a boolean variable to check for a valid MS instance.
	var xmlhttp = false;
	
	//Check if we are using IE.
	try {
		//If the javascript version is greater than 5.
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		//If not, then use the older active x object.
		try {
			//If we are using IE.
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			//Else we must be using a non-IE browser.
			xmlhttp = false;
		}
	}
	
	//If we are using a non-IE browser, create a javascript instance of the object.
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

// gets the entered value and passes it to a file specified in a layer
function pickFormItem(fieldName, URLField, objectField){
	// URL to foward value to
	var URL = document.getElementById(URLField).value;
	// The layer where the item is shown
	var object = document.getElementById(objectField).value;
	setDiv(URL,object,fieldName,'Loading...');
}

// gets the entered value and passes it to a file specified in a document
function pickFormItemAndDirect(fieldName, defaultURL, message){
	// The value entered in the form field
	var value = document.getElementById(fieldName).value;
	// The url the page redirects to
	var URL = defaultURL;
	
	if(value != ""){
		if(value == "Client Invoice" || value == "NSSF Returns" || value == "Guard Payroll"){
			URL = "../finance/report.php?f=";
		} else if(value == "Guard Status" || value == "Control Shift" || value == "Guard Schedule"){
			URL = "../operations/report.php?f=";
		}
		
		document.location.href= URL+value;
	} else {
		alert(message);
	}
}


// gets the entered value and passes it to a file specified in a document
function pickFavoriteAndDirect(fieldName, defaultURL, message){
	// The value entered in the form field
	var value = document.getElementById(fieldName).value;
	// The url the page redirects to
	var URL = defaultURL;
	
	if(value != ""){
		document.location.href= URL+value;
	} else {
		alert(message);
	}
	
}

// gets the entered value and passes it to a specified file in a document 
function pickFormItemTypeAndDirect(fieldName, URL, message){
	// The value entered in the form field
	var value = document.getElementById(fieldName).value;
	
	if(value != ""){
		
		var listObj = document.forms[0].type;
		var selectValue = listObj.options[listObj.selectedIndex].value;
		if(selectValue != ""){
			document.location.href = URL+value +"&type="+selectValue;
		} else {
			alert("Please select the type.");
		}
		
	} else {
		alert(message);
	}
	
}

//Function to unite values from two separate selection fields and return the combined value
// With the specified delimitor. If a field is specified, the value is put in the field.
function combineFieldValues(field1, field2, delimitor,valuefield){
	var value1=document.getElementById(field1).value;
	var value2=document.getElementById(field2).value;
	
	//if((value1 != "") && (value2 != "")){
		if(valuefield != ""){
			document.getElementById(valuefield).value = value1+delimitor+value2;
		} else {
			return value1+delimitor+value2;
		}
	//} else {
	//	alert(message);	
	//}
}

// function to show a div when a check box with related information is clicked
function showRelatedInfo(checkbox,relateddiv){
	var obj=document.getElementById(relateddiv);
	
	if(checkbox.checked == true){
		obj.style.visibility="visible";
	} else {
		obj.style.visibility="hidden";
	}
}


//Adding a single textbox
function Addtextbox(name,table){
  var tbl = document.getElementById(table);
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  var cellone = row.insertCell(0);
  cellone.innerHTML = name + ':'; 	
  var cellone = row.insertCell(1);
  var inst = document.createElement('input');
   inst.type = 'text';
  inst.name = name + '[]' + iteration;
  inst.id = name + '[]';
  inst.size = 17;
  cellone.appendChild(inst);
 
}

function Removetextbox(table){
  var tbl = document.getElementById(table);
  var lastRow = tbl.rows.length;
  tbl.deleteRow(lastRow - 1);	
}

// Function to display a value passed from search results
function showSelectedValue(field,value){
	document.getElementById(field).value = value;
}

// Function to set the week's assignments to a given value passed
function setWeekAssignments(field){
	var fields_array = document.getElementsByTagName("input");
	
	for(var i=0; i<fields_array.length; i++){
		if(fields_array[i].id.substr(0,12) == field.id){
			fields_array[i].value = field.value;
		}
	}
}

// Function to determine the week to be displayed on clicking the button
function showNextWeek(field, action, view){
	message = "You will loose all entered data when you change \n" +
			  "the week view. Do you want to continue?\n" + 
			  "Press OK to continue.\n" + 
			  "Cancel to stay on the current page.";
	if(view == ""){
		if (window.confirm(message)){
			showSelectedWeek(field, action, view);
		}
	} else {
		showSelectedWeek(field, action, view);
	}
}

// Function to show selected week
function showSelectedWeek(field, action, view){
	var currentvalue = document.getElementById(field).value;
	var sign = currentvalue.substr(0,1);
	var finalvalue = "";
	var number = new Number(currentvalue.substr(2,currentvalue.length));
	
	if(sign == "a" && action == "a"){
		number = number  + 1;
		finalvalue = "a "+number;
	
	} else if(sign == "a" && action == "s"){
		if(number > 0){
			number = number - 1;
			finalvalue = "a "+number;
		} else {
			number = 1;
			finalvalue = "s "+number;
		}
	
	} else if(sign == "s" && action == "a"){
		if(number > 0){
			number = number - 1;
			finalvalue = "s "+number;
		} else {
			number = 1;
			finalvalue = "a "+number;
		}
		
	} else if(sign == "s" && action == "s"){
		if(number > 0){
			number = number + 1;
			finalvalue = "s "+number;
		} else {
			number = 1;
			finalvalue = "s "+number;
		}
	}
	
	document.getElementById(field).value = finalvalue;
	if(view == ""){
		document.location.href= "../operations/?cw="+finalvalue;
	} else {
		document.location.href= "../operations/?cw="+finalvalue+"&a="+view;
	}
}

// Show a layer with height
function showRelatedInfoWithHeight(checkbox,relateddiv){
	var obj=document.getElementById(relateddiv);
	
	if(checkbox.checked == true){
		obj.style.visibility="visible";
		obj.style.height = "";
	} else {
		obj.style.visibility="hidden";
		obj.style.height = 0;
	}
}

// Show a layer with height on click and hide on clicking again
function showHideLayer(layerdiv){
	var obj=document.getElementById(layerdiv);
	
	if(obj.style.visibility == "hidden"){
		obj.style.visibility="visible";
		obj.style.height = "";
	} else {
		obj.style.visibility="hidden";
		obj.style.height = 0;
	}
}

// Add to a list of items that is passed to a list of items saved in a hidden field
function addValueToCheckList(checkbox,value,hiddenfield){
	var valuelist = document.getElementById(hiddenfield).value;
	
	// The checkbox is checked
	if(checkbox.checked == true){
		if(valuelist == ""){
			valuelist = value;
		} else if(!inString(valuelist,value)){
			valuelist = ","+value;
		}
	
	// The check box is not checked
	} else {
		if(inString(valuelist,value)){
			removeValue(valuelist,value);
		}
	}
}

// Function to determine whether the value is in the string
function inString(valuelist,value){
	var valuearray = valuelist.split(",");
}

//Function to update drop downs based on the selected value of the drop down
function changeTimeDropDowns(dropdown){
	setDiv('../include/showlist.php?area=time&t=start&value=','starttime_show','servicetype','Loading...'); 
	alert("Setting start and end times for the assignment.");
	setDiv('../include/showlist.php?area=time&t=end&value=','endtime_show','servicetype','Loading...');	
	
}

//Function to update drop downs based on the selected value of the drop down
function changeItemCategoryDropDowns(dropdown){
	setDiv('../include/showlist.php?area=category&value=','itemtype_show','itemcategory','Loading...'); 
	alert("Setting Item Type for selected category.");

}

//Function to deselect a passed option
function uncheckOption(checkbox){
	document.getElementById(checkbox).checked = false;	
}

//Function to select all checkboxes
function selectAllBoxes(checkextension,formname){
	var formwithboxes = document.getElementById(formname);
	
	for(var i=0;i<formwithboxes.elements.length; i++){
		var itemstr = formwithboxes.elements[i].id;
		if(itemstr.substring(0,checkextension.length) == checkextension){
			formwithboxes.elements[i].checked = true;
			document.getElementById('checkthis2').value="1";
			
		}
	}	
}

function checkhidden(){
var field= document.getElementsByName('check');
for(var x=0; x <field.length; x++){
	if(field[x].value){
		return true;
	}	
}
alert("At least one field must be checked");
return false;
}