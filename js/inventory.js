//add an event listiner to the select tag
//the tag lets you select a classification
let classifcationId = "";
let selectClassification = document.getElementById("classificationList");
selectClassification.addEventListener("change", (event) => {
    //get the ID of the selected option 
    classificationId = event.target.value;


    //use that ID to get all the inventory with that ID
    getInventoryItems(classificationId);


})


//get inventory items from the database
let getInventoryItems = (id) => {

    let url = `/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=${id}`;

    //make a AJAX call

    fetch(url)
        .then(response => {

            if (response.ok) {
                return response.json();
            }
            throw Error("Network response was not OK");
        })
        .then(data => {
            console.log(data);
            buildInventoryList(data);
        })
        .catch(err => console.log(err));
}


function buildInventoryList(data) {
    let inventoryDisplay = document.getElementById("inventoryDisplay");
    // Set up the table labels 
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';
    // Set up the table body 
    dataTable += '<tbody>';
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function(element) {
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`;
    })
    dataTable += '</tbody>';
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable;
}