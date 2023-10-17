const input = document.getElementById('fileInput')
const img = document.querySelector('.preview')
const uploadForm = document.getElementById('upload-form')

input.addEventListener("change", (e) => {
    img.src = window.URL.createObjectURL(e.target.files[0])
    img.setAttribute('height', '100%')
    if (fileInput.files.length > 0) {
        uploadForm.submit();
    }
})