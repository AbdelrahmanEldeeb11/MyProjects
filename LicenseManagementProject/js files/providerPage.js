

document.getElementById("generateButton").onclick = function () {
    const length = 16;  // Define the length of the serial number
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  // Characters to use in the serial
    let result = '';

    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));

        // Insert a '-' every 4 characters for readability
        if ((i + 1) % 4 === 0 && i !== length - 1) {
            result += '-';
        }
    }

    // Display the generated serial
    document.getElementById('serialDisplay').innerHTML = result
    document.getElementById('serialNumber').value = result
};


document.getElementById("associateButton").onclick = function () {
    const clientName = document.getElementById('clientName2').value;
    const productName = document.getElementById('productName').value;
    const serialNumber = document.getElementById('serialNumber').value;

    if (clientName && productName && serialNumber) {
        const data = {
            username: clientName,
            productName: productName,
            SerialNumber: serialNumber
        };

        fetch('http://localhost:3000/associate-client', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("associate").innerHTML = `Successfully associated ${productName} with ${clientName}.`;
                } else {
                    document.getElementById("associate").innerHTML = `Error: ${data.message}`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("associate").innerHTML = 'An error occurred while associating the serial number.';
            });
    } else {
        alert('Please fill out all fields!');
    }
};




document.getElementById("sendNoti").onclick = function () {
    let mail = document.getElementById("clientEmailNotify").value;
    let count = 0;
    for (let i = 0; i < mail.length; i++) {
        if (mail[i] == '@') {
            count++;
        }
    }
    if (count == 1) {
        document.getElementById("notiMessage").innerHTML = "Message has been sent!";
    }
    else
        alert("Invalid email format");

}


document.getElementById("configButton").onclick = function () {
    let serialNumber = document.getElementById("serialNumber2").value;
    let isBlockChecked = document.getElementById("blockRadio").checked;

    if (!serialNumber) {
        alert("Please enter a serial number.");
        return;
    }

    if (isBlockChecked) {
        // Send request to delete the serial number
        fetch('http://localhost:3000/block-serial', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ serialNumber })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("configMessage").innerHTML = `Serial number ${serialNumber} has been successfully blocked and deleted.`;
                } else {
                    document.getElementById("configMessage").innerHTML = `Error: ${data.message}`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("configMessage").innerHTML = 'An error occurred while blocking the serial number.';
            });
    } else {
        document.getElementById("configMessage").innerHTML = `${serialNumber} has been successfully unblocked!`;
    }
};



document.addEventListener('DOMContentLoaded', function () {
    fetchClients();
    document.getElementById('clientSelect').addEventListener('change', function () {
        if (this.value) {
            displayClientDetails(this.value);
        }
    });
});

function fetchClients() {
    fetch('http://localhost:3000/get-clients')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateClientDropdown(data.clients);
            } else {
                console.error('Failed to fetch clients');
            }
        })
        .catch(error => console.error('Error:', error));
}

function populateClientDropdown(clients) {
    const selectElement = document.getElementById('clientSelect');
    clients.forEach(client => {
        let option = document.createElement('option');
        option.value = client.username; // Assuming the database has a 'username' field
        option.textContent = client.username; // Display the username in the dropdown
        selectElement.appendChild(option);
    });
}

function displayClientDetails(clientUsername) {
    fetch(`http://localhost:3000/get-client-details/${clientUsername}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const detailsDiv = document.getElementById('clientDetails');
                detailsDiv.innerHTML = `
                    <p>Email: ${data.client.email}</p>
                    <p>Registration Date: ${data.client.reg_date}</p>
                `;
            } else {
                console.error('Failed to load client details');
            }
        })
        .catch(error => console.error('Error:', error));
}



