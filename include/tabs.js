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


// Function to create new drop downs for years from current year downwards
function generateYrDropDown(comboname,iteration){
	var sel = document.createElement('select');
  	sel.name = comboname+'[]';
  	sel.id = comboname+'[]' + iteration;
  	sel.options[0] = new Option('<Select>','');
	//Populate the select field
	var count = 1;
	var d = new Date();
	var currentyr = d.getFullYear();
	var lastyr = currentyr - 100;
	for(var i=currentyr; i>lastyr;i--){
     	sel.options[count] = new Option(i,i);
	 	count++;
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
