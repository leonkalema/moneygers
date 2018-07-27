// JavaScript Document

//Funciton to add a child
function addRowToChildTable(){
	var tbl = document.getElementById('childtable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = lastRow+".";
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('childfname',  iteration));
	
  	// Create and populate third cell
	var rowone = row.insertCell(2);
  	rowone.appendChild(generateTextField('childlname',  iteration));
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
  	rowone.appendChild(generateTextField('childoname',  iteration));
	
	// Create and populate fifth cell
	var rowone = row.insertCell(4);
	rowone.appendChild(generateGenderDropDown('childgender',iteration)); 
		
	// Create and populate sixth cell
	var rowone = row.insertCell(5);
  	var ele = document.createElement('input');
  	ele.type = 'text';
  	ele.name = 'childage[]';
  	ele.id = 'childage[]' + iteration;
	ele.size = 4;
	rowone.appendChild(ele); 

}
//Function to add assigned guards
function addRowToGuardTable(){
	var tbl = document.getElementById('guardtable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Assigned Guard ("+(iteration + 1)+"):";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('assignedguards',  iteration));
}

// Function to add a row to the action table
function addRowToIncidentActionTable(){
	var tbl = document.getElementById('incidentactiontable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Action ("+(iteration + 1)+"):";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
	var ele = document.createElement('textarea');
  	ele.rows = '3';
  	ele.name = 'action[]';
  	ele.id = 'action[]' + iteration;
	rowone.appendChild(ele);
}

//Funciton to add a school where the guard studied
function addRowToSchoolTable(schooltable){
	if(schooltable == "primaryschooltable"){
		var prefix = "primary";
	
	} else if(schooltable == "secondaryschooltable"){
		var prefix = "secondary";
	} else if(schooltable == "qualschooltable"){
		var prefix = "qual";
	}
	
	
	var tbl = document.getElementById(schooltable);
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = lastRow+".";
  
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField(prefix+'schname',  iteration));
	
	if(prefix != "qual"){
		// Create and populate third cell
		var rowone = row.insertCell(2);
		rowone.appendChild(generateYrDropDown(prefix+'schstart',iteration)); 
	} 
	
	// Create and populate fourth cell for other schools or third cell if entering qualifications
	if(prefix != "qual"){
		var rowone = row.insertCell(3);
	} else {
		var rowone = row.insertCell(2);
	}
	
	rowone.appendChild(generateYrDropDown(prefix+'schend',iteration));

}

//Funciton to add a document to guard
function addRowToGuarddocumentsTable(guarddoctable){
	if(guarddoctable == "guarddocumentstable"){
		var prefix = "primary";
	} 
	
	
	var tbl = document.getElementById(guarddoctable);
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = (lastRow-1)+".";
  
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('documentname',  iteration));
	
	// Create and populate third cell
   	var rowone = row.insertCell(2);
  	rowone.appendChild(generateTextField('referencenumber',  iteration));

}


