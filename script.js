function uploadImage() {
    const input = document.getElementById("imageInput");
    const file = input.files[0];

    if (!file) {
        alert("Please select an image.");
        return;
    }

    const formData = new FormData();
    formData.append("image", file);

    // Send image to the Python OCR file
    fetch("http://localhost:5000/verify", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const output = document.getElementById("output");
        output.textContent = `Verification: ${data.status}`;
        output.style.color = data.status === "Verified" ? "green" : "red";
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Failed to verify image.");
    });
}
