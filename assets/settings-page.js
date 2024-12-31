function openTab(evt, tabName) {
    evt.preventDefault();
    var i, tabcontent, tablinks;

    // Hide all tabcontent
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove active class from all tabs
    tablinks = document.getElementsByClassName("nav-tab");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("nav-tab-active");
    }

    // Show active tab and add active class
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("nav-tab-active");

    // Update URL hash without reloading the page
    history.pushState(null, null, `#${tabName}`);
}


document.addEventListener("DOMContentLoaded", function () {
     // Get the hash from the URL
    var hash = window.location.hash.substring(1); // Remove the # symbol

    // Hide all tabcontent by default
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove active class from all tabs by default
    var tablinks = document.getElementsByClassName("nav-tab");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("nav-tab-active");
    }

    if (hash && document.getElementById(hash)) {
        // If hash exists and matches a tab, open that tab
        document.getElementById(hash).style.display = "block";
        var activeTabLink = document.querySelector(`.nav-tab[onclick="openTab(event, '${hash}')"]`);
        if (activeTabLink) {
            activeTabLink.classList.add("nav-tab-active");
        }
    } else {
        // Default to the first tab if no valid hash is found
        tabcontent[0].style.display = "block";
        tablinks[0].classList.add("nav-tab-active");
    }
    
    // Ensure the current hash is added to the form action before submission
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function () {
            const currentHash = window.location.hash;
            if (currentHash) {
                const action = form.getAttribute("action") || "";
                form.setAttribute("action", action + currentHash);
            }
        });
    }
    
});


document.addEventListener("DOMContentLoaded", function () {
    // find all checkboxes with `data-toggle`
    const toggles = document.querySelectorAll("[data-toggle]");

    toggles.forEach(function (toggle) {
        const targetId = toggle.getAttribute("data-toggle"); // get target ID
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            // set visibility according to option status
            targetElement.style.display = toggle.checked ? "flex" : "none";

            // liten for changes
            toggle.addEventListener("change", function () {
                targetElement.style.display = toggle.checked ? "flex" : "none";
            });
        }
    });
});