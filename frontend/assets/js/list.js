(function () {
  const access_token = getCookie("access_token");

  if (access_token !== null) {
    getData(access_token);

    // refresh data each hour
    // setInterval(() => {
    //   getData(access_token);
    // }, 3600000);

    // refresh data each munite
    setInterval(() => {
      getData(access_token);
    }, 60000);
  } else {
    // get new access_token by refresh_token
    // or redirect login
    window.location = "/frontend/login.php";
  }
})();
//get cookie by cokkie name
function getCookie(name) {
  const cookies = document.cookie.split(";");
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + "=")) {
      return cookie.substring(name.length + 1);
    }
  }
  return null;
}
// get data by access_token
async function getData(access_token) {
  const tableBody = document.getElementById("tableBody");
  let html = "";
  tableBody.innerHTML =
    '<tr><td colspan="4" class="mw-50 fwb">Loading...</td></tr>';

  try {
    const response = await fetch("/backend/list.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ access_token: access_token }),
    });

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const data = await response.json();
    if (data.status) {
      data.data.forEach((el, index) => {
        html += `<tr style="background-color: ${el.colorCode || "salmon"}">
                  <td class="mw-50 fwb">${index + 1}</th>
                  <td class="mw-50">${el.task}</td>
                  <td class="mw-50">${el.title}</td>
                  <td class="mw-50">${el.description}</td>
                </tr>`;
      });
    } else {
      html = `<tr style="background-color: salmon">
                <td colspan="4" class="mw-50 fwb">${data.message}</th>
              </tr>`;
    }
  } catch (error) {
    html = `<tr style="background-color: salmon">
              <td colspan="4" class="mw-50 fwb">${error.message}</th>
            </tr>`;
  }
  tableBody.innerHTML = html;
}
// display selected image
document
  .getElementById("imageInput")
  .addEventListener("change", function (event) {
    const selectedImage = document.getElementById("selectedImage");
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        selectedImage.src = e.target.result;
        selectedImage.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });

function saveChanges() {
  // code
}

// search
document.getElementById("searchInput").addEventListener("input", function () {
  const searchTerm = this.value.toLowerCase();
  const rows = document.getElementById("tableBody").getElementsByTagName("tr");

  for (let i = 0; i < rows.length; i++) {
    const rowText = rows[i].innerText.toLowerCase();

    if (rowText.includes(searchTerm)) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
    // highlightSearchTerm(rows[i], searchTerm);
  }
});
// highlight search term
function highlightSearchTerm(row, searchTerm) {
  const cells = row.getElementsByTagName("td");

  for (let j = 1; j < cells.length; j++) {
    const cellText = cells[j].innerText.toLowerCase();

    if (cellText.includes(searchTerm)) {
      const highlightedText = cellText.replace(
        new RegExp(searchTerm, "gi"),
        (match) =>
          `<span style="color: black; background-color: yellow;">${match}</span>`
      );
      cells[j].innerHTML = highlightedText;
    } else {
      cells[j].innerHTML = cellText;
    }
  }
}