// Function to add a new previous employer
function addPrevEmployer(){
	var tbl = document.getElementById('prevemployerstable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
   	var rowone = row.insertCell(0);
	rowone.innerHTML = "Name:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
	var rowone = row.insertCell(1);
	rowone.appendChild(generateTextField('employername',  iteration));
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.innerHTML = "Employment Date:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.innerHTML = "From: ";
	rowone.appendChild(generateYrDropDown('startemployment',iteration));
	
	//Add second drop down
	rowone.innerHTML += "To: ";
	rowone.appendChild(generateYrDropDown('endemployment',iteration));
	
	// Insert a second row  and repeat the process for the next row
	var row2 = tbl.insertRow(lastRow+1);
	
	var rowtwo = row2.insertCell(0);
	rowtwo.innerHTML = "Telephone: ";
  	rowtwo.className = "label";
	rowtwo.align = "right";
	
	var rowtwo = row2.insertCell(1);
	rowtwo.appendChild(generateTextField('employertel',  iteration));
	
	var rowtwo = row2.insertCell(2);
	rowtwo.innerHTML = "&nbsp;";
	var rowtwo = row2.insertCell(3);
	rowtwo.innerHTML = "&nbsp;";
	
	// Insert a third row  and repeat the process for the next row
	var row3 = tbl.insertRow(lastRow+2);
	
	var rowthree = row3.insertCell(0);
	rowthree.innerHTML = "Physical Address: ";
  	rowthree.className = "label";
	rowthree.align = "right";
	
	var rowthree = row3.insertCell(1);
	//rowthree.innerHTML = "cell2";
	var ele = document.createElement('textarea');
  	ele.rows = '3';
  	ele.name = 'employerphysicaladd[]';
  	ele.id = 'employerphysicaladd[]' + iteration;
	rowthree.appendChild(ele);
	
	var rowthree = row3.insertCell(2);
	rowthree.innerHTML = "&nbsp;";
	var rowthree = row3.insertCell(3);
	rowthree.innerHTML = "&nbsp;";
		
	// Insert a forth row  and repeat the process for the next row
	var row4 = tbl.insertRow(lastRow+3);
	
	var rowfour = row4.insertCell(0);
	rowfour.innerHTML = "Previous Position: ";
  	rowfour.className = "label";
	rowfour.align = "right";
	
	var rowfour = row4.insertCell(1);
	rowfour.appendChild(generateTextField('position',  iteration));
	
	var rowfour = row4.insertCell(2);
	rowfour.innerHTML = "&nbsp;";
	var rowfour = row4.insertCell(3);
	rowfour.innerHTML = "&nbsp;";
}


// Function to add a new row to vehicle log
function addRowToVehicleLogTable(){
	var tbl = document.getElementById('vehiclelog');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
   	var rowone = row.insertCell(0);

	rowone.innerHTML = (lastRow-3)+".";
	
	// Create and populate second cell
	var rowone = row.insertCell(1);
	rowone.appendChild(generateTextFieldWithSize('timeout',  iteration, 5, 5));
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.appendChild(generateTextFieldWithSize('timein',  iteration, 5, 5));
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.appendChild(generateTextFieldWithSize('placefrom',  iteration, 8, ''));
	
	// Create and populate fifth cell
	var rowone = row.insertCell(4);
	rowone.appendChild(generateTextFieldWithSize('placeto',  iteration, 8, ''));
	
	// Create and populate sixth cell
	var rowone = row.insertCell(5);
	rowone.appendChild(generateTextFieldWithSize('odometerstart',  iteration, 8, ''));
	
	// Create and populate seventh cell
	var rowone = row.insertCell(6);
	rowone.appendChild(generateTextFieldWithSize('odometerend',  iteration, 8, ''));
	
	// Create and populate eight cell
	var rowone = row.insertCell(7);
	// Hide this cell because we do not want users to enter anything in it
	//rowone.appendChild(generateTextFieldWithSize('kmtravelled',  iteration, 4, ''));
	
	// Create and populate nineth cell
	var rowone = row.insertCell(8);
	rowone.appendChild(generateTextFieldWithSize('reason',  iteration, 15, ''));
	
	// Create and populate the hidden cell to hold the record id
	var rowone = row.insertCell(9);
	//rowone.appendChild(generateHiddenTextField('recordid',  iteration));
	
}


//Add a guard refeeree to the referee table
function addGuardReferee(){
	var tbl = document.getElementById('guardrefereetable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
   	var rowone = row.insertCell(0);
	rowone.innerHTML = "Name:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
	var rowone = row.insertCell(1);
	rowone.appendChild(generateTextField('refereename',  iteration));
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.innerHTML = "Telephone:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.appendChild(generateTextField('refereetel',  iteration));
	
	// Insert a second row  and repeat the process for the next row
	var row2 = tbl.insertRow(lastRow+1);
	
	var rowtwo = row2.insertCell(0);
	rowtwo.innerHTML = "Physical Address: ";
  	rowtwo.className = "label";
	rowtwo.align = "right";
	
	var rowtwo = row2.insertCell(1);
	var ele = document.createElement('textarea');
  	ele.rows = '3';
  	ele.name = 'refereephysicaladd[]';
  	ele.id = 'refereephysicaladd[]' + iteration;
	rowtwo.appendChild(ele);
	
	var rowtwo = row2.insertCell(2);
	rowtwo.innerHTML = "&nbsp;";
	var rowtwo = row2.insertCell(3);
	rowtwo.innerHTML = "&nbsp;";
}

//Function to add Guards responsible
function addRowToGuardResponsibleTable(){
	var tbl = document.getElementById('guardresponsibletable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Guard Responsible:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('responsibleguards',  iteration));
	
  	}
	
// Function to create new drop downs for years from current year downwards
function generateYrDropDown(comboname,iteration){
	var passed_combo = comboname;
	if(comboname.substr(comboname.lastIndexOf("_")) == '_F'){
		comboname = comboname.substr(0,comboname.lastIndexOf("_"));
	}
	
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var count = 1;
	var d = new Date();
	var currentyr = d.getFullYear();
	//Depending on the passed comboname, show different values of the years
	if(passed_combo.substr(passed_combo.lastIndexOf("_")) == '_F'){
		var lastyr = currentyr + 100;
		for(var i=currentyr; i<lastyr;i++){
     		sel.options[count] = new Option(i,i);
	 		count++;
  		}
	} else {
		var lastyr = currentyr - 100;
		for(var i=currentyr; i>lastyr;i--){
     		sel.options[count] = new Option(i,i);
	 		count++;
  		}
	}
	return sel;
}

// Function to create a drop down for the gender of the person
function generateGenderDropDown(comboname,iteration){
	var gender = document.createElement('select');
  	gender.name = comboname+'[]';
  	gender.id = comboname+'[]' + iteration;
  	gender.options[0] = new Option('<Select>','');
  	gender.options[1] = new Option('Male','M');
	gender.options[2] = new Option('Female','F');
	
	return gender;
}

// Function to generate a text field
function generateTextField(fieldname,  iteration){
	var ele = document.createElement('input');
  	ele.type = 'text';
  	ele.name = fieldname+'[]';
  	ele.id = fieldname+'[]' + iteration;
	
	return ele;
}

// Function to generate a text field with size
function generateTextFieldWithSize(fieldname,  iteration, width, fieldlength){
	var ele = document.createElement('input');
  	ele.type = 'text';
  	ele.name = fieldname+'[]';
  	ele.id = fieldname+'[]' + iteration;
  	ele.size = width;
	ele.maxlength = fieldlength;
	
	return ele;
}

// Function to generate a hidden field
function generateHiddenTextField(fieldname,  iteration){
	var ele = document.createElement('input');
  	ele.type = 'hidden';
  	ele.name = fieldname+'[]';
  	ele.id = fieldname+'[]' + iteration;
	
	return ele;
}

// Function to remove more than one rows from a table whose id is passed
function removeMultRows(tablename,noofrows){
	var tbl = document.getElementById(tablename);
	var lastRow = tbl.rows.length;
  	
	// Check whether there are any more rows in the table before you delete.
	if (lastRow >= 1) {
		for(var i=0; i<noofrows; i++){
			
			if(noofrows > i){
				tbl.deleteRow(lastRow - (i+1));
			}
		}
	}
}

//Remove last row from table
function removeRow(tablename){
  var tbl = document.getElementById(tablename);
  
  var lastRow = tbl.rows.length;
  if (lastRow >= 1) tbl.deleteRow(lastRow - 1);
  
}

// Function to create new drop downs for days
function generateDayDropDown(comboname,iteration){
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var dayarrayvalues  = new Array('01', '02' , '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
	var dayarrayshown  = new Array('01', '02' , '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
	for(var i=1; i<=dayarrayvalues.length;i++){
     	sel.options[i] = new Option(dayarrayshown[(i-1)],dayarrayvalues[(i-1)]);
  	}
	return sel;
}

//Function to generate time dropdown
function generateTimeDropDown(comboname,iteration){
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var timearrayvalues  = new Array('00:30:00', '01:00:00' , '01:30:00', '02:00:00', '02:30:00', '03:00:00', '03:30:00', '04:00:00', '04:30:00', '05:00:00', '05:30:00', '06:00:00', '06:30:00', '07:00:00', '07:30:00', '08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00', '12:00:00', '12:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00', '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00', '19:30:00', '20:00:00', '20:30:00', '21:00:00', '21:30:00', '22:00:00', '22:30:00', '23:00:00', '23:30:00' );
	var timearrayshown  = new Array('00:30', '01:00' , '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30' );
	for(var i=1; i<=timearrayvalues.length;i++){
     	sel.options[i] = new Option(timearrayshown[(i-1)],timearrayvalues[(i-1)]);
  	}
	return sel;
}

// Function to create new drop downs for months
function generateMonthDropDown(comboname,iteration){
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var montharrayvalues  = new Array('January', 'February' , 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
	var montharrayshown  = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	for(var i=1; i<=montharrayvalues.length;i++){
     	sel.options[i] = new Option(montharrayshown[(i-1)],montharrayvalues[(i-1)]);
  	}
	return sel;
}

// Function to create new drop downs for days
function generateDayDropDown(comboname,iteration){
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var dayarrayvalues  = new Array('01', '02' , '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
	var dayarrayshown  = new Array('01', '02' , '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
	for(var i=1; i<=dayarrayvalues.length;i++){
     	sel.options[i] = new Option(dayarrayshown[(i-1)],dayarrayvalues[(i-1)]);
  	}
	return sel;
}

//Add exception to assignment table
function addRowToExceptionTable(){
	var tbl = document.getElementById('exceptiontable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
	var rowone = row.insertCell(0);
	rowone.innerHTML = "Exception (when<br>services aren't<br> needed):";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
	rowone.innerHTML = "Day: ";
	rowone.appendChild(generateDayDropDown('exception_day',iteration));
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.innerHTML = "Month: ";
	rowone.appendChild(generateMonthDropDown('exception_month',iteration));
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.innerHTML = "Year: ";
	rowone.appendChild(generateYrDropDown('exception_year_F',iteration));
	
}

//Function to add guards in the guard response form
function addRowToResponseTable(tablename, fieldname){
	var tbl = document.getElementById(tablename);
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Guard:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField(fieldname,  iteration));
	
}
	//Function to add commanders in the guard response form
function addRowToCommanderTable(){
	var tbl = document.getElementById('commandertable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Commander:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('commander',  iteration));
	
  	}
	
	//Function to add mobile in the guard response form
function addRowToMobileTable(){
	var tbl = document.getElementById('mobiletable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Mobile:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('mobile',  iteration));
	
  	}
	
	//Function to add mobile in the guard response form
function addRowToLocationTable(){
	var tbl = document.getElementById('locationtable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Location:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('location',  iteration));
	
  	}

//Function to add row to checked by table
function addRowToCheckedByTable(){
	var tbl = document.getElementById('checkedbytable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
   	var rowone = row.insertCell(0);
	rowone.innerHTML = "Checked By:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
	var rowone = row.insertCell(1);
	rowone.appendChild(generateTextField('checkedby',  iteration));
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.innerHTML = "Time:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.appendChild(generateTimeDropDown('timechecked',  iteration));
}
//Function to add row to action taken table
function addRowToActionTable(){
	var tbl = document.getElementById('actiontable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  
  	// Create and populate first cell
   	var rowone = row.insertCell(0);
	rowone.innerHTML = "Action Taken:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
	
	var rowone = row.insertCell(1);
	var ele = document.createElement('textarea');
  	ele.rows = '5';
  	ele.name = 'actiontaken[]';
  	ele.id = 'actiontaken[]' + iteration;
	rowone.appendChild(ele);
	
	// Create and populate third cell
	var rowone = row.insertCell(2);
	rowone.innerHTML = "Time:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate fourth cell
	var rowone = row.insertCell(3);
	rowone.appendChild(generateTimeDropDown('timeactiontaken',  iteration));
}
//Function to add Guards responsible
function addRowToGuardResponsibleTable(){
	var tbl = document.getElementById('guardresponsibletable');
	var lastRow = tbl.rows.length;
  	// if there's no header row in the table, then iteration = lastRow + 1
  	var iteration = lastRow;
 	//Create row
	var row = tbl.insertRow(lastRow);
  	
	// Create and populate first cell
  	var rowone = row.insertCell(0);
	rowone.innerHTML = "Guard Responsible:";
  	rowone.className = "label";
	rowone.align = "right";
	
	// Create and populate second cell
   	var rowone = row.insertCell(1);
  	rowone.appendChild(generateTextField('responsibleguards',  iteration));
	
  	}