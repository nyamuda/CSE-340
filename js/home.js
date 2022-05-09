let lastUpdated = Array.from(document.getElementsByClassName("last-updated"))

let theDate = document.lastModified;

lastUpdated.forEach(element => {
    element.innerHTML = `Last updated: ${theDate}`;
})