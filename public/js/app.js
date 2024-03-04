let button = document.querySelector(".btn");
let passive = document.querySelector(".passive").value;
button.addEventListener('click', Request);

function Request() {

    let url = 'http://localhost/jr-full-stack/4-ek-kisimlar/ajax.php';
    let userId = document.querySelector('.user-id').value;
    var formData = new FormData();
    formData.append('id', userId);
    formData.append('passive', passive);

    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        try {
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resolve(xhr.response)
                }
            }
            xhr.open("POST", url, true);
            xhr.send(formData);
        } catch {
            reject(error);
        }
    })
        .then((res) => console.log(res))
        .catch((err) => console.log(err))
}
