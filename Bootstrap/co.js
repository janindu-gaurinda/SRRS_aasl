  function updateDateTime() {
    const now = new Date();

    // Format hours and minutes
    let hours = now.getHours();
    let minutes = now.getMinutes();
    // Add leading zero if needed
    if (hours < 10) hours = "0" + hours;
    if (minutes < 10) minutes = "0" + minutes;
    
    // Format date as YYYY.MM.DD
    const year = now.getFullYear();
    let month = now.getMonth() + 1; // Months are 0-based
    let day = now.getDate();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    const timeStr = `${hours}:${minutes}`;
    const dateStr = `${year}.${month}.${day}`;

    // Update HTML
    document.getElementById("time").innerText = timeStr;
    document.getElementById("date").innerText = dateStr;
  }

  // Run once on load
  updateDateTime();
  // Update every minute
  setInterval(updateDateTime, 1000);

// ===========================================lotgout=============\
  document.getElementById("logout-link").addEventListener("click", function(event) {
    const confirmLogout = confirm("Are you sure you want to log out?");
    if (!confirmLogout) {
      event.preventDefault(); // Stop the link from navigating
    }
  });

// ===========================================lotgout=============